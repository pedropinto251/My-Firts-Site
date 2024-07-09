<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . "\common\ConnectionBD1.php"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios1 WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conexao, $query);

    if ($result) {
        $usuario = mysqli_fetch_assoc($result);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            switch ($usuario['tipo_usuario']) {
                case 'aluno':
                    header('Location: index.php');
                    break;
                case 'docente':
                    header('Location: docente_dashboard.php');
                    break;
                case 'empresa':
                    header('Location: empresa_dashboard.php');
                    break;
                case 'admin':
                    header('Location: admin_dashboard.php');
                    break;
                default:
                    // Lidar com tipo de usuário desconhecido
            }
        } else {
            echo "Credenciais inválidas.";
        }
    } else {
        echo "Erro na consulta ao banco de dados: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        <label>Email:</label>
        <input type="text" name="email" required><br>
        <label>Senha:</label>
        <input type="password" name="senha" required><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
