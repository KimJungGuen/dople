<?php
    require_once('../controller/SizeController.php');

    $method = $_SERVER['REQUEST_METHOD'];

    $size = new SizeController();

    if($method == 'POST' && empty($_POST['no'])) {
        $result = $size->register($_POST);
        echo json_encode($result);
    }

    if($method == 'POST' && $_POST['no']) {
        $result = $size->update($_POST);
        echo json_encode($result);
    }

    if($method == 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $size->delete($_DELETE['no']);

        echo json_encode($result);
    }

?>