<?php
    require_once('../dbConnect/hollerOrder.php');

    $category = new hollerOrder();

    $result = $category->getCategory($_GET['no']);

    header('Content-Type:' . $result['category_img_type']);  
    echo $result['category_img'];
?>