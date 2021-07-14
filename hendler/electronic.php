<?php
    require_once('../controller/orderController.php');

    $method = $_SERVER['REQUEST_METHOD'];
 
    if($method == 'POST'){
        $order = new orderController();

        $result = $order->updateOrderConsent($_POST['userNumber']);

        //echo json_encode($result);
        echo json_encode($result);
    }
?>