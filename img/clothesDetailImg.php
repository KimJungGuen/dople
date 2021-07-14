<?php
    require_once('../dbConnect/hollerOrder.php');

    $clothes = new hollerOrder();

    $result = $clothes->getClothesDetail($_GET['no']);

    header('Content-Type:' . $result['clothes_detail_img_type']);  
    echo $result['clothes_detail_img'];
?>