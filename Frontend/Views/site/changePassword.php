<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/common/ConnectionBD1.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Ajax/AjaxChangePassword.php";


class Check01Model
{
    private $db;

    public function __construct()
    {
        $this->db = new ConnectionBD1;
    }

    public function updatePassword($email, $novaSenha)
    {
        $changePassword = new ChangePassword();
        return $changePassword->updatePassword($email, $novaSenha);
    }

    public function getAllCheck01()
    {
        return [];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $novaSenha = isset($_POST["novaSenha"]) ? $_POST["novaSenha"] : "";

    $check01Model = new Check01Model();
    $successSenha = $check01Model->updatePassword($email, $novaSenha);

    $mensagem = $successSenha ? "Senha alterada com sucesso!" : "Erro ao alterar senha.";
}

$check01Model = new Check01Model();
$dadosCheck01 = $check01Model->getAllCheck01();
?>

<!DOCTYPE html>
<html lang="en">
<style>
    .password-change-box {
        background-color: #f4f4f4;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 5px;
        margin: 20px;
    }

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check01 - Alterar Senha</title>
</head>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Views/layouts/header.php"; ?>
    <h2>Alterar Senha</h2>

    <?php
    if (isset($mensagem)) {
        echo "<p>{$mensagem}</p>";
    }
    ?>

<?php
echo "<div class='password-change-box'>
        <form action='' method='POST'>
            <label for='email'>E-mail:</label>
            <input type='email' name='email' id='email' required>
            <label for='novaSenha'>Nova Senha:</label>
            <input type='password' name='novaSenha' id='novaSenha' required>
            <input type='submit' value='Alterar Senha'>
        </form>
      </div>";
?>
</body>

</html>
