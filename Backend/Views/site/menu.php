<?php
    session_start();
    
    if (!isset($_SESSION["login"])) {        
        header("Location: ../../../Frontend/Views/site/login.php");
    } else if ($_SESSION["permission"] == 0) {
        header("Location: ../../../Frontend/Views/site/index.php");
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../../web/styles/style.css">
    <link rel="icon" type="image/png" href="../../../images/icon.png"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../web/scripts/script.js"></script>
    <title>A Favorita do Porto</title>
</head>

<?php
    $url = $_SERVER["PHP_SELF"];
?>

<body>
    <section class="backend-section">
        <article class="backend-article">
            <ul class="backend-article-list">
                <li><a href="../users/index.php" class="<?php echo (strpos($url,'users/index.php') !== false) ? "active-link" : "" ?>">Utilizadores</a></li>
                <li><a href="../category/index.php" class="<?php echo (strpos($url,'category/index.php') !== false) ? "active-link" : "" ?>">Categorias</a></li>
                <li><a href="../tax/index.php" class="<?php echo (strpos($url,'tax/index.php') !== false) ? "active-link" : "" ?>">Taxas de Iva</a></li>
                <li><a href="../products/index.php" class="<?php echo (strpos($url,'products/index.php') !== false) ? "active-link" : "" ?>">Produtos</a></li>
                <li><a href="../discount/index.php" class="<?php echo (strpos($url,'discount/index.php') !== false) ? "active-link" : "" ?>">Descontos</a></li>
                <li><a href="../consultations/allOrders.php" class="<?php echo (strpos($url,'consultations/allOrders.php') !== false) ? "active-link" : "" ?>">Consultar Encomendas</a></li>
                <li><a href="../consultations/allProducts.php" class="<?php echo (strpos($url,'consultations/allProducts.php') !== false) ? "active-link" : "" ?>">Consultar Produtos Vendidos</a></li>
                <li class="last-link"><a href="/../../../Frontend/Views/site/index.php" onclick = "logout()"><span class="glyphicon glyphicon-off"></span>Terminar Sessão</a></li>
            </ul>
        </article>