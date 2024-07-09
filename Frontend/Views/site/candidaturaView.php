<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Candidatura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .main-content {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            max-width: 100%;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #ccac00;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            margin: 10px 0;
            padding: 10px;
            background-color: #dff0d8;
            border: 1px solid #c3e6cb;
            color: #3c763d;
            border-radius: 4px;
        }

        .error {
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            color: #a94442;
        }

        header {
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
    
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Backend/Actions/ActionCandidatura.php"; ?>
</head>
<body>
<header>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/header.php"; ?>
</header>
    
<div class="main-content">
    <h2>Formulário de Candidatura</h2>
    <?php echo $mensagem; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="projeto_estagio">Projeto de Estágio:</label>
    <select name="projeto_estagio" required>
        <?php foreach ($projects as $projectId => $projectInfo) { ?>
            <option value="<?php echo $projectId; ?>"><?php echo $projectInfo; ?></option>
        <?php } ?>
    </select>

    <label for="aluno_id">Aluno ID:</label>
    <input type="text" name="aluno_id" value="<?php echo $aluno_id; ?>" required>

    <label for="file_pdf">Enviar PDF:</label>
    <input type="file" name="file_pdf" accept=".pdf" required>

    <input type="submit" value="Enviar Candidatura">
</form>

</div>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/footer.php"; ?>
</body>
</html>
