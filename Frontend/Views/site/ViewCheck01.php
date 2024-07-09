<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "\common\ConnectionBD1.php"; 
 include_once $_SERVER["DOCUMENT_ROOT"] . "\Backend\Actions\ActionCheck01.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkId = $_POST["check_id"];
    $newCampo2 = isset($_POST["new_campo2"]) ? $_POST["new_campo2"] : "";
$newAvaliacao = isset($_POST["new_avaliacao"]) ? $_POST["new_avaliacao"] : "";

    $check01Model = new Check01Model();
    $success = $check01Model->updateCampo2($checkId, $newCampo2);

    if ($success) {
        $mensagem = "FeedBack enviado com sucesso!";
    } else {
        $mensagem = "Erro ao enviar FeedBack.";
    }

    $check01Model1 = new Check01Model();
    $success = $check01Model1->updateAvaliacao($checkId, $newAvaliacao);

    if ($success) {
        $mensagem = "Avaliação enviada com sucesso!";
    } else {
        $mensagem = "Erro ao enviar Avaliação.";
    }
}

$check01Model = new Check01Model();
$dadosCheck01 = $check01Model->getAllCheck01();
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
        margin-top: 10px;
    }
    </style>
</head>

<body>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/header.php"; ?>
    <h2>Deixar FeedBack</h2>

    <?php
    if (isset($mensagem)) {
        echo "<p>{$mensagem}</p>";
    }
    ?>

    <?php
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>ID Projeto</th>
                <th>Descrição</th>
                <th>feedBack</th>
                <th>Avaliação</th>
                <th>Data Apresentacao</th>
                <th>Deixar feedBack</th>
                <th>Deixar Avaliação</th>

            </tr>";

    foreach ($dadosCheck01 as $check01) {
        echo "<tr>
                <td>{$check01['id']}  </td>
                <td>{$check01['id_projeto']}</td>
                <td>{$check01['Descricao']}</td>
                <td>{$check01['Campo2']}</td>
                <td>{$check01['Avaliacao']}</td>
                <td>{$check01['DataApresentacao']}</td>
                <td>
                    <form action='' method='POST'>
                        <input type='hidden' name='check_id' value='{$check01['id']}'>
                        <label for='new_campo2'>Feedback:</label>
                        <input type='text' name='new_campo2' id='new_campo2' required>
                        <input type='submit' value='Deixar feedback'>
                    </form>
                </td>
                <td>
                    <form action='' method='POST'>
                        <input type='hidden' name='check_id' value='{$check01['id']}'>
                        <label for='new_avaliacao'>Avaliação:</label>
                        <input type='text' name='new_avaliacao' id='new_avaliacao' required>
                        <input type='submit' value='Deixar Avaliação'>
                    </form>
                </td>
                
              </tr>";
    }

    echo "</table>";
    ?>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/footer.php"; ?>
</body>

</html>