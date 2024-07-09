<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    echo "comLogin";
} else {
    echo "semLogin";
}
?>
