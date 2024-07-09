
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propostas</title>
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
    
</head>
<body>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/header.php"; ?>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "\Backend\Actions\ActionPropostas.php"; ?>

<div class="main-content">
<?php
    
     
    $propostasModel = new PropostasModel();

    // Get all propostas
    $allPropostas = $propostasModel->getAllPropostas();

    if (!empty($allPropostas)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Titulo</th>';
        echo '<th>Descricao</th>';
        echo '<th>Responsavel ID</th>';
        echo '<th>Estado</th>';
        echo '<th>Arquivo PDF</th>';
        echo '<th>Data Submissao</th>';
        echo '<th>Data Aprovacao</th>';
        echo '<th>Alerta Enviado</th>';
        echo '</tr>';

        foreach ($allPropostas as $proposta) {
            echo '<tr>';
            echo '<td>' . $proposta["id"] . '</td>';
            echo '<td>' . $proposta["Titulo"] . '</td>';
            echo '<td>' . $proposta["Descricao"] . '</td>';
            echo '<td>' . $proposta["ResponsavelID"] . '</td>';
            echo '<td>' . $proposta["Estado"] . '</td>';
            echo '<td>' . $proposta["ArquivoPDF"] . '</td>';
            echo '<td>' . $proposta["DataSubmissao"] . '</td>';
            echo '<td>' . $proposta["DataAprovacao"] . '</td>';
            echo '<td>' . $proposta["AlertaEnviado"] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No propostas found</p>';
    }
    ?>
    </div>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/footer.php"; ?>
</body>
</html>
