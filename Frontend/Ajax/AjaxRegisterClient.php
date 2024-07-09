<?php

    include_once "../../common/ConnectionBD1.php";
    include_once "../../common/SendEmail.php";
    include_once "../../common/Validations.php";

    

    include_once $_SERVER["DOCUMENT_ROOT"] . "\common\ConnectionBD1.php";
    
    class UserAction
    {
        private $db;
    
        public function __construct()
        {
            $this->db = new ConnectionBD1;
        }
    
        public function createUser($name, $email, $password, $address, $postal_code, $city, $nif,$with_permissions )
        {
            $this->db->createConnection();
    
            $query = "INSERT INTO `usuarios1` (nome, email, senha, morada, codigo_postal, cidade, nif, tipo_usuario) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->db->preparedStmt($query);
            $stmt->bind_param("ssssssis", $name, $email, $password, $address, $postal_code, $city, $nif, $with_permissions);
    
            $success = $stmt->execute();
    
            $stmt->close();
            $this->db->closeConnection();
    
            return $success;
        }
    }
    
    ?>
    
    
    