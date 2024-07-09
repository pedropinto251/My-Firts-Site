<?php include_once "../layouts/header.php"; ?>

</div>

<h1 class="text-center">Área reservada</h1>

<section class="section-reserved-area">

    <article class="article-reserved-area">
        <ul>
            <li><button type="button" class="btn btn-style2 reserved-area-buttons" id="reservedSeeOrders">Consultar Projetos</button></li>
            <li><button type="button" class="btn btn-style2 reserved-area-buttons" id="reservedChangePassword">Alterar palavra-passe</button></li>
        </ul>
    </article>

    <aside class="aside-reserved-area">

        <div class="div-welcome-reserved-area">
            <h3>Bem-vindo à sua área reservada!</h3>
            <p>Aqui pode consultar o estados das suas propostas e alterar a sua palavra-passe.</p>
            <p>Escolha o que pretende efetuar, no menu à sua esquerda</p>
        </div>
    
        <div class="div-see-orders">
            <?php //include_once "order.php" ?>
        </div>

        <div class="div-change-password">
            <?php include_once "changePassword.php" ?>
        </div>

    </aside>

</section>

<div class="container">

<?php include_once "../layouts/footer.php"; ?>