<?php
    require_once('../controller/AdminController.php');

    $method = $_SERVER['REQUEST_METHOD'];

    $admin = new AdminController();

    if($method == 'POST') {
        $result = $admin->register($_POST);

        echo json_encode($result);
    }
?>