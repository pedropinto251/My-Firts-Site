<?php
include_once __DIR__ . "/../../common/ConnectionBD1.php";

// Function to get projects list
function getProjectsList() {
    $db = new ConnectionBD1;
    $projects = array();

    $db->createConnection();

    $sql = "SELECT id, Titulo FROM Propostas";
    $result = $db->executeQuery($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $projects[$row["id"]] = $row["id"] . " - " . $row["Titulo"];
        }
    }

    $db->closeConnection();

    return $projects;
}

$projeto_estagio_id = "";
$aluno_id = "";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new ConnectionBD1;
    $db->createConnection();

    $projeto_estagio_id = $_POST["projeto_estagio"];
    $aluno_id = $_POST["aluno_id"];

    if (empty($projeto_estagio_id) || empty($aluno_id)) {
        $mensagem = "Por favor, preencha todos os campos.";
    } else {
        $estado = "pendente";

        if (isset($_FILES["file_pdf"]) && $_FILES["file_pdf"]["error"] == UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . "/uploads/";

            // Cria o diretório se não existir
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Obtém o nome original do arquivo
            $originalFileName = basename($_FILES["file_pdf"]["name"]);

            // Gera um nome único para evitar conflitos de arquivos
            $uniqueFileName = uniqid() . "_" . $originalFileName;

            // Caminho completo do arquivo no servidor
            $filePath = $uploadDir . $uniqueFileName;

            // Move o arquivo para o diretório de upload
            if (move_uploaded_file($_FILES["file_pdf"]["tmp_name"], $filePath)) {
                // Insere os dados na tabela Candidaturas
                $insertQuery = "INSERT INTO Candidaturas (ProjetoEstagioID, AlunoID, Estado, ArquivoPDF) VALUES (?, ?, ?, ?)";
                $stmt = $db->connection->prepare($insertQuery);
                $stmt->bind_param("isss", $projeto_estagio_id, $aluno_id, $estado, $filePath);

                if ($stmt->execute()) {
                    $mensagem = "Candidatura enviada com sucesso!";
                } else {
                    $mensagem = "Erro ao enviar a candidatura: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $mensagem = "Erro ao fazer o upload do arquivo PDF.";
            }
        } else {
            $mensagem = "Por favor, envie um arquivo PDF.";
        }
    }

    $db->closeConnection();
}

// Call the function after the POST check
$projects = getProjectsList();
?>
