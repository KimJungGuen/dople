<?php

    $url = $_SERVER["HTTP_REFERER"];
    $pageArray = explode('/', $url);
    $page = $pageArray[count($pageArray) - 1];

    if($page == 'category.php') {
        require_once('./model/HollerCategory.php');
        $category = new HollerCategory();

        $result = $category->getCategory($_GET['no']);

        header('Content-Type:' . $result['category_img_type']);  
        echo $result['category_img'];
    }

    if($page == 'clothes.php') {
        require_once('./model/HollerClothes.php');
        $clothes = new HollerClothes();

        $result = $clothes->getClothes($_GET['no']);

        header('Content-Type:' . $result['clothes_img_type']);  
        echo $result['clothes_img'];

    }

    if($page == 'fit.php') {
        require_once('./model/HollerFit.php');
        $fit = new HollerFit();

        $result = $fit->getFit($_GET['no']);

        header('Content-Type:' . $result['fit_img_type']);  
        echo $result['fit_img'];

    }

    if($page == 'material.php') {
        require_once('./model/HollerMaterial.php');
        $fit = new HollerMaterial();

        $result = $fit->getMaterial($_GET['no']);

        header('Content-Type:' . $result['material_img_type']);  
        echo $result['material_img'];

    }

    if($page == 'subsidiary.php') {
        require_once('./model/HollerSubsidiary.php');
        $fit = new HollerSubsidiary();

        $result = $fit->getSubsidiary($_GET['no']);

        header('Content-Type:' . $result['subsidiary_img_type']);  
        echo $result['subsidiary_img'];

    }

    if($page == 'clothesDetail.php') {
        require_once('./model/HollerClothesDetail.php');
        $clothesDetail = new HollerClothesDetail();

        $result = $clothesDetail->getClothesDetail($_GET['no']);

        header('Content-Type:' . $result['clothes_detail_img_type']);  
        echo $result['clothes_detail_img'];

    }
    
    if($_GET['sortation'] == 'material') {
        require_once('./model/HollerMaterial.php');
        $material = new HollerMaterial();

        $result = $material->getMaterial($_GET['no']);

        header('Content-Type:' . $result['material_img_type']);  
        echo $result['material_img'];

    }

    if($_GET['sortation'] == 'subsidiary') {
        require_once('./model/HollerSubsidiary.php');
        $subsidiary = new HollerSubsidiary();

        $result = $subsidiary->getSubsidiary($_GET['no']);

        header('Content-Type:' . $result['subsidiary_img_type']);  
        echo $result['subsidiary_img'];

    }

    if($_GET['sortation'] == 'ml') {
        require_once('./model/HollerOrder.php');
        $mainLabel = new HollerOrder();

        $result = $mainLabel->getMainLabel($_GET['no']);

        header('Content-Type:' . $result['order_ml_img_type']);  
        echo $result['order_ml_img'];

    }

    if($_GET['sortation'] == 'cl') {
        require_once('./model/HollerOrder.php');
        $mainLabel = new HollerOrder();

        $result = $mainLabel->getCareLabel($_GET['no']);

        header('Content-Type:' . $result['order_cl_img_type']);  
        echo $result['order_cl_img'];

    }

    if($_GET['sortation'] == 'location') {
        require_once('./model/HollerOrder.php');
        $pd = new HollerOrder();

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
        
        $result = $pd->getPD($_GET['no'], $img, $type);

        header('Content-Type:' . $result[$type]);  
        echo $result[$img];

    }

    if($page == 'label.php' || $_GET['sortation'] == 'label') {
        require_once('./model/HollerLabel.php');
        $label = new HollerLabel();

        $result = $label->getLabel($_GET['no']);

        header('Content-Type:' . $result['label_img_type']);  
        echo $result['label_img'];
    }
    
?>