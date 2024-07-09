<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . "\common\ConnectionBD1.php";

$conexaoBD = new ConnectionBD1();
$conexao = $conexaoBD->createConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios1 WHERE email = '$email' AND senha = '$senha'";
    
    $result = $conexaoBD->executeQuery($query);

    if ($result) {
        $usuario = $result->fetch_assoc();

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];
            var_dump($_SESSION);


            switch ($_SESSION['tipo_usuario']) {
                case 'aluno':
                    header('Location: index.php');
                    break;
                case 'docente':
                    header('Location: indexDocente.php');
                    break;
                case 'empresa':
                    header('Location: indexEmpresa.php');
                    break;
                case 'admin':
                    header('Location: indexAdmin.php');
                    break;
                default:
                    echo "Tipo de usuário desconhecido.";
                    break;
            }
        } else {
            echo "Credenciais inválidas.";
        }
    } else {
        echo "Erro na consulta ao banco de dados: " . $conexao->error;
    }

    $conexaoBD->closeConnection();
}

$autenticado = isset($_SESSION['usuario_id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #363636;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
            margin-top: 50px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }

        input {
            padding: 10px;
            margin: 6px 0;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff; /* Azul */
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            color: #4caf50;
            margin-top: 10px;
        }

        .error {
            color: #f00;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
        <a href="register.php">
            <button type="button">Registrar</button>
        </a>
        

        <?php if (isset($login_error)) : ?>
            <p class="error"><?php echo $login_error; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>
