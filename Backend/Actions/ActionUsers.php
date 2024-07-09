<script src="../../web/scripts/script.js"></script>
<?php
    include_once __DIR__ . "/../../common/ConnectionBD1.php";
    
    Class ActionUsers {

        function test_input($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        function actionDisable($id, $state) {
            $db = new ConnectionBD1;
            $db->createConnection();

            $query = "UPDATE `user` SET `state` = ? WHERE id = ?";
            $db->preparedStmt($query);
            $db->stmt->bind_param("ii", $state, $id);

            
            $db->executeStmt();
            $db->closeStmt();
            $db->closeConnection();
            

            header('Location: /Frontend/Views/site/indexAdmin');
        }

        function changePermissions($id, $permission) {
            print_r("TESTE");
            $db = new ConnectionBD1;
            $db->createConnection();

            $query = "UPDATE `user` SET `with_permissions` = ? WHERE id = ?";
            $db->preparedStmt($query);
            $db->stmt->bind_param("ii", $permission, $id);

            
            $db->executeStmt();
            $db->closeStmt();
            $db->closeConnection();
            

            header('Location: /Frontend/Views/site/indexAdmin');
        }
        
        function getAllUsers() {
            $db = new ConnectionBD1;
            $allUsers = array();
            $db->createConnection();
            
            $sql = "SELECT * FROM user";
            $result = $db->executeQuery($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($allUsers, array(
                            "id" => $row["id"],
                            "username" => $row["username"],
                            "email" => $row["email"],
                            "name" => $row["name"],
                            "with_permissions" => $row["with_permissions"],
                            "state" => $row["state"],
                        )
                    );
                }
            }

            $db->closeConnection();

            return $allUsers;
        }

        function getUserById($id) {
            $db = new ConnectionBD1;
            $db->createConnection();
            
            $sql = "SELECT * FROM user WHERE id = $id";
            $result = $db->executeQuery($sql);

            $user = array();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $user["id"] = $row["id"];
                    $user["username"] = $row["username"];
                    $user["email"] = $row["email"];
                    $user["name"] = $row["name"];
                    $user["address"] = $row["address"];
                    $user["postal_code"] = $row["postal_code"];
                    $user["city"] = $row["city"];
                    $user["nif"] = $row["nif"];
                    $user["with_permissions"] = $row["with_permissions"];
                    $user["state"] = $row["state"];
                }
            }

            $db->closeConnection();
            
            return $user;
        }

    }
    
    
?>