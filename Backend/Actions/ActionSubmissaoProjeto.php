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

// Inicializa variáveis para os valores do formulário
$Titulo = "";
$Descricao = "";
$mensagem = "";
$Responsavel_ID = ""; 
$estado = "";
$Data_submissao = "";
$Data_aprovacao = "";
$AlertaEnviado = "";


// Processa o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados
    $db = new ConnectionBD1;
    $db->createConnection();

    // Obtém os valores do formulário
    $Titulo = $_POST["Titulo"];
    $Descricao = $_POST["Descricao"];
    $Responsavel_ID = $_POST["Responsavel_ID"]; 

    // Validação básica
    if (empty($Titulo) || empty($Descricao) || empty($Responsavel_ID)) {
        $mensagem = "Por favor, preencha todos os campos.";
    } else {
        // Defina o estado como "pendente"
        $estado = "pendente";
        $Data_submissao = date("Y-m-d");
        $Data_aprovacao= null;
        $AlertaEnviado = "sim";

        // Verifica se um arquivo PDF foi enviado
        if (isset($_FILES["file_pdf"]) && $_FILES["file_pdf"]["error"] == UPLOAD_ERR_OK) {
            // Define o diretório de destino para salvar os arquivos PDF
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
                $insertQuery = "INSERT INTO Propostas (Titulo, Descricao, ResponsavelID, Estado, ArquivoPDF, DataSubmissao, DataAprovacao, AlertaEnviado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->connection->prepare($insertQuery);
                $stmt->bind_param("ssssssss", $Titulo, $Descricao, $Responsavel_ID, $estado, $filePath, $Data_submissao, $Data_aprovacao, $AlertaEnviado);


                if ($stmt->execute()) {
                    $mensagem = "Projeto enviado com sucesso!";
                } else {
                    $mensagem = "Erro ao enviar o projeto: " . $stmt->error;
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
