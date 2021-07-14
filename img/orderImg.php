<?php
    require_once('../dbConnect/hollerOrder.php');

    $order = new hollerOrder();

    if($_GET['sortation'] == 'main') {
        $result = $order->getMainLabel($_GET['no']);
        header('Content-Type:' . $result['order_ml_img_type']);  
        echo $result['order_ml_img'];
    }

    if($_GET['sortation'] == 'care') {
        $result = $order->getCareLabel($_GET['no']);
        header('Content-Type:' . $result['order_cl_img_type']);  
        echo $result['order_cl_img'];
    }
    
    if($_GET['sortation'] == 'process') {
        switch($_GET['location']) {
            case'front': 
                $img =  'order_pd_fi';
                $type = 'order_pd_fi_type';
                break;
            case'back': 
                $img =  'order_pd_bi';
                $type = 'order_pd_bi_type';
                break;
            case'left': 
                $img =  'order_pd_li';
                $type = 'order_pd_li_type';
                break;
            case'right': 
                $img =  'order_pd_ri';
                $type = 'order_pd_ri_type';
                break;
            default: break;
        }
        
        $result = $order->getPD($_GET['no'], $img, $type);
        header('Content-Type:' . $result[$type]);  
        echo $result[$img];
   }

   if($_GET['category'] == 'label') {
        $result = $order->getLabel($_GET['no']);
        header('Content-Type:' . $result['label_img_type']);  
        echo $result['label_img'];
   }
?>