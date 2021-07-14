<?php
    require_once('../controller/LabelController.php');

    $method = $_SERVER['REQUEST_METHOD'];

    $label = new LabelController();

    if($method == 'POST' && empty($_POST['no'])) {
        $result = $label->register($_POST, $_FILES['img']);
        echo json_encode($result);
    }

    if($method == 'POST' && $_POST['no']) {
        $result = $label->update($_POST, $_FILES['img']);
        echo json_encode($result);
    }

    if($method == 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $label->delete($_DELETE['no']);

        echo json_encode($result);
    }

?>