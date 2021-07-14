<?php 
    require_once('./model/HollerOrder.php');
    require_once('./model/HollerMaterial.php');
    require_once('./model/HollerSubsidiary.php');

    $model = new HollerOrder();
    $materialModel = new HollerMaterial();
    $subsidiaryModel = new HollerSubsidiary();

    $order = $model->getOrder($_GET['no']);

    $orderMaterial = explode('.', $order['order_material_number']);
    $orderSubsidiary = explode('.', $order['order_subsidiary_number']);
    $orderSize = explode('.' , $order['order_size_quantity']);
    $orderGrading = explode('.', $order['order_size_grading']);
    array_pop($orderSize);
    $orderLabel = explode('.', $order['order_label']);
    $orderDetail = explode('.', $order['order_detail_location']);
    
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Soyuz is a bootstrap 4x + laravel admin dashboard template">
    <meta name="keywords" content="admin, admin dashboard, admin panel, admin template, analytics, bootstrap 4, laravel, clean, crm, ecommerce, hospital, responsive, rtl, sass support, ui kits">
    <meta name="author" content="Themesbox17">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Soyuz - Bootstrap 4x + Laravel Admin Dashboard Template</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Start css -->
    <!-- Footable css -->
    <link href="assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
    <!-- Switchery css -->
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/flag-icon.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/css/order-detail.css" rel="stylesheet" type="text/css">
    <!-- End css -->
</head>
<body class="vertical-layout">
    <!-- Start Infobar Setting Sidebar -->
    <div id="infobar-settings-sidebar" class="infobar-settings-sidebar">
        <div class="infobar-settings-sidebar-head d-flex w-100 justify-content-between">
            <h4>Settings</h4><a href="javascript:void(0)" id="infobar-settings-close" class="infobar-settings-close"><img src="assets/images/svg-icon/close.svg" class="img-fluid menu-hamburger-close" alt="close"></a>
        </div>
        <div class="infobar-settings-sidebar-body">
            <div class="custom-mode-setting">
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">New Order Notification</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-first" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Low Stock Alerts</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-second" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Vacation Mode</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-third" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Order Tracking</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-fourth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Newsletter Subscription</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-fifth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Show Review</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-sixth" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Enable Wallet</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-seventh" checked /></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-8"><h6 class="mb-0">Sales Report</h6></div>
                    <div class="col-4 text-right"><input type="checkbox" class="js-switch-setting-eightth" checked /></div>
                </div>
            </div>
            <div class="custom-layout-setting">
                <div class="row align-items-center pb-3">
                    <div class="col-12">
                        <h6 class="mb-3">Select Account</h6>
                    </div>
                    <div class="col-6">
                        <div class="account-box active">
                            <img src="assets/images/users/boy.svg" class="img-fluid" alt="user">
                            <h5>John</h5>
                            <p>CEO</p>
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="account-box">
                            <img src="assets/images/users/women.svg" class="img-fluid" alt="user">
                            <h5>Kate</h5>
                            <p>COO</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="account-box">
                            <img src="assets/images/users/men.svg" class="img-fluid" alt="user">
                            <h5>Mark</h5>
                            <p>MD</p>
                        </div>                        
                    </div>
                    <div class="col-6">
                        <div class="account-box">
                            <p class="dash-analytic-icon"><i class="feather icon-plus font-35"></i></p>
                            <h5>Add</h5>
                            <p>ACCOUNT</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="infobar-settings-sidebar-overlay"></div>
    <!-- End Infobar Setting Sidebar -->
    <!-- Start Containerbar -->
    <div id="containerbar">
        <!-- Start Leftbar -->
        <?php require_once('leftbar.php'); ?>
        <!-- End Leftbar -->
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar Mobile -->
            <?php require_once('toolbar.php') ?>
            <!-- End Topbar -->
            <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">Foo</h4>
                        <!-- <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Foo</li>
                            </ol>
                        </div> -->
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
                        </div>                        
                    </div>
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">                
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Basic</h5>
                            </div>
                            <div class="card-body">
                                <p>Email: <?php echo $order['user_email'] ?> &nbsp;&nbsp;&nbsp; 이름: <?php echo $order['user_name'] ?></p>
                                <p>구분: <?php echo $order['order_sortation'] ?> &nbsp;&nbsp;&nbsp; 주문 종류: <?php echo $order['order_process'] ?>  &nbsp;&nbsp;&nbsp; 배송방식: <?php echo $order['order_delivery'] ?></p>
                                <?php if($order['order_process'] != '가공의뢰') { ?>
                                    <p>카테고리: <?php echo $order['category_name'] ?>&nbsp;&nbsp;&nbsp; 옷 종류: <?php echo $order['clothes_name'] ?> &nbsp;&nbsp;&nbsp; 모델명: <?php echo $order['order_model'] ?></p>
                                    
                                    <?php if($order['order_process'] == '완사입') { ?>
                                        <p>
                                            <?php foreach($orderMaterial as $materialNumber) { ?>
                                                <?php if(!empty($materialNumber)) { ?>
                                                    <?php $material = $materialModel->getMaterial($materialNumber); ?>
                                                    원단 이름: <?php echo $material['material_name'] ?> &nbsp;&nbsp;&nbsp; 원단 종류: <?php echo "<img src='img.php?no={$materialNumber}&sortation=material' width='25'>" ?>  &nbsp;&nbsp;&nbsp;
                                                <?php } ?>
                                            <?php } ?>
                                        </p>
                                        
                                        <p>
                                            <?php foreach($orderSubsidiary as $subsidiaryNumber) { ?>
                                                <?php if(!empty($subsidiaryNumber)) { ?>
                                                    <?php $subsidiary = $subsidiaryModel->getSubsidiary($subsidiaryNumber); ?>
                                                    부자재 이름: <?php echo $subsidiary['subsidiary_name'] ?>&nbsp;&nbsp;&nbsp; 부자재 종류: <?php echo "<img src='img.php?no={$subsidiaryNumber}&sortation=subsidiary' width='25'>" ?> &nbsp;&nbsp;&nbsp;
                                                <?php } ?>
                                            <?php } ?>
                                        </p>

                                        <p>
                                            <?php foreach($orderSize as $size) {?>
                                                <?php echo $size ?>&nbsp;&nbsp;&nbsp;
                                            <?php } ?>
                                            

                                            라벨 종류: <?php if(is_null($orderLabel[0])){ echo 'none'; }   ?>
                                            <?php foreach($orderLabel as $label) { ?>
                                                <?php echo $label ?> &nbsp;
                                            <?php } ?>
                                        </p>

                                        <p>
                                            <?php if($order['order_ml_number'] == 0) {?>
                                                메인 라벨 타입: <?php echo $order['order_ml_type'] ?> &nbsp;&nbsp;&nbsp; 라벨 이미지: <?php echo "<img src='img.php?no={$order['order_number']}&sortation=ml' width='25'>" ?>&nbsp;&nbsp;&nbsp;
                                            <?php } ?>
                                            <?php if($order['order_cl_number'] == 0) {?>
                                                메인 라벨 타입: <?php echo $order['order_cl_type'] ?> &nbsp;&nbsp;&nbsp; 라벨 이미지: <?php echo "<img src='img.php?no={$order['order_number']}&sortation=cl' width='25'>" ?>&nbsp;&nbsp;&nbsp;
                                            <?php } ?>
                                        </p>
                                        <p>
                                            <?php if($order['order_ml_number'] != 0) { ?>
                                                케어라밸 : <img src="img.php?sortation=label&no=<?php echo $order['order_ml_number']?>">&nbsp;
                                            <?php } ?>
                                            <?php if($order['order_cl_number'] != 0) { ?>
                                                케어라밸 : <img src="img.php?sortation=label&no=<?php echo $order['order_cl_number']?>">&nbsp;
                                            <?php } ?>
                                            <?php if($order['order_kl_number'] != 0) { ?>
                                                꼬마라밸 : <img src="img.php?sortation=label&no=<?php echo $order['order_kl_number']?>" height="25px" width="25px">&nbsp;
                                            <?php } ?>
                                        </p>
                                    <?php } ?>
                                    
                                    봉제 방식: <?php echo $order['order_sewing'] ?> &nbsp;&nbsp;&nbsp;
                                    <br>
                                    <div style="border:1px solid black; width:20%;">
                                        그레이딩 사이즈: <select id="grading">
                                            <?php foreach($orderSize as $size) {?>
                                                <?php $option = explode(':', $size); ?>
                                                <option><?php echo $option[0] ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php foreach($orderGrading as $grading) { ?>
                                            <?php
                                                $gradingArray = explode('-', $grading);
                                                $gradingSize = explode(':', $gradingArray[1]);
                                                $id = $gradingSize[0];

                                                switch($gradingArray[0]) {
                                                    case 'size_shoulder_width': $gradingName = '어깨넓이: ' . $gradingSize[1];
                                                        break;
                                                    case 'size_chest': $gradingName = '가슴둘레: ' . $gradingSize[1];
                                                        break;
                                                    case 'size_bottom_width': $gradingName = '하단넓이: ' . $gradingSize[1];
                                                        break;
                                                    case 'size_total_length': $gradingName = '총장: ' . $gradingSize[1];
                                                        break;
                                                    case 'size_neck_hole': $gradingName = '낵홀: ' . $gradingSize[1];
                                                        break;
                                                    case 'size_arm_hole': $gradingName = '암홀: ' . $gradingSize[1];
                                                        break;
                                                    case 'size_sleeve_length': $gradingName = '소매길이: ' . $gradingSize[1]; 
                                                        break;
                                                    case 'size_sleeve_width': $gradingName = '소내넓이: ' . $gradingSize[1];
                                                        break;
                                                    case 'size_shibori': $gradingName = '시보리: ' . $gradingSize[1];
                                                        break;
                                                    case 'size_neck_depth': $gradingName = '목 깊이: ' . $gradingSize[1];
                                                        break;
                                                    default: break;
                                                }
                                                
                                            ?>
                                            <p class="<?php echo $id ?> grading"><?php echo $id . $gradingName ?></p>
                                        <?php } ?>
                                    </div>
                                    <br>
                                <?php } ?>
                                <?php 
                                    $locationTop = explode('.', $order['order_pd_top']);
                                    $locationLeft = explode('.', $order['order_pd_left']);
                                    $scaleX = explode('.', $order['order_pd_sx']);
                                    $scaleY = explode('.', $order['order_pd_sy']);
                                    $angles = explode('.', $order['order_pd_angle']);

                                    array_pop($locationTop);
                                    array_pop($locationLeft);
                                    array_pop($scaleX);
                                    array_pop($scaleY);
                                    array_pop($angle);

                                    foreach($locationTop as $top) {
                                        $top = explode(':', $top);
                                        echo "<input type='hidden' id='{$top[0]}' class='location_top' value='{$top[1]}'>";
                                    }

                                    foreach($locationLeft as $left) {
                                        $left = explode(':', $left);
                                        echo "<input type='hidden' id='{$left[0]}' class='location_left' value='{$left[1]}'>";
                                    }

                                    foreach($scaleX as $scale) {
                                        $X = explode(':', $scale);
                                        echo "<input type='hidden' id='{$X[0]}' class='scale_x' value='{$X[1]}'>";
                                    }

                                    foreach($scaleY as $scale) {
                                        $Y = explode(':', $scale);
                                        echo "<input type='hidden' id='{$Y[0]}' class='scale_x' value='{$Y[1]}'>";
                                    }

                                    foreach($angles as $angle) {
                                        $result = explode(':', $angle);
                                        echo "<input type='hidden' id='{$result[0]}' class='angle' value='{$result[1]}'>";
                                    }
                                ?>
                                <div class="img-wrapper">
                                    앞<img id="fornt_img" src="assets/images/order-detail/thumb-1.jpg">
                                    <div id="front-area">
                                        <canvas id="front-canvas" class="canvas" width="150" height="200" data-top="front-top" data-left="front-left" data-x='front-scaleX' data-y='front-scaleY' data-angle="front-angle"> </canvas>
                                    </div>
                                    <img id="front-canvas-img" class="bkg" src="img.php?no=<?php echo $order['order_number']?>&sortation=location&location=front" style="display: none;">
                                </div>

                                <div class="img-wrapper">
                                    뒤<img src="assets/images/order-detail/thumb-2.jpg">
                                    <div id="back_area">
                                        <canvas id="back-canvas" class="canvas" width="150" height="200" data-top="back-top" data-left="back-left" data-x='back-scaleX' data-y='back-scaleY' data-angle="back-angle"> </canvas>
                                    </div>
                                    <img id="back-canvas-img" class="bkg" src="img.php?no=<?php echo $order['order_number']?>&sortation=location&location=back" style="display: none;">
                                </div>

                                <div class="img-wrapper">
                                    좌<img src="assets/images/order-detail/side_1.jpg">
                                    <div id="left_area">
                                        <canvas id="left-canvas" class="canvas" width="75" height="260" data-top="left-top" data-left="left-left" data-x='left-scaleX' data-y='left-scaleY' data-angle="left-angle" > </canvas>
                                    </div>
                                    <img id="lfet-canvas-img" class="bkg" src="img.php?no=<?php echo $order['order_number']?>&sortation=location&location=left" style="display: none;">
                                </div>

                                <div class="img-wrapper">
                                    우<img src="assets/images/order-detail/side_2.jpg">
                                    <div id="right_area">
                                        <canvas id="right-canvas" class="canvas" width="75" height="260" data-top="right-top" data-left="right-left" data-x='right-scaleX' data-y='right-scaleY' data-angle="right-angle"> </canvas>
                                    </div>
                                    <img id="right-canvas-img" class="bkg" src="img.php?no=<?php echo $order['order_number']?>&sortation=location&location=right" style="display: none;">
                                </div>
                                
                                <br>
                                <p>
                                    <?php 
                                        foreach($orderDetail as $detail) { 
                                            $detailValue = explode(':', $detail);
                                            switch($detail) {
                                                case'':
                                                    break;
                                                case strpos($detail, 'front'): echo "상세가공 위치 앞: {$detailValue[1]}&nbsp;&nbsp;&nbsp;"; 
                                                    break;
                                                case strpos($detail, 'back'): echo "상세가공 위치 뒤: {$detailValue[1]}&nbsp;&nbsp;&nbsp;"; 
                                                    break;
                                                case strpos($detail, 'right'): echo "상세가공 위치 오른쪽: {$detailValue[1]}&nbsp;&nbsp;&nbsp;"; 
                                                    break;
                                                case strpos($detail, 'left'): echo "상세가공 위치 왼쪽: {$detailValue[1]}&nbsp;&nbsp;&nbsp;"; 
                                                    break;
                                                default:
                                                    break;
                                            }
                                        }
                                    ?>
                                </p>

                                
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
            <div class="footerbar">
                <footer class="footer">
                    <p class="mb-0">© 2020 Soyuz - All Rights Reserved.</p>
                </footer>
            </div>
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/vertical-menu.js"></script>
    <script src="assets/js/fabric.js"></script>
    <!-- Switchery js -->
    <script src="assets/plugins/switchery/switchery.min.js"></script>
    <!-- Footable js -->
    <script src="assets/plugins/moment/moment.js"></script>     
    <script src="assets/plugins/footable/js/footable.min.js"></script>     
    <script src="assets/js/custom/custom-table-footable.js"></script>    
     <!-- Core js -->
    <script src="assets/js/core.js"></script>
    <script>
        $(function() {
            $('.grading').hide();
            $('.' + $('#grading').val()).show();
        });

        $(document).ready(function() {

            $('canvas').each(function() {  
                var id = $(this).attr('id');
                var canvas = new fabric.Canvas(id);    
                var img = $(this).closest('.img-wrapper').find('.bkg')[0];

                var top = $('#' + $(this).data('top')).val();
                var left = $('#' + $(this).data('left')).val();
                
                var x = $('#' + $(this).data('x')).val() / 100000;
                var y = $('#' + $(this).data('y')).val() / 100000;

                var angle = $('#' + $(this).data('angle')).val();

                var imgInstance = new fabric.Image(img, {
                    left: Number(left),
                    top: Number(top),
                    scaleX: Number(x),
                    scaleY: Number(y),
                    angle: Number(angle)
                });
                
                canvas.add(imgInstance);
                canvas.item(0).selectable = false;
                canvas.renderAll();
            });
        });
        $('#grading').change(function() {
            $('.grading').hide();
            $('.' + $(this).val()).show();
        });
    </script>
    <!-- End js -->
</body>
</html>