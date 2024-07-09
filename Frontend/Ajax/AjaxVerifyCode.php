<?php

    include_once "../../common/ConnectionBD.php";
    include_once "../../common/SendEmail.php";
    include_once "../../common/Validations.php";
    include_once "../../common/RandomPassword.php";

    $email = test_input($_REQUEST["email"]);
    $code = test_input($_REQUEST["code"]);
    $generatedCode = test_input($_REQUEST["generatedCode"]);

    if ($code != $generatedCode) {

        echo "codigoErrado";

    } else {
        $newPassword = randomPassword(10);
        $password = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
        updatePassword($password, $email);

        $subject = "Alteração de palavra-passe na loja 'A Favorita do Porto'";     
        $body = "Olá,<br>
        Enviamos este email para informar que a sua palavra-passe foi alterada com sucesso.<br>
        Nova palavra-passe: " . $newPassword . "<br><br>
        Obrigado,<br>
        A Favorita do Porto";
    
        if (sendEmail($email, $subject, $body)){
            echo "emailEnviado";
        } else {
            echo "emailNaoEnviado";
        }
    }            

    function updatePassword($password, $email) {
        $state = true;

        $db = new ConnectionBD;
        $db->createConnection();

        $db->preparedStmt("UPDATE user Set password = ? Where email = ?"); 
        $db->stmt->bind_param("ss", $password, $email);      
                
        $result = $db->executeStmt();
        
        $db->closeStmt();
        $db->closeConnection();  
        
        return $result;        
    }
?>