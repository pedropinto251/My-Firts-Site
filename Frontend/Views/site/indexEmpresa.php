<?php 
session_start();
include_once "../layouts/headerEmpresa.php"; 
if (isset($_SESSION["login"]) && $_SESSION["permission"] == 1) {        
    redirectToPage("Location: \Frontend\Views\site\AllCandidaturas.php");
    exit(); // Certifique-se de adicionar exit() após a chamada de header().
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo DEI-Estagios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .main-content {
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .main-page-p {
            margin-bottom: 10px;
        }

        .index-sales {
            margin-top: 20px;
        }

        .cards-display {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            width: 30%;
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-header {
            position: relative;
            height: 200px;
            background-color: #3498db;
            color: #fff;
            padding: 10px;
        }

        .info-category, .info-product {
            display: block;
        }

        .owl-carousel {
            margin-top: 10px;
        }

        .card-body {
            padding: 10px;
        }

        .card-body-information {
            text-align: center;
        }

        .card-separator {
            margin: 5px 0;
            border: 0.5px solid #ddd;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .description {
            display: block;
            margin-top: 10px;
        }

        .price {
            display: block;
            margin-top: 10px;
            font-size: 16px;
        }
        .header img {
             width: 300px;
             height: auto;
             display: block; 
              margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Bem-vindo DEI-Estagios</h1>
        <p class="main-page-p">Aqui podes confirmar os Estágios.</p>
        <p class="main-page-p">Esperemos que encontre o que deseja!</p>
        <img src="../../../images/icon.png" alt="Icon Image">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <?php include_once "../layouts/footer.php"; ?>
</body>
</html>
