<?php

    include_once "../../common/ConnectionBD1.php";
    include_once "../../common/SendEmail.php";
    include_once "../../common/Validations.php";
    include_once "../../common/RandomPassword.php";

    $email = test_input($_REQUEST["email"]);

    if (empty($email)) {

        echo "emailVazio";

    } elseif (validationEmail($email)) {

        echo "emailInvalido";

    } else if (verifyExistsEmail($email)) {

            $code = randomPassword(5);
            
            $subject = "Código de confirmação recuperar a sua palavra-passe";     
            $body = "Olá,<br>
            Enviamos este email com um código de confirmação para poder recuperar a sua palavra-passe.<br>
            Código de confirmação: " . $code . "<br><br>
            Se não realizou o pedido de recuperação de palavra-passe ignore esta mensagem!<br><br>
            Obrigado,<br>
            A Favorita do Porto";
        
            if (sendEmail($email, $subject, $body)) {
                echo "emailEnviado " . $code;
            } else {
                echo "emailNaoEnviado";
            }

    } else {
        
        echo "emailInexistente";
    }    

    function verifyExistsEmail($email) {
        $db = new ConnectionBD1;
        $db->createConnection();

        $db->preparedStmt("SELECT * FROM usuarios1 WHERE email = ?");
        $db->stmt->bind_param("s", $email);    
        $db->executeStmt();
        
        $result = $db->stmt->get_result();            
        
        $db->closeStmt();
        $db->closeConnection();
        
        if ($result->num_rows > 0) {
            return true;
        } else{
            return false;
        }       
    }
?>