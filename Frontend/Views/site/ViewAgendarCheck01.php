<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "\common\ConnectionBD1.php"; 
include_once $_SERVER["DOCUMENT_ROOT"] . "\Backend\Actions\ActionAgendarCheck01.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agendarCheckId = $_POST["agendar_check_id"];
    $newDataApresentacao = isset($_POST["new_data_apresentacao"]) ? $_POST["new_data_apresentacao"] : "";

    $Check01Model = new Check01Model();
    $success = $Check01Model->updateDataApresentacao($agendarCheckId, $newDataApresentacao);

    if ($success) {
        $mensagem = "Data de apresentação adicionada com sucesso!";
    } else {
        $mensagem = "Erro ao adicionar data de apresentação.";
    }
}


$Check01Model = new Check01Model();
$dadosCheck01 = $Check01Model->getAllCheck01();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check01</title>
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

        th,
        td {
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
        .feedback-form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .feedback-form input[type='submit'] {
        margin-top: 10px; /* Adicione margem para espaçamento */
    }
    </style>
</head>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/header.php"; ?>
    <h2>Agendar Check01</h2>

    <?php
    if (isset($mensagem)) {
        echo "<p>{$mensagem}</p>";
    }
    ?>

    <?php
    // Exibe os dados em uma tabela
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>ID Projeto</th>
                <th>Descrição</th>
                <th>Data Apresentacao</th>
                <th>Agendar Data</th>
            </tr>";

    foreach ($dadosCheck01 as $agendarCheck01) {
        echo "<tr>
                <td>{$agendarCheck01['id']}</td>
                <td>{$agendarCheck01['id_projeto']}</td>
                <td>{$agendarCheck01['Descricao']}</td>
                <td>{$agendarCheck01['DataApresentacao']}</td>
                <td>
                    <form action='' method='POST'>
                        <input type='hidden' name='agendar_check_id' value='{$agendarCheck01['id']}'>
                        <label for='new_data_apresentacao'>Data de Apresentação:</label>
                        <input type='text' name='new_data_apresentacao' id='new_data_apresentacao' required>
                        <input type='submit' value='Agendar Data'>
                    </form>
                </td>
              </tr>";
    }

    echo "</table>";
    ?>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/footer.php"; ?>
</body>

</html>
