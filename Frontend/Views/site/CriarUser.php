
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Usuário</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        header {
            background-color: #333; 
            text-align: center;
            padding: 10px;
            width: 100%; 
        }

        form {
            width: 50%;
            margin-top: 50px;
        }

        label, select, input {
            display: block;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="submit"],
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        h2 {
            color: #333;
        }

        p {
            color: #4caf50;
        }
    </style>
</head>
<body>
<header><?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/header.php"; ?></header>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "\Backend\Actions\ActionCriarUser.php"; ?>
<?php  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["nome"];
    $email = $_POST["email"];
    $password = $_POST["senha"];
    $address = $_POST["morada"];
    $postal_code = $_POST["codigo_postal"];
    $city = $_POST["cidade"];
    $nif = $_POST["nif"];
    $with_permissions =$_POST ["tipo_usuario"];
    

    $userAction = new UserAction();
    $success = $userAction->createUser($name, $email, $password, $address, $postal_code, $city, $nif,$with_permissions );

    if ($success) {
        $mensagem = "Usuário criado com sucesso!";
    } else {
        $mensagem = "Erro ao criar usuário.";
    }
}
?>

<h2>Criar Novo Usuário</h2>

<?php
if (isset($mensagem)) {
    echo "<p>{$mensagem}</p>";
}
?>

<form action="" method="POST">
    <label for="senha">Senha:</label>
    <input type="password" name="senha" required>

    <label for="email">E-mail:</label>
    <input type="email" name="email" required>

    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>

    <label for="morada">Endereço:</label>
    <input type="text" name="morada" required>

    <label for="codigo_postal">Código Postal:</label>
    <input type="text" name="codigo_postal" required>

    <label for="cidade">Cidade:</label>
    <input type="text" name="cidade" required>

    <label for="nif">NIF:</label>
    <input type="text" name="nif" required>

    <label for="tipo_usuario">Permissões:</label>
    <select name="tipo_usuario">
        <option value="admin">Admin</option>
        <option value="empresa">Empresa</option>
        <option value="docente">Docente</option>
    </select>

    <input type="submit" value="Criar Usuário">
</form>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/footer.php"; ?>
</body>
</html>
