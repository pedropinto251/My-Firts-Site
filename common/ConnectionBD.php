<?php

    Class ConnectionBD{

        public $connection;
        public $stmt;

        function createConnection(){
            $servername = "ctesp.dei.isep.ipp.pt:3306";
            $username = "dsos_grupo6";
            $password = "7TroquemApa88!";
            $dbname = "dsos_grupo6";
        
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