$(document).ready(function() {

    var passwordStatus = 0;

    $("#registerPassword").keyup(function () {
        var length = $("#registerPassword").val().length;
        var upperCase = new RegExp('[A-Z]');
        var lowerCase = new RegExp('[a-z]');
        var numbers = new RegExp('[0-9]');
        
        if ((length >= 8) && (length <= 16)) {
            $("#infoNumberCharacters").css("color", "green");
            $("#infoNumberCharacters").text("✓ No mínimo 8 caracteres e no máximo 16 caracteres");
        } else {
            $("#infoNumberCharacters").css("color", "red");
            $("#infoNumberCharacters").text("X No mínimo 8 caracteres e no máximo 16 caracteres");
        }

        if ($("#registerPassword").val().match(upperCase)){
            $("#infoUpperCase").css("color", "green");
            $("#infoUpperCase").text("✓ Pelo menos uma letra maiúscula");
        } else {
            $("#infoUpperCase").css("color", "red");
            $("#infoUpperCase").text("X Pelo menos uma letra maiúscula");
        }

        if ($("#registerPassword").val().match(lowerCase)){
            $("#infoLowerCase").css("color", "green");
            $("#infoLowerCase").text("✓ Pelo menos uma letra minúscula");
        } else {
            $("#infoLowerCase").css("color", "red");
            $("#infoLowerCase").text("X Pelo menos uma letra minúscula");
        }

        if ($("#registerPassword").val().match(numbers)){
            $("#infoNumber").css("color", "green");
            $("#infoNumber").text("✓ Pelo menos um número");
        } else {
            $("#infoNumber").css("color", "red");
            $("#infoNumber").text("X Pelo menos um número");
        }

        if (((length >= 8) && (length <= 16)) && ($("#registerPassword").val().match(upperCase))
        && ($("#registerPassword").val().match(lowerCase)) && ($("#registerPassword").val().match(numbers))){
            $("#infoPassword").css("display", "none");
            passwordStatus = 1;
        } else {
            $("#infoPassword").text("A palavras-passe não cumpre os requisitos!");
            $("#infoPassword").show();
            passwordStatus = 0;
        }
    });

    $("#form-register").unbind().submit(function() {

        var name = $("#registerName").val();
        var nif = $("#registerNif").val();
        var address = $("#registerAddress").val();
        var postalCode = $("#registerPostalCode").val();
        var city = $("#registerCity").val();
        var username = $("#registerUsername").val();
        var email = $("#registerEmail").val();
        var password = $("#registerPassword").val();
        var repeatPassword = $("#repeatPassword").val();
        var newsletter;
        var terms;

        if ($('#checkboxNewsletter').is(":checked")) {
            newsletter = 1;
        } else {
            newsletter = 0;
        }

        if ($('#checkboxTerms').is(":checked")) {
            terms = 1;
        } else {
            terms = 0;
        }

        $.ajax({
            url: "../../Ajax/AjaxRegisterClient.php",
            type: "POST",
            data: {name: name, nif: nif, address: address, postalCode: postalCode, city: city,                
                username: username, email: email, password: password, repeatPassword: repeatPassword,
                newsletter: newsletter, terms: terms, passwordStatus: passwordStatus},
            dataType: "html",
            success: function(response) {

                limpar();

                switch(response) {
                    case "dadosVazios":
                        $("#infoRegister").text("Existem campos em branco, por favor preencha todos os campos!");
                        $("#infoRegister").show();
                        break;
                    case "nomeInvalido":
                        $("#infoName").text("O nome não é válido!");
                        $("#infoName").show();
                        break;
                    case "nifInvalido":
                        $("#infoNif").text("O nif não é válido!");
                        $("#infoNif").show();
                        break;
                    case "nifExistente":
                        $("#infoNif").text("Já existe uma conta registada com este nif!");
                        $("#infoNif").show();
                        break;
                    case "moradaInvalida":
                        $("#infoMorada").text("A morada não é válida!");
                        $("#infoMorada").show();
                        break;
                    case "codigoPostalInvalido":
                        $("#infoPostalCode").text("O código postal não é válido!");
                        $("#infoPostalCode").show();
                        break;
                    case "cidadeInvalida":
                        $("#infoCity").text("A cidade não é válida!");
                        $("#infoCity").show();
                        break;
                    case "usernameInvalido":
                        $("#infoUsername").text("O username não é válido!");
                        $("#infoUsername").show();
                        break;
                    case "usernameExistente":
                        $("#infoUsername").text("Já existe uma conta registada com este username!");
                        $("#infoUsername").show();
                        break;
                    case "emailInvalido":
                        $("#infoEmail").text("O endereço de email não é válido!");
                        $("#infoEmail").show();
                        break;
                    case "emailExistente":
                        $("#infoEmail").text("Já existe uma conta registada com este email!");
                        $("#infoEmail").show();
                        break;
                    case "passwordInvalida":
                        $("#infoPassword").text("A palavras-passe não cumpre os requisitos!");
                        $("#infoPassword").show();
                        break;
                    case "passwordDiferente":
                        $("#infoDifferentPassword").text("As palavras-passes não coicidem!");
                        $("#infoDifferentPassword").show();
                        break;
                    case "termosInvalido":
                        $("#infoRegister").text("É necessário aceitar os termos e condições!");
                        $("#infoRegister").show();
                        break;
                    case "emailEnviado":
                        $("#form-register").css("display", "none");
                        $("#infoSucess").text("A sua conta foi criada com sucesso, foi enviado um email com os seus dados de acesso! Obrigado!");
                        $("#infoSucess").show();
                        setTimeout(function() {
                            window.location.href = "../../Views/site/login.php";
                        }, 5000);      
                        break;
                    case "emailNaoEnviado":
                        $("#form-register").css("display", "none");
                        $("#infoSucess").text("A sua conta foi criada com sucesso! Obrigado!");
                        $("#infoSucess").show();  
                        setTimeout(function() {
                            window.location.href = "../../Views/site/login.php";
                        }, 5000);  
                        break;
                }                
            }           
        });
        return false;
    });

    function limpar(){
        $("#infoRegister").css("display", "none");
        $("#infoName").css("display", "none");
        $("#infoNif").css("display", "none");
        $("#infoMorada").css("display", "none");
        $("#infoPostalCode").css("display", "none");
        $("#infoCity").css("display", "none");
        $("#infoUsername").css("display", "none");
        $("#infoEmail").css("display", "none");
        $("#infoPassword").css("display", "none");
        $("#infoDifferentPassword").css("display", "none");  
        $("#infoSucess").css("display", "none");      
    }

    function limparChangePassword(){
        $("#infoCurrentPassword").css("display", "none");  
        $("#infoPassword").css("display", "none"); 
        $("#infoDifferentPassword").css("display", "none");  
        $("#infoChangePassword").css("display", "none");
        $("#infoSucess").css("display", "none");
    }

    $("#form-change-password").unbind().submit(function() {

        var currentPassword = $("#currentPassword").val();
        var password = $("#registerPassword").val();
        var repeatPassword = $("#repeatPassword").val();

        $.ajax({
            url: "../../Ajax/AjaxChangePassword.php",
            type: "POST",
            data: {currentPassword: currentPassword, password: password, repeatPassword: repeatPassword, passwordStatus: passwordStatus },
            dataType: "html",
            success: function(response) {

                limparChangePassword();

                switch(response) {
                    case "dadosVazios":
                        $("#infoChangePassword").text("Existem campos em branco, por favor preencha todos os campos!");
                        $("#infoChangePassword").show();
                        break;                    
                    case "passwordErrada":
                        $("#infoCurrentPassword").text("A palavra passe atual está errada!");
                        $("#infoCurrentPassword").show();
                        break;                    
                    case "passwordInvalida":
                        $("#infoPassword").text("A palavras-passe não cumpre os requisitos!");
                        $("#infoPassword").show();
                        break;
                    case "passwordDiferente":
                        $("#infoDifferentPassword").text("As palavras-passes não coicidem!");
                        $("#infoDifferentPassword").show();
                        break;
                    case "passwordInalterada":
                        $("#infoChangePassword").text("A sua nova palavra passe é igual à atual!");
                        $("#infoChangePassword").show();
                        break;
                    case "passwordAlterada":
                        $("#form-change-password").css("display", "none");
                        $("#infoSucess").text("A sua palavra-passe foi alterada com sucesso! Obrigado!");
                        $("#infoSucess").show();  
                        break;
                }                
            }           
        });
        return false;
    });
});