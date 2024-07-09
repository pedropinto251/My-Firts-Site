<?php
include_once __DIR__ . "/../../common/ConnectionBD1.php";
class PropostasModel {
    private $db;

    public function __construct() {
        $this->db = new ConnectionBD1;
    }

    public function getAllPropostas() {
        $allPropostas = array();
        $this->db->createConnection();

        $sql = "SELECT * FROM Propostas";
        $result = $this->db->executeQuery($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($allPropostas, array(
                        "id" => $row["id"],
                        "Titulo" => $row["Titulo"],
                        "Descricao" => $row["Descricao"],
                        "ResponsavelID" => $row["ResponsavelID"],
                        "Estado" => $row["Estado"],
                        "ArquivoPDF" => $row["ArquivoPDF"],
                        "DataSubmissao" => $row["DataSubmissao"],
                        "DataAprovacao" => $row["DataAprovacao"],
                        "AlertaEnviado" => $row["AlertaEnviado"],
                    )
                );
            }
        }

        $this->db->closeConnection();

        return $allPropostas;
    }
}
?>
