<?php
include_once "../../common/ConnectionBD1.php";
include_once "../../common/Validations.php";
//include_once "../Actions/ActionsProducts.php";
//$products = new ActionsProducts;

function redirectToPage($page) {
    header("Location: $page");
    exit();
}

$emailUsername = test_input($_REQUEST["emailUsername"]);
$password = test_input($_REQUEST["password"]);
$missingLogin = $_REQUEST["missingLogin"];

if (empty($emailUsername) || empty($password)) {
    echo "dadosVazios";
} else {
    $infoUser = searchInfoUser($emailUsername);

    if (count($infoUser) > 0) {
        $id = $infoUser[0];
        $hashPassword = $infoUser[1];
        $permission = $infoUser[2];
        $state = $infoUser[3];

        if (password_verify($password, $hashPassword)) {
            if ($state == 0) {
                echo "contaDesativada";
            } else {
                session_start();
                $_SESSION["id"] = $id;
                $_SESSION["login"] = true;
                $_SESSION["permission"] = $permission;

                if ($permission == 0) {
                    $_SESSION["products"] = array();

                    if (isset($_COOKIE["products"])) {
                        // $products->actionGetCartProducts() based on your implementation
                        $_SESSION["products"] = $products->actionGetCartProducts();
                    }

                    if ($missingLogin == "false") {
                        echo "dadosCertosCliente";
                    } else {
                        echo "dadosCertosClienteCompras";
                    }
                } elseif ($permission == 1) {
                    echo "dadosCertosAdmin";
                } elseif ($permission == 2) {
                    echo "dadosCertosEmpresa";
                } elseif ($permission == 3) {
                    echo "dadosCertosDocente";
                } else {
                    echo "dadosErrados";
                }
            }
        } else {
            echo "dadosErrados";
        }
    } else {
        echo "dadosErrados";
    }
}

function searchInfoUser($emailUsername) {
    $db = new ConnectionBD1;
    $db->createConnection();

    $db->preparedStmt("SELECT id, password, with_permissions, state FROM user WHERE email = ? or username = ?");
    $db->stmt->bind_param("ss", $emailUsername, $emailUsername);
    $db->executeStmt();

    $result = $db->stmt->get_result();

    $infoUser = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($infoUser,
                $row["id"],
                $row["password"],
                $row["with_permissions"],
                $row["state"]
            );
        }
    }

    $db->closeStmt();
    $db->closeConnection();

    return $infoUser;
}
?>
