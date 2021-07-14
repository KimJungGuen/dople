<?php
    require_once('../controller/ClothesDetailController.php');

    $method = $_SERVER['REQUEST_METHOD'];

    $clothesDetail = new ClothesDetailController();

    if($method == 'POST' && empty($_POST['no'])) {
        $result = $clothesDetail->register($_POST, $_FILES['img']);
        echo json_encode($result);
    }

    if($method == 'POST' && $_POST['no']) {
        $result = $clothesDetail->update($_POST, $_FILES['img']);
        echo json_encode($result);
    }

    if($method == 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $clothesDetail->delete($_DELETE['no']);

        echo json_encode($result);
    }

?>