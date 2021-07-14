<?php
    require_once('../controller/UserController.php');

    $method = $_SERVER['REQUEST_METHOD'];

    $user = new UserController();
    if($method == 'POST') {
        $result = $user->register($_POST);

        echo json_encode($result);
    }

    if($method == 'PUT') {
        parse_str(file_get_contents("php://input"), $_PUT);
        $result = $user->update($_PUT);

        echo json_encode($result);
    }

    if($method == 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $user->delete($_DELETE['no']);

        echo json_encode($result);
    }
?>