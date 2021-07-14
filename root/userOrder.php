<?php 
    require_once("./model/HollerOrder.php");

    $model = new HollerOrder();

    $orderList = $model->getsOrder();
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
    <!-- DataTables css -->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive Datatable css -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Switchery css -->
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/flag-icon.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
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
                        <h4 class="page-title">Datatable</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Datatable</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                        <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add</button>
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
                                <h5 class="card-title">Default Data Table</h5>
                            </div>
                            <div class="card-body">
                                <form id="data-form">
                                <h6 class="card-subtitle">With DataTables you can alter the ordering characteristics of the table at initialisation time.</h6>
                                <div class="table-responsive">
                                    <table id="default-datatable" class="display table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Name</th>
                                                <th>Fit</th>
                                                <th>state</th>
                                                <th>produce</th>
                                                <th>create</th>
                                                <th>update</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($orderList as $row) { ?>
                                                <tr>
                                                    <td class="order_<?php echo $row['order_number'] ?> index_0"><?php echo $row['user_email'] ?></td>
                                                    <td class="order_<?php echo $row['order_number'] ?> index_1"><?php echo $row['user_name'] ?></td>
                                                    <td class="order_<?php echo $row['order_number'] ?> index_2">
                                                        <?php 
                                                            if($row['order_model'] == 'undefined') {
                                                                echo  "가공의뢰";
                                                            } else {
                                                                echo $row['order_model'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="order_<?php echo $row['order_number'] ?> index_3">
                                                        <span id="span_index_<?php echo $row['order_number']?>">
                                                            <?php echo $row['order_status'] ?>
                                                        </span>
                                                        <?php $status = array('제작대기중', '제작중', '확인완료', '배송중', '배송완료'); ?>
                                                        <select id="select_index_<?php echo $row['order_number']?>" name="state" style="display:none" disabled>
                                                            <?php foreach($status as $data) { ?> 
                                                                <?php if($data == $row['order_status']) { ?>
                                                                    <option selected><?php echo $data ?></option>
                                                                <?php } else { ?>
                                                                    <option><?php echo $data ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td><?php echo ($row['order_produce'] == 1) ? '생산' : '샘플'; ?></td>
                                                    <td class="order_<?php echo $row['order_number'] ?> index_4"><?php echo $row['order_create'] ?></td>
                                                    <td class="order_<?php echo $row['order_number'] ?> index_5"><?php echo $row['order_update'] ?></td>
                                                    <td style="white-space: nowrap; width: 15%;">
                                                        <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                                <button type="button" class="tabledit-edit-button btn btn-sm btn-info" style="float: none; margin: 5px;" value="<?php echo $row['order_number'] ?>"><span class="ti-pencil"></span></button>
                                                                <button type="button" class="tabledit-delete-button btn btn-sm btn-info" style="float: none; margin: 5px;" value="<?php echo $row['order_number'] ?>"><span class="ti-trash"></span></button>
                                                                <button type="button" class="btn btn-success" style="float: none; margin: 5px; width:35px;" onClick="location.href='orderDetail.php?no=<?php echo $row['order_number'] ?>'"><i class="feather icon-plus mr-2"></i></button> 
                                                            </div>
                                                            <button type="button" class="tabledit-save-button btn btn-sm btn-success index_<?php echo $row['order_number'] ?>" value="<?php echo $row['order_number'] ?>" style="display: none; float: none; margin: 5px;">Save</button>
                                                            <button type="button" class="tabledit-confirm-button btn btn-sm btn-danger index_<?php echo $row['order_number'] ?>" value="<?php echo $row['order_number'] ?>" style="display: none; margin: 5px; float: none;">Confirm</button>
                                                            <button type="button" class="tabledit-restore-button btn btn-sm btn-warning" style="display: none; float: none; margin: 5px;">Restore</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Email</th>
                                                <th>Name</th>
                                                <th>Fit</th>
                                                <th>state</th>
                                                <th>produce</th>
                                                <th>create</th>
                                                <th>update</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Data Export Table</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Fit</th>
                                            <th>state</th>
                                            <th>produce</th>
                                            <th>create</th>
                                            <th>update</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($orderList as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row['user_email'] ?></td>
                                                    <td><?php echo $row['user_name'] ?></td>
                                                    <td><?php echo $row['order_model'] ?></td>
                                                    <td><?php echo $row['order_status'] ?></td>
                                                    <td><?php echo ($row['order_produce'] == 1) ? '생산' : '샘플'; ?></td>
                                                    <td><?php echo $row['order_create'] ?></td>
                                                    <td><?php echo $row['order_update'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
    <!-- Switchery js -->
    <script src="assets/plugins/switchery/switchery.min.js"></script>
    <!-- Datatable js -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables/jszip.min.js"></script>
    <script src="assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/custom/custom-table-datatable.js"></script>
    <!-- Core js -->
    <script src="assets/js/core.js"></script>
    <!-- End js -->
    <script>
        //수정 탭
        $('.tabledit-edit-button').click(function() {
            var exit = true;
            var orderNumber = $(this).val();
            
            $('.tabledit-save-button').each(function() {
                if($(this).css('display') == 'block') {
                    exit = false;
                }
            });

            if($('.btn-primary').length > 0 || exit == false) {
                $('.tabledit-save-button.index_' + orderNumber).hide();

                $('#span_index_' + orderNumber).show();
                $('#select_index_' + orderNumber).hide();
                $('#select_index_' + orderNumber).attr('disabled', true);
                $('#no').remove();

                return false;
            }

            if($('.tabledit-save-button.index_' + orderNumber).css('display') == 'none') {
                $('.tabledit-save-button.index_' + orderNumber).show();

                $('.order_' + orderNumber + '.index_0').append("<input id='no' name='no' type='hidden' value='" + orderNumber + "'>");
                $('#span_index_' + orderNumber).hide();
                $('#select_index_' + orderNumber).show();
                $('#select_index_' + orderNumber).attr('disabled', false);
            }
        });

        //삭제버튼 활성화
        $('.tabledit-delete-button').click(function() {
            var orderNumber = $(this).val();
            if($('.tabledit-confirm-button.index_' + orderNumber).css('display') == 'none') {
                $('.tabledit-confirm-button.index_' + orderNumber).show();
            } else {
                $('.tabledit-confirm-button.index_' + orderNumber).hide();
            }
        });


        //수정
        $('.tabledit-save-button').click(function() {

            $.ajax({
                url: './handler/OrderHandler.php',
                type: 'put',
                data: $('#data-form').serialize(),
                success:function(result){
                    if(result != 'false') {
                        location.reload();
                    }
                }
            });
        });

        //삭제
        $('.tabledit-confirm-button').click(function() {
            $.ajax({
                url: './handler/OrderHandler.php',
                type: 'delete',
                data:{
                    'no': $(this).val()
                },
                success: function(result) {
                    if(result != 'false') {
                        location.reload();
                    }
                }
            });
        });
    </script>
</body>
</html>