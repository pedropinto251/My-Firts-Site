<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_type = $_SESSION['user_type'];

if ($user_type == 0) {
    header('Location: tipo0_dashboard.php');
} elseif ($user_type == 1) {
    header('Location: tipo1_dashboard.php');
} elseif ($user_type == 2) {
    header('Location: tipo2_dashboard.php');
} elseif ($user_type == 3) {
    header('Location: tipo3_dashboard.php');
} else {
    echo "Tipo de usuário desconhecido.";
}
?>
