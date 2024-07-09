$(document).ready(function() {
    var generatedCode;

    $("#form-email").unbind().submit(function() {

        var email = $("#retrievePasswordEmail").val();

        $.ajax({
            url: "../../Ajax/AjaxRetrievePassword.php",
            type: "POST",
            data: {email: email},
            dataType: "html",
            success: function(response) {

                var division = response.split(" ");
                response = division[0];
                generatedCode = division[1];

                $("#infoEmail").show(); 

                switch(response) {
                    case "emailVazio":
                        $("#infoEmail").text("Indique o seu email, por favor!");                    
                        break;
                    case "emailInvalido":
                        $("#infoEmail").text("O endereço de email não é válido!");  
                        break;
                    case "emailInexistente":
                        $("#infoEmail").text("Não existe nenhuma conta registada com este endereço de email!");                     
                        break;
                    case "emailNaoEnviado":
                        $("#infoEmail").text("Ocorreu um erro, tente mais tarde!");                   
                        break;
                    case "emailEnviado":
                        $("#infoCode").text("Foi enviado um código de confirmação para o seu email!");
                        $("#infoCode").show();  
                        $("#form-email").css("display", "none");
                        $("#form-code").show();
                        break;
                }                
            }           
        });
        return false;
    });

    $("#form-code").unbind().submit(function() {
        var email = $("#retrievePasswordEmail").val();
        var code = $("#retrievePasswordCode").val();

        $.ajax({
            url: "../../Ajax/AjaxVerifyCode.php",
            type: "POST",
            data: {email: email, code: code, generatedCode: generatedCode},
            dataType: "html",
            success: function(response) {

                $("#infoCode").show();

                switch(response) {
                    case "codigoErrado":
                        $('#infoCode').removeClass("alert-warning").addClass("alert-danger");
                        $("#infoCode").text("Código errado!");                      
                        break;
                    case "emailNaoEnviado":
                        $('#infoCode').removeClass("alert-warning").addClass("alert-danger");
                        $("#infoCode").text("Ocorreu um erro, tente mais tarde!");                   
                        break;
                    case "emailEnviado":
                        $('#infoCode').removeClass("alert-warning alert-danger").addClass("alert-success");
                        $("#infoCode").text("Código correto, a sua nova palavra-passe foi enviada para o seu email!");
                        $("#retrievePasswordCode").prop("disabled", true);
                        $("#retrievePasswordButtonCode").prop("disabled", true);
                        break;
                }                
            }           
        });
        return false;        
    });
});