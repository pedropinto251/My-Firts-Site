<?php

    include_once $_SERVER["DOCUMENT_ROOT"] . "/common/ConnectionBD1.php";

    Class ActionsUsers {

        function actionGetUserData($id) {

            $db = new ConnectionBD1;
            $user = array();
            $db->createConnection();
            
            $sql = "SELECT name, address, postal_code, city FROM user WHERE id = $id";
            $result = $db->executeQuery($sql);

            if ($result->num_rows > 0) {

                $user = $result->fetch_assoc();

            }

            $db->closeConnection();

            return $user;

        }

        function actionGetEmailUser($id) {
            $db = new ConnectionBD1;            
            $db->createConnection();      

            $db->preparedStmt("SELECT email FROM user WHERE id = ?");            
            $db->stmt->bind_param("i", $id);        
            $db->executeStmt();

            $result = $db->stmt->get_result();
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $email = $row["email"];
                }
            }

            $db->closeStmt();
            $db->closeConnection();

            return $email;
        }

    }
?>