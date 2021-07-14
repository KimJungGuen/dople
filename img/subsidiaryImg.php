<?php
    require_once('../dbConnect/hollerOrder.php');

    $subsidiary = new hollerOrder();

    $result = $subsidiary->getSubsidinary($_GET['no']);

    header('Content-Type:' . $result['subsidiary_img_type']);  
    echo $result['subsidiary_img'];
?>