<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidaturas</title>
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
    </style>
</head>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/header.php"; ?>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "\Backend\Actions\ActionAllCandidaturas.php"; ?>
    

    <div class="main-content">
        <?php
        $candidaturasModel = new CandidaturasModel();
        $allCandidaturas = $candidaturasModel->getAllCandidaturas();

        if (!empty($allCandidaturas)) {
            echo '<table>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Projeto Estágio ID</th>';
            echo '<th>Aluno ID</th>';
            echo '<th>Estado</th>';
            echo '<th>Arquivo PDF</th>';
            echo '</tr>';

            foreach ($allCandidaturas as $candidatura) {
                echo '<tr>';
                echo '<td>' . $candidatura["id"] . '</td>';
                echo '<td>' . $candidatura["ProjetoEstagioID"] . '</td>';
                echo '<td>' . $candidatura["AlunoID"] . '</td>';
                echo '<td>' . $candidatura["Estado"] . '</td>';
                echo '<td>' . $candidatura["ArquivoPDF"] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No candidaturas found</p>';
        }
        ?>
    </div>

    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/footer.php"; ?>
</body>

</html>
