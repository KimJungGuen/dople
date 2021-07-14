<?php
    require_once('../controller/LoginController.php');

    $method = $_SERVER['REQUEST_METHOD'];
    $login = new LoginController();

    if($method == 'POST') {
        $result = $login->login($_POST);

        echo json_encode($result);
    }

    if($method == 'DELETE') {
        $result = $login->logout();

        echo json_encode($result);
    }
?>