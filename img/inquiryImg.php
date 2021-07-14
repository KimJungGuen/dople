<?php
    require_once('../dbConnect/hollerService.php');

    $service = new hollerService();

    $result = $service->getInquiryImg($_GET['no'], $_GET['img']);

    header('Content-Type:' . $result["inquiry_img_type_{$_GET['img']}"]);  
    echo $result["inquiry_img_{$_GET['img']}"];

?>