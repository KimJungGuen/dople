<?php
    require_once('../controller/FitController.php');

    $method = $_SERVER['REQUEST_METHOD'];

    $fit = new FitController();

    if($method == 'POST' && empty($_POST['no'])) {
        $result = $fit->register($_POST, $_FILES['img']);
        echo json_encode($result);
    }

    if($method == 'POST' && $_POST['no']) {
        $result = $fit->update($_POST, $_FILES['img']);
        echo json_encode($result);
    }

    if($method == 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $fit->delete($_DELETE['no']);

        echo json_encode($result);
    }

?>