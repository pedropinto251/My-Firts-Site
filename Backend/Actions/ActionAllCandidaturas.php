<?php
include_once __DIR__ . "/../../common/ConnectionBD1.php";

class CandidaturasModel
{
    private $db;

    public function __construct()
    {
        $this->db = new ConnectionBD1;
        
    }

    public function getAllCandidaturas()
    {
        $allCandidaturas = array();
        $this->db->createConnection();

        $sql = "SELECT * FROM candidaturas";
        $result = $this->db->executeQuery($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($allCandidaturas, array(
                    "id" => $row["id"],
                    "ProjetoEstagioID" => $row["ProjetoEstagioID"], // Corrigido para "ProjetoEstagioID"
                    "AlunoID" => $row["AlunoID"], // Corrigido para "AlunoID"
                    "Estado" => $row["Estado"],
                    "ArquivoPDF" => $row["ArquivoPDF"],
                ));
            }
        }

        $this->db->closeConnection();

        return $allCandidaturas;
    }
}
