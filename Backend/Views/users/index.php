        <?php 
            include "../site/menu.php"; 
            include_once "../../Actions/ActionUsers.php"; 
        ?>

        <aside class="backend-aside">
            <h1>Utilizadores</h1>

            <table class="tableData table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Utilizador</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Permissões</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $actionUsers = new ActionUsers;

                    $allUsers = $actionUsers->getAllUsers();

                    if (count($allUsers) > 0) {
                        $i = 1;
                        foreach($allUsers as $user)
                        {
                        ?>
                            <tr>
                                <td> <?php echo $i ?> </td>
                                <td> <?php echo $user["username"] ?> </td>
                                <td> <?php echo $user["email"] ?> </td>
                                <td> <?php echo $user["name"] ?> </td>
                                <td> 
                                    <?php
                                    if ($user["with_permissions"] == 1) { ?>
                                        <input type="checkbox" id="check-<?php echo $user['id']?>" name="checkPermission" value="1" data-id="<?php echo $user['id'] ?>" data-permission="0" checked="checked">
                                        <label for="check-<?php echo $user['id']?>" id="label-<?php echo $user['id']?>">Sim</label>
                                    <?php } else { ?>
                                        <input type="checkbox" id="check-<?php echo $user['id']?>" name="checkPermission" value="0" data-id="<?php echo $user['id'] ?>" data-permission="1">
                                        <label for="check-<?php echo $user['id']?>" id="label-<?php echo $user['id']?>">Não</label>
                                    <?php } 
                                    
                                    ?>
                                </td>
                                <td> 
                                    <?php
                                    echo '<a href="view.php?id='.$user["id"].'" class="btn btn-primary span-margin btn-margin"><span class="glyphicon glyphicon-eye-open"></span> Ver</a>';
                                    if ($user["state"] == 1) {
                                        echo '<a href="delete.php?id='.$user["id"].'&state=0" class="btn btn-danger span-margin btn-margin"><span class="glyphicon glyphicon-unchecked"></span> Desativar</a>';
                                    } else {
                                        echo '<a href="delete.php?id='.$user["id"].'&state=1" class="btn btn-success span-margin btn-margin"><span class="glyphicon glyphicon-check"></span> Ativar</a>';
                                    }
                                    
                                    ?>
                                </td>
                            </tr>
                        <?php
                        $i++;
                        }

                    } else {
                        ?>
                        <td colspan="5" align="center"> 0 results </td>
                        <?php
                    }

                    ?>

                </tbody>
            </table>
        </aside>
    </section>

</body>
</html>

<script>
$('[name=checkPermission]').change().click(function() {
    var id = $(this).data("id");
    if ($(this).prop("checked")) {
        var permission = 1;
    } else {
        var permission = 0;
    }
    var permission = $(this).data("permission");

    $.ajax({
        url: "../../Handler/userHandler.php",
        type: "POST",
        data: {id: id, permission: permission, method: "changePermissions"},
        dataType: "",
        success: function(response) {
            if (permission == 0) {
                $("#label-" + id).text("Não");
                $("#check-" + id).prop("checked", false)
            } else {
                $("#label-" + id).text("Sim");
                $("#check-" + id).prop("checked", true);
            }
            
        }
                       
    });

    return false;

});
</script>