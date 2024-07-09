<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "\common\ConnectionBD1.php"; 
 include_once $_SERVER["DOCUMENT_ROOT"] . "\Backend\Actions\ActionSelecionarEstagio.php"; 

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkId = $_POST["check_id"];
    $newResponsavel = isset($_POST["new_Responsavel"]) ? $_POST["new_Responsavel"] : "";

    $SelecionarEstagio = new SelecionarEstagio();
    $success = $SelecionarEstagio->updateResponsavel($checkId, $newResponsavel);

    if ($success) {
        $mensagem = "Responsável enviado com sucesso!";
    } else {
        $mensagem = "Erro ao enviar Responsável.";
    }

}

// Obtém todos os dados da tabela
$selecionarEstagio = new SelecionarEstagio();
$allPropostas = $selecionarEstagio->getAllPropostas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags, title, and styles -->
</head>
<style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}


.main-content {
    flex-grow: 1; 
    display: flex;
    justify-content: center;
    align-items: center;
}

table {
    width: 80%;
    border-collapse: collapse;
    margin: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0; 
    width: 100%; 
}


    </style>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/headerDocente.php"; ?>
    <h2>Estágios a orientar</h2>

    <?php
    // Exibe mensagem de sucesso ou erro
    if (isset($mensagem)) {
        echo "<p>{$mensagem}</p>";
    }
    ?>

    <?php
    // Exibe os dados em uma tabela
    if (!empty($allPropostas)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Titulo</th>';
        echo '<th>Descricao</th>';
        echo '<th>Responsavel ID</th>';
        echo '<th>Adicionar Responsavel </th>';

        echo '</tr>';

        foreach ($allPropostas as $proposta) {
            echo "<tr>";
            echo '<td>' . $proposta["id"] . '</td>';
            echo '<td>' . $proposta["Titulo"] . '</td>';
            echo '<td>' . $proposta["Descricao"] . '</td>';
            echo '<td>' . $proposta["ResponsavelID"] . '</td>';
            echo "<td>
                    <form action='' method='POST'>
                        <input type='hidden' name='check_id' value='{$proposta['id']}'>
                        <label for='new_Responsavel'>Responsável:</label>
                        <input type='text' name='new_Responsavel' id='new_Responsavel' required>
                        <input type='submit' value='Submeter Responsável'>
                    </form>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhuma proposta encontrada.</p>";
    }
    ?>

    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/footer.php"; ?>
</body>

</html>