 </div>

   <?php ?>
   <style>
    footer {
    bottom: 0; /* Fixa o footer no fundo da página */
    width: 100%; /* Garante que o footer ocupe toda a largura da página */
}
    </style>
    <footer class="footer-style">
        <div class="div-go-top-page">
            <div class="go-top-page" id="go-top-page">
                <span class="glyphicon glyphicon-triangle-top"></span>
            </div>
            <div class="container">
                <div class="row footer-line">
                    <div class="col-md-4 footer-column text-center">
                        <h3>Site</h3>
                        <ul>
                            <li><a href="../site/index.php">Ir para a página principal</a></li>
                            <li><a href="/Frontend/Views/site/aboutUs.php">Sobre Nós</a></li>
                            <li><a href="/Frontend/Views/site/contacts.php">Contactos e Localização</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 footer-column text-center">
                        <h3>Conta</h3>
                        <ul>
                            <li class="option-login-buttons"><a href="../site/login.php">Login</a></li>
                            <li class="option-login-buttons"><a href="../site/register.php">Registar</a></li>
                            <li><a href="../site/reservedArea.php" class="option-reserved-area">Área reservada</a></li>
                            <li class="option-logout"><a href="../site/index.php" onclick ="logout()">Terminar Sessão</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-white footer-rights text-center">@<?= date("Y") ?> DEI Estágios.</p>
            </div>
        </div>
    </footer>

</body>
</html>