<?php

include_once __DIR__ . "/../../common/ConnectionBD1.php";

class ChangePassword
{
    private $db;

    public function __construct()
    {
        $this->db = new ConnectionBD1;
    }

    public function updatePassword($email, $senha)
    {
        // Verificar se $senha está preenchido
        if (!empty($senha)) {
            $this->db->createConnection();

            $query = "UPDATE usuarios1 SET senha = ? WHERE email = ?";
            $stmt = $this->db->preparedStmt($query);
            $stmt->bind_param("ss", $senha, $email); // Alterado para dois "s" (string)

            $success = $stmt->execute();

            $stmt->close();
            $this->db->closeConnection();

            return $success;
        } else {
            // Retornar false ou tratar de outra forma se $senha estiver vazia
            return false;
        }
    }
}

?>
