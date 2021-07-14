<?php
    require_once('../controller/SubsidiaryController.php');

    $method = $_SERVER['REQUEST_METHOD'];
    $url = $_SERVER["HTTP_REFERER"];
    $pageArray = explode('/', $url);
    $page = $pageArray[count($pageArray) - 1];

    $subsidiary = new SubsidiaryController();

    if($method == 'POST' && empty($_POST['no'])) {
        $result = $subsidiary->register($_POST, $_FILES['img']);
        echo json_encode($result);
    }

    if($method == 'POST' && $_POST['no']) {
        $result = $subsidiary->update($_POST, $_FILES['img']);
        echo json_encode($result);
    }

    if($method == 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $subsidiary->delete($_DELETE['no']);

        echo json_encode($result);
    }

?>