<?php
    require_once('../controller/TypeController.php');

    $method = $_SERVER['REQUEST_METHOD'];

    $type = new TypeController();
    if($method == 'POST') {
        $result = $type->register($_POST);

        echo json_encode($result);
    }

    if($method == 'PUT') {
        parse_str(file_get_contents("php://input"), $_PUT);
        $result = $type->update($_PUT);

        echo json_encode($result);
    }

    if($method == 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $type->delete($_DELETE['no']);

        echo json_encode($result);
    }
?>