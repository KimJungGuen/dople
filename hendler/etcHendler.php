<?php
    require_once('../controller/etcController.php');

    $method = $_SERVER['REQUEST_METHOD'];
 
    if($method == 'GET'){
        $etc = new etcController();

        $result = $etc->emailDuplicateCheck($_GET['email']);

        //echo json_encode($result);
        echo json_encode($result);
    }
?>