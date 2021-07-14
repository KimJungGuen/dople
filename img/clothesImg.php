<?php
    require_once('../dbConnect/hollerOrder.php');

    $clothes = new hollerOrder();

    $result = $clothes->getClothes($_GET['no']);

    header('Content-Type:' . $result['clothes_img_type']);  
    echo $result['clothes_img'];
?>