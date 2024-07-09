<?php

include_once __DIR__ . "/../../common/ConnectionBD1.php";

class SelecionarEstagio
{
    private $db;

    public function __construct()
    {
        $this->db = new ConnectionBD1;
    }

    public function getAllPropostas()
    {
        $allCheck01 = array();
        $this->db->createConnection();

        $query = "SELECT id, Titulo,  Descricao, ResponsavelID FROM Propostas";
        $result = $this->db->executeQuery($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $allPropostas[] = $row;
            }
        }

        $this->db->closeConnection();

        return $allPropostas;
    }

    public function updateResponsavel($id, $newResponsavel)
{
    if (!empty($newResponsavel)) {
        $this->db->createConnection();

        $query = "UPDATE Propostas SET ResponsavelID = ? WHERE id = ?";
        $stmt = $this->db->preparedStmt($query);
        $stmt->bind_param("si", $newResponsavel, $id);
        $success = $stmt->execute();

        $stmt->close();
        $this->db->closeConnection();

        return $success;
    } else {
        return false;
    }
}

    
}
?>
