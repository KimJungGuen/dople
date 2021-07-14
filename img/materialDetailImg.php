<?php
    require_once('../dbConnect/hollerOrder.php');

    $material = new hollerOrder();

    $result = $material->getMaterial($_GET['no']);

    header('Content-Type:' . $result['material_img_type']);  
    echo $result['material_img'];
?>