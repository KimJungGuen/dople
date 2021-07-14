<?php
    require_once('../dbConnect/hollerOrder.php');

    $fit = new hollerOrder();

    $result = $fit->getFit($_GET['no']);

    header('Content-Type:' . $result['fit_img_type']);  
    echo $result['fit_img'];
?>