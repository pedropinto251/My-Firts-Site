<?php include_once "../layouts/header.php"; ?>
    
    <div class="form-retrieve-password">
        <h1 class="h1-retrieve-password">Recuperar Palavra-Passe</h1>
        <form id="form-email" class="form-email">
            <p>Por favor introduza o seu email. De seguida enviaremos uma nova password.</p>        
            <div>
                <label for="retrievePasswordEmail">Email</label>
                <input type="text" class="form-control" id="retrievePasswordEmail" name="retrievePasswordEmail" maxlength="100">
            </div>

            <div class="form-email-space text-center">
                <p class="alert alert-danger" role="alert" id="infoEmail"></p>
                <input type="submit" id="retrievePasswordButton" class="btn btn-style1" value="Recuperar Palavra-Passe">
            </div>    
        </form>
        <form id ="form-code">        
            <div class="form-code-style">
                <p class="alert alert-warning" role="alert" id="infoCode"></p>

                <div class="form-code-style-body">
                    <label for="retrievePasswordCode">Introduza o código enviado: </label>
                    <input type="text" class="form-control form-code-style-body-input" id="retrievePasswordCode" name="retrievePasswordCode" maxlength="5" placeholder="Introduzir código">
                </div>

                <input type="submit" id="retrievePasswordButtonCode" class="btn btn-style1" value="Confirmar Código">
            </div>
        </form>
    </div>

<?php include_once "../layouts/footer.php"; ?>