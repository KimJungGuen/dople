<?php
    require_once('../controller/OrderController.php');

    $method = $_SERVER['REQUEST_METHOD'];
    $url = $_SERVER["HTTP_REFERER"];
    
    $order = new OrderController();

    if($method == 'PUT') {
        parse_str(file_get_contents("php://input"), $_PUT);
        $result = $order->update($_PUT);
        
        echo json_encode($result);
    }


    if($method == 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);

        $result = $order->delete($_DELETE['no']);

        echo json_encode($result);
    }

?>