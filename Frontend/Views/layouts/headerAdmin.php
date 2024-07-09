<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="../../web/styles.css">
    <script src="../../web/script.js"></script>
    <script src="../../web/scriptLogin.js"></script>
    <script src="../../web/scriptRetrievePassword.js"></script>
    <script src="../../web/scriptRegisterClient.js"></script>
    <script src="../../web/scriptHeader.js"></script>
    <script src="../../web/scriptFinishBuy.js"></script>
    <link rel="stylesheet" href="../../../owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../owl-carousel/owl.theme.default.min.css">
    <link rel="icon" type="image/png" href="../../../images/icon.png"/>
    <script src="../../../owl-carousel/owl.carousel.min.js"></script>

    <title>DEI- Estagios</title>

</head>

<?php 
    $pageName = basename($_SERVER["REQUEST_URI"], ".php");
    $autenticado = isset($_SESSION['usuario_id']);
    //include_once $_SERVER["DOCUMENT_ROOT"] . "/Frontend/Actions/ActionsCategories.php";
    //$actionsCategories = new ActionsCategories;
    //$categories = $actionsCategories->actionGetAllCategories();
?>

<body>
    <?php $currentpage = $_SERVER['REQUEST_URI']; if ($currentpage == "/index.php") {print_r($currentpage);die;} ?>
    <nav class="navbar navbar-default" id="navbar">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/Frontend/Views/site/indexAdmin.php">
                    <div class="logo-image">
                        <img src="../../../images/icon.png" class="image-brand">
                    </div>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-my-style">
                    <li>
                        <a href="../site/indexAdmin.php" class="<?php echo $pageName == "index" || $pageName == "site" ? "active-link" : "nav-option-style" ?>"><span class="glyphicon glyphicon-home"></span> Página Principal</a>
                    </li>
                    <li id="head-dropdown-menu" class="dropdown">
                        <a class="dropdown-toggle <?php echo $pageName == "discounts" || $pageName == "" ? "active-link" : "nav-option-style" ?>" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Estagios<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="propostas.php" class="<?php echo $pageName == "discounts" ? "sub-nav-option-style-active" : "sub-nav-option-style" ?>">Propostas</a></li>
                            <li><a href="AllCandidaturas.php" class="<?php echo $pageName == "" ? "sub-nav-option-style-active" : "sub-nav-option-style" ?>">Candidaturas</a></li>
                            <li><a href="CandidaturaView.php" class="<?php echo $pageName == "" ? "sub-nav-option-style-active" : "sub-nav-option-style" ?>">Candidatar-se</a></li>
                            <li><a href="CriarUser.php" class="<?php echo $pageName == "" ? "sub-nav-option-style-active" : "sub-nav-option-style" ?>">Criar User</a></li>
                            <li><a href="ViewCheck01.php" class="<?php echo $pageName == "" ? "sub-nav-option-style-active" : "sub-nav-option-style" ?>">Avaliações</a></li>
                            <li><a href="verTodosProjeto.php" class="<?php echo $pageName == "" ? "sub-nav-option-style-active" : "sub-nav-option-style" ?>">Projetos Enviados</a></li>
                            <?php if (!empty($categories)) { ?>
                                <li role="separator" class="divider"></li>
                                <li id="dropright-menu" class="dropdownright">
                                    <a class="dropright-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">Categorias <span class="glyphicon glyphicon-chevron-right"></span></a>
                                    <ul class="dropdown-menu dropright-menu scrollable-menu">
                                        <?php foreach ($categories as $category) { ?>
                                            <li><a href="<?= $category ?>"><?= $category ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li><a href="/Frontend/Views/site/aboutUs.php" class="<?php echo $pageName == "aboutUs" ? "active-link" : "nav-option-style" ?>">Sobre Nós</a></li>
                    <li><a href="/Frontend/Views/site/contacts.php" class="<?php echo $pageName == "contacts" ? "active-link" : "nav-option-style" ?>">Contactos e Localização</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <?php if (!$autenticado) : ?>
                        <!-- Mostrar apenas quando não autenticado -->
                        <li>
                            <a href="../site/login.php" class="<?php echo $pageName == "login" ? "active-link" : "nav-option-style" ?> option-login-buttons">Login</a>
                        </li>
                        <li>
                            <a href="../site/register.php" class="<?php echo $pageName == "register" ? "active-link" : "nav-option-style" ?> option-login-buttons">Registar</a>
                        </li>
                    <?php else : ?>
                        <!-- Mostrar apenas quando autenticado -->
                        <li>
                            <a href="../site/reservedArea.php" class="<?php echo $pageName == "reservedArea" ? "active-link" : "nav-option-style" ?> option-reserved-area">Área reservada</a>
                        </li>
                        <li>
                            <a href="../site/index.php" class="nav-option-style option-logout" onclick="logout()">Terminar Sessão</a>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>

    <div class="search-container">
        <div class="container">
            <div id="search-product" class="search-product">
                <div class="input-group">
                    <input type="text" id="navbar-search" class="form-control navbar-search" placeholder="Pesquisar" value="<?php echo (isset($_GET["name_filter"])) ? $_GET["name_filter"] : "" ?>">
                    <div class="input-group-btn">
                        <button type="submit" id="search-btn" class="search-btn"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">