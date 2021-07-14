<?php
    require_once('../controller/userController.php');

    $method = $_SERVER['REQUEST_METHOD'];

    $user = new userController();

    if($method == 'POST') {
        $result = $user->register($_POST);
        $data = array(
            'registerResult' => $result
        );

        echo json_encode($data);
    }

    if($method == 'GET') {
        session_start();
        $result = $user->getUser($_SESSION['userNumber']);

        echo json_encode($result); 
    }

    if($method == 'PUT') {
        session_start();
        parse_str(file_get_contents("php://input"), $_PUT);
        $result = $user->update($_PUT, $_SESSION['userNumber']);

        echo json_encode($result);
    }
?>