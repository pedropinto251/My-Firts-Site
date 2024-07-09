<?php

include_once __DIR__ . "/../../common/ConnectionBD1.php";

class Check01Model
{
    private $db;

    public function __construct()
    {
        $this->db = new ConnectionBD1;
    }

    public function getAllCheck01()
    {
        $allCheck01 = array();
        $this->db->createConnection();

        $query = "SELECT id, id_projeto, Descricao, Campo2, Avaliacao, DataApresentacao FROM Check01";
        $result = $this->db->executeQuery($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $allCheck01[] = $row;
            }
        }

        $this->db->closeConnection();

        return $allCheck01;
    }

    public function updateCampo2($id, $newCampo2)
{
    // Verificar se $newCampo2 está preenchido
    if (!empty($newCampo2)) {
        $this->db->createConnection();

        $query = "UPDATE Check01 SET Campo2 = ? WHERE id = ?";
        $stmt = $this->db->preparedStmt($query);
        $stmt->bind_param("si", $newCampo2, $id);
        $success = $stmt->execute();

        $stmt->close();
        $this->db->closeConnection();

        return $success;
    } else {
        // Retornar false ou tratar de outra forma se $newCampo2 estiver vazio
        return false;
    }
}


    public function updateAvaliacao($id, $newAvaliacao)
    {
        // Verificar se $newAvaliacao está preenchido
        if (!empty($newAvaliacao)) {
            $this->db->createConnection();
    
            $query = "UPDATE Check01 SET Avaliacao = ? WHERE id = ?";
            $stmt = $this->db->preparedStmt($query);
            $stmt->bind_param("si", $newAvaliacao, $id);
            $success = $stmt->execute();
    
            $stmt->close();
            $this->db->closeConnection();
    
            return $success;
        } else {
            // Retornar false ou tratar de outra forma se $newAvaliacao estiver vazio
            return false;
        }
    }
    
}
?>
