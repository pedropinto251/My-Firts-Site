<?php

    Class ConnectionBD1{

        public $connection;
        public $stmt;

        function createConnection(){
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "dsos";
        
            $this->connection = new mysqli($servername, $username, $password, $dbname);
            
            if ($this->connection->connect_error) {
                die("Ocorreu um erro, tente mais tarde!");
            }
            
            return $this->connection;
        }

        function closeConnection(){
            $this->connection->close();
        }

        function executeQuery($query){
            $result = $this->connection->query($query);

            return $result;
        }

        function preparedStmt($query){
            $this->stmt = $this->connection->prepare($query);

            return $this->stmt;
        }

        function executeStmt(){
            $this->stmt->execute();

            return $this->stmt;
        }

        function closeStmt(){
            $this->stmt->close();
        }

        function lastInsertIdStmt(){
            return $this->stmt->insert_id;
        }
   }
?>