$(document).ready(function() {
    $('#checkPassword').change(function() {
        if($(this).prop('checked')) {
            $('#loginPassword').attr('type', 'text');
        } else {
            $('#loginPassword').attr('type', 'password');
        }
    });

    $("#form-login").unbind().submit(function() {

        var emailUsername = $("#loginEmailUsername").val();
        var password = $("#loginPassword").val();
        var missingLogin = $("input[type='submit']").attr("data-missing-login");

        $.ajax({
            url: "../../Ajax/AjaxLogin.php",
            type: "POST",
            data: {emailUsername: emailUsername, password: password, missingLogin : missingLogin},
            dataType: "html",
            success: function(response) {

                switch(response) {
                    case "dadosVazios":
                        $("#infoLogin").text("Preencha os dados, por favor!");
                        $("#infoLogin").show();  
                        break;
                    case "dadosErrados":
                        $("#infoLogin").text("Dados inválidos!");
                        $("#infoLogin").show(); 
                        break;
                    case "contaDesativada":
                        $("#infoLogin").text("A sua conta encontra-se desativada, por favor, contacte um administrador se pretender voltar a utilizar a conta!");
                        $("#infoLogin").show(); 
                        break;
                    case "dadosCertosCliente":
                        $("#infoLogin").text("Dados corretos!");
                        $("#infoLogin").removeClass("alert alert-danger").addClass("alert alert-success");
                        $("#infoLogin").show();
                        window.location.href = "../../../Frontend/Views/site/index.php";
                        break;
                    case "dadosCertosClienteCompras":
                        $("#infoLogin").text("Dados corretos!");
                        $("#infoLogin").removeClass("alert alert-danger").addClass("alert alert-success");
                        $("#infoLogin").show();                          
                        window.location.href = "../../../Frontend/Views/site/index.php";
                        break;
                    case "dadosCertosAdmin":
                        $("#infoLogin").text("Dados corretos!");
                        $("#infoLogin").removeClass("alert alert-danger").addClass("alert alert-success");
                        $("#infoLogin").show(); 
                        window.location.href = "../../../Frontend/Views/site/indexAdmin.php";
                        break;
                    case "dadosCertosEmpresa":
                        $("#infoLogin").text("Dados corretos!");
                        $("#infoLogin").removeClass("alert alert-danger").addClass("alert alert-success");
                        $("#infoLogin").show(); 
                        // Adicione o caminho para a página da empresa
                        window.location.href = "../../../Frontend/Views/site/indexEmpresa.php";
                        break;
                    case "dadosCertosDocente":
                        $("#infoLogin").text("Dados corretos!");
                        $("#infoLogin").removeClass("alert alert-danger").addClass("alert alert-success");
                        $("#infoLogin").show(); 
                        // Adicione o caminho para a página do educador
                        window.location.href = "../../../Frontend/Views/site/indexDocente.php";
                        break;
                }                
            }           
        });
        return false;
    });
});
