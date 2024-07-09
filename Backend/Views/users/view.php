<!DOCTYPE html>
<?php

    include_once "../../Actions/ActionUsers.php";
    $id_user = $_GET["id"];

    $actionUsers = new ActionUsers;

    $user = $actionUsers->getUserById($id_user);
?>

        <?php include_once "../site/menu.php"?>


        <aside class="backend-aside">
            <?php if (empty($user)){
                    echo "<h3>Não existe nenhum cliente com o id fornecido!</h3>";
                } else {
              ?>
            <h1>Ver <?php echo $user["username"] ?> </h1>
            <div class="formBackend" id="divFormBackend">
                <div>
                    <label>Utilizador: </label>
                    <?php echo $user['username'] ?>
                </div>

                <div>
                    <label>Email: </label>
                    <?php echo $user['email'] ?>
                </div>

                <div>
                    <label>Nome: </label>
                    <?php echo $user['name'] ?>
                </div>

                <div>
                    <label>Morada: </label>
                    <?php echo $user['address'] ?>
                </div>

                <div>
                    <label>Código Postal: </label>
                    <?php echo $user['postal_code'] ?>
                </div>

                <div>
                    <label>Cidade: </label>
                    <?php echo $user['city'] ?>
                </div>

                <div>
                    <label>NIF: </label>
                    <?php echo $user['nif'] ?>
                </div>

                <div>
                    <label>Permissões: </label>
                    <?php 
                        if ($user["with_permissions"] == 1) {
                            echo "Sim";
                        } else {
                            echo "Não";
                        }
                    ?>
                </div>

                <div>
                    <label>Estado: </label>
                    <?php 
                        if ($user["state"] == 1) {
                            echo "Ativo";
                        } else {
                            echo "Desativo";
                        }
                    ?>
                </div>

            </div>
            <?php } ?>
            
        </aside>
        
    </section>
    

</body>
</html>