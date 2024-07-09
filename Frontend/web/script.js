$(document).ready(function () {

    $("#head-dropdown-menu").on("click", function () {

        if ($(this).hasClass("open")) {

            $(this).removeClass("open");
            $(".dropdown-toggle").attr("aria-expanded", "false");

        } else {

            $(this).addClass("open");
            $(".dropdown-toggle").attr("aria-expanded", "true");

        }
        
    });

    $("#dropright-menu").on("click", function () {

        if ($(this).hasClass("open")) {

            $(this).removeClass("open");
            $(".dropright-toggle").attr("aria-expanded", "false");
            $(this).find("ul").css("display", "none");

        } else {

            $(this).addClass("open");
            $(".dropright-toggle").attr("aria-expanded", "true");
            $(this).find("ul").css("display", "block");

        }
        
    });

    $("#head-dropdown-menu").hover(function () {

        $(this).find("ul").stop(true,true).slideToggle(200);
        $(this).find(".dropdown-toggle").removeClass("nav-option-style");
        $(this).find(".dropdown-toggle").addClass("active-link");

        $("#dropright-menu").find("ul").stop(true,true).hide(0);

    }, function() {
        
        $(this).find("ul").stop(true,true).hide(200);
        $(this).find(".dropdown-toggle").removeClass("active-link");
        $(this).find(".dropdown-toggle").addClass("nav-option-style");
        
    });

    $("#dropright-menu").hover(function() {

        $(this).find("ul").stop(true,true).slideToggle(200);
        $(this).find(".dropright-toggle").removeClass("sub-nav-option-style");
        $(this).find(".dropright-toggle").addClass("sub-nav-option-style-active");

    }, function() {
        
        $(this).find("ul").stop(true,true).hide(200);
        $(this).find(".dropright-toggle").removeClass("sub-nav-option-style-active");
        $(this).find(".dropright-toggle").addClass("sub-nav-option-style");
        
    });

    //Owl-Carousel
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        items: 1,
        singleItem: true,
    });

    $("#change-page").on("click", function() {
        $("#form-allProducts").submit();
    });

    $("#form-allProducts").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        //alert($("#array").val());
        $.ajax({
            url: "../../Actions/ActionPage.php",
            type: "GET",
            data: form.serialize(),
            dataType: "html"

        }).done(function (resposta) {
            console.log(resposta);

        }).fail(function (jqXHR, textStatus) {
            console.log("Request failed: " + textStatus);

        });
    });

    $("#form-newsletter").unbind().submit(function() {

        var email = $("#newsletter-email").val();

        $.ajax({
            url: "../../Ajax/AjaxNewsletter.php",
            type: "POST",
            data: {email: email},
            dataType: "html",
            success: function(response) {

                $(".alert-danger").remove();
                $(".alert-success").remove();

                switch(response) {
                    case "vazio":
                        $("#form-newsletter").append("<div class='alert alert-danger'>Insira um e-mail, por favor!</div>");
                        break;
                    case "invalido":
                        $("#form-newsletter").append("<div class='alert alert-danger'>Formato de e-mail inválido!</div>");
                        break;
                    case "erro":
                        $("#form-newsletter").append("<div class='alert alert-danger'>O e-mail inserido já se encontra inscrito na newsletter!</div>");
                        break;
                    case "inserido":
                        $("#form-newsletter").append("<div class='alert alert-success'>Subscreveu na newsletter com sucesso!</div>");
                        $("#newsletter-email").val("");
                        break;
                }
                
            }           
        });

        return false;

    });

    $("#go-top-page").on("click", function () {
        $("html, body").animate({
            scrollTop: $("#navbar").offset().top
        }, 1000);
    });

    $("#formBuyProduct").on("submit", function() {

        var id = $("#buyProduct").attr("data-product");
        var quantity = $("#quantity").val();

        $.ajax({
            url: "../../Ajax/AjaxAddProductCart.php",
            type: "POST",
            data: {id: id, quantity : quantity},
            dataType: "html",
            success: function(response) {

                //console.log(response);
                $(".alert-danger").remove();
                $(".alert-success").remove();
                $(".alert-warning").remove();

                switch(response) {
                    case "exists":
                        $(".jumbotron-info").append("<p class='alert alert-warning'>Este produto já se encontra adicionado ao carrinho!</p>");
                        break;
                    case "sucess":
                        $(".jumbotron-info").append("<p class='alert alert-success'>Este produto foi adicionado com sucesso ao carrinho!</p>");
                        break;
                    case "invalid":
                        location.reload();
                        break;
                    case "invalidQuantity":
                        $(".jumbotron-info").append("<p class='alert alert-danger'>Não existe, atualmente, em stock a quantidade de produtos pedida!</p>");
                        break;
                    case "lowQuantity":
                        $(".jumbotron-info").append("<p class='alert alert-danger'>Quantidade pedida inválida!</p>");
                        break;
                }

            }
        });

        return false;

    });

    $(".removeProduct").on("click", function() {

        var id = $(this).attr("data-product");
        
        $.ajax({
            url: "../../Ajax/AjaxRemoveProductCart.php",
            type: "POST",
            data: {id: id},
            dataType: "html",
            success: function(response) {
                $(".alert-warning").remove();

                if (response == "sucess") {
                    location.reload();
                } else {
                    $(".warning-container").append("<p class='alert alert-warning'>Ocorreu um erro a retirar o produto do carrinho! Por favor, tente mais tarde!</p>");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }           

            }
        });

    });

    $(".quantity-change").on("change", function() {

        var id = $(this).attr("data-product");
        var quantity = $(this).val();
        //console.log(id + " " + quantity);
        
        $.ajax({
            url: "../../Ajax/AjaxChangeQuantityProductCart.php",
            type: "POST",
            data: {id : id, quantity : quantity},
            dataType: "html",
            success: function(response) {
                location.reload();
            }
        });

    });

    $("#navbar-search").on("input", function() {

        var name = $(this).val();
        console.log(name);

        $(".search-product-result").remove();

        $.ajax({
            url: "../../Ajax/AjaxSearch.php",
            type: "GET",
            data: {name : name},
            dataType: "html",
            success: function(response) {
                $("#search-product").append(response);
            }
        });

    });

    $("body").on("click", function() {
        $(".search-product-result").remove();
    });

    $("#search-btn").on("click", function() {
        var filter = $("#navbar-search").val();

        if (filter !== "") {
            window.location = "../products/allproducts.php?name_filter=" + filter;
        }
        
    });

    $("input[type=radio][name=typeDelivery]").change(function() {
        if (this.value == "shop") {
            $(".home-method").css("display", "none");
            $(".shop-method").css("display", "block");
        } else if (this.value == "home") {
            $(".shop-method").css("display", "none");
            $(".home-method").css("display", "block");
        }

        $(".infoEncomenda").css("display", "none");
    });

    $("input[type=radio][name=payMethod]").change(function() {

        $(".payment-choose-info").remove();

        var text = "";

        if (this.value == "collectionPayment") {
            text = "Irá efetuar o pagamento da sua encomenda no ato da entrega.";
        } else if (this.value == "bankTransfer") {
            text = "Após a confirmação da encomenda, será fornecido um IBAN para efetuar a transferência.";
        } else if (this.value == "atm") {
            text = "Após a confirmação da encomenda, será indicado a entidade e a referência do multibanco.";
        }

        $(".payment-choose").append("<div class='alert alert-warning payment-choose-info'>" + text + "</div>");
    });

    $("input[type=radio][name=receiveLocal]").change(function() {
        if (this.value == "receiveOther") {
            $(".choose-receive-home").css("display", "none");
            $(".choose-receive-address").css("display", "block");
        } else if (this.value == "receiveHome") {
            $(".choose-receive-address").css("display", "none");
            $(".choose-receive-home").css("display", "block");
        }
    });

    $("#finishBuyV1").submit(function() {

        if ($("#home").is(":not(:checked)") && $("#shop").is(":not(:checked)")) {
            $(".infoEncomenda").text("Escolha o tipo de entrega que pretende!");
            $(".infoEncomenda").show();
            return false;
        }

        if ($("#home").is(":checked") && $("#collectionPayment").is(":not(:checked)") && $("#bankTransfer").is(":not(:checked)") && $("#atm").is(":not(:checked)") ) {
            $(".infoEncomenda").text("Escolha o tipo de pagamento que pretende efetuar!");
            $(".infoEncomenda").show();
            return false;
        } else if ($("#home").is(":checked") && $("#receiveHome").is(":not(:checked)") && $("#receiveOther").is(":not(:checked)")) {
            $(".infoEncomenda").text("Escolha onde pretende receber a encomenda!!");
            $(".infoEncomenda").show();
            return false;
        } else if ($("#home").is(":checked") && $("#receiveOther").is(":checked") && ($("#userName").val() == "" || $("#userAddress").val() == "" || $("#userPostalCode").val() == "" || $("#userCity").val() == "")) {
            $(".infoEncomenda").text("Existem campos em branco, por favor preencha todos os campos!");
            $(".infoEncomenda").show();
            return false;
        }

        return true;

    });

    $("#reservedSeeOrders").on("click", function() {
        $(".div-welcome-reserved-area").css("display", "none");
        $(".div-change-password").css("display", "none");
        $(".div-see-orders").css("display", "block");

        $("#reservedChangePassword").removeClass("reserved-area-buttons-active").addClass("reserved-area-buttons");
        $("#reservedSeeOrders").removeClass("reserved-area-buttons").addClass("reserved-area-buttons-active");
    });

    $("#reservedChangePassword").on("click", function() {
        $(".div-welcome-reserved-area").css("display", "none");
        $(".div-see-orders").css("display", "none");
        $(".div-change-password").css("display", "block");

        $("#reservedSeeOrders").removeClass("reserved-area-buttons-active").addClass("reserved-area-buttons");
        $("#reservedChangePassword").removeClass("reserved-area-buttons").addClass("reserved-area-buttons-active");
    });

});

function backReservedArea(){
    window.location.href = "../../Views/site/reservedArea.php";
}

function genericSocialShare(url){
    window.open(url,'sharer','toolbar=0,status=0,width=650,height=395');
    return true;
}