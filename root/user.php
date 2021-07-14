<?php
    require_once('./model/HollerUser.php');

    $model = new HollerUser();

    $result = $model->getsUser();
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
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" user="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" user="text/css" />
    <!-- Responsive Datatable css -->
    <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" user="text/css" />
    <!-- Switchery css -->
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" user="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" user="text/css">
    <link href="assets/css/flag-icon.min.css" rel="stylesheet" user="text/css">
    <link href="assets/css/style.css" rel="stylesheet" user="text/css">
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
                    <div class="col-4 text-right"><input user="checkbox" class="js-switch-setting-first" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Low Stock Alerts</h6></div>
                    <div class="col-4 text-right"><input user="checkbox" class="js-switch-setting-second" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Vacation Mode</h6></div>
                    <div class="col-4 text-right"><input user="checkbox" class="js-switch-setting-third" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Order Tracking</h6></div>
                    <div class="col-4 text-right"><input user="checkbox" class="js-switch-setting-fourth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Newsletter Subscription</h6></div>
                    <div class="col-4 text-right"><input user="checkbox" class="js-switch-setting-fifth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Show Review</h6></div>
                    <div class="col-4 text-right"><input user="checkbox" class="js-switch-setting-sixth" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Enable Wallet</h6></div>
                    <div class="col-4 text-right"><input user="checkbox" class="js-switch-setting-seventh" checked /></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-8"><h6 class="mb-0">Sales Report</h6></div>
                    <div class="col-4 text-right"><input user="checkbox" class="js-switch-setting-eightth" checked /></div>
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
                        <button onclick="javascipt:register();" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Add</button>
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
                                <h6 class="card-subtitle">With DataTables you can alter the ordering characteristics of the table at initialisation time.</h6>
                                <form id="data-form">
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="display table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Name</th>
                                                    <th>password</th>
                                                    <th>snstype</th>
                                                    <th>create-date</th>
                                                    <th>update-date</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php 
                                                     //암호화 키 값 생성
                                                    $keyText = 'Pneumonoultramicroscopicsilicovolcanoconiosis';
                                                    $key = substr(hash('sha256', $keyText, true), 0, 32);
                                                ?>
                                                <?php foreach($result as $row) { ?>
                                                    <?php 
                                                        $password = openssl_decrypt(
                                                            base64_decode($row['user_pw']), 
                                                            'aes-256-cbc', 
                                                            $key, 
                                                            true, 
                                                            str_repeat(chr(0), 32)
                                                        );
                                                    ?>
                                                    <tr>
                                                        <td class="user_<?php echo $row['user_number'] ?> index_0"><?php echo $row['user_email'] ?></td>
                                                        <td class="user_<?php echo $row['user_number'] ?> index_1"><?php echo $row['user_name'] ?></td>
                                                        <td class="user_<?php echo $row['user_number'] ?> index_2"><?php echo $password ?></td>
                                                        <td class="user_<?php echo $row['user_number'] ?> index_3"><?php echo $row['user_sns_type'] ?></td>
                                                        <td class="user_<?php echo $row['user_number'] ?> index_3"><?php echo $row['create_date'] ?></td>
                                                        <td class="user_<?php echo $row['user_number'] ?> index_4"><?php echo $row['update_date'] ?></td>
                                                        <td style="white-space: nowrap; width: 15%;">
                                                            <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                                                <div class="btn-group btn-group-sm" style="float: none;">
                                                                    <button type="button" class="tabledit-edit-button btn btn-sm btn-info" style="float: none; margin: 5px;" value="<?php echo $row['user_number'] ?>"><span class="ti-pencil"></span></button>
                                                                    <button type="button" class="tabledit-delete-button btn btn-sm btn-info" style="float: none; margin: 5px;" value="<?php echo $row['user_number'] ?>"><span class="ti-trash"></span></button>
                                                                </div>
                                                                <button type="button" class="tabledit-save-button btn btn-sm btn-success index_<?php echo $row['user_number'] ?>" value="<?php echo $row['user_number'] ?>" style="display: none; float: none; margin: 5px;">Save</button>
                                                                <button type="button" class="tabledit-confirm-button btn btn-sm btn-danger index_<?php echo $row['user_number'] ?>" value="<?php echo $row['user_number'] ?>" style="display: none; margin: 5px; float: none;">Confirm</button>
                                                                <button type="button" class="tabledit-restore-button btn btn-sm btn-warning" style="display: none; float: none; margin: 5px;">Restore</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>sortation</th>
                                                    <th>name</th>
                                                    <th>password</th>
                                                    <th>snstype</th>
                                                    <th>create-date</th>
                                                    <th>update-date</th>
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
                                            <th>password</th>
                                            <th>snstype</th>
                                            <th>create-date</th>
                                            <th>update-date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($result as $row) { ?>
                                                <?php 
                                                    $password = openssl_decrypt(
                                                        base64_decode($row['user_pw']), 
                                                        'aes-256-cbc', 
                                                        $key, 
                                                        true, 
                                                        str_repeat(chr(0), 32)
                                                    );
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['user_email'] ?></td>
                                                    <td><?php echo $row['user_name'] ?></td>
                                                    <td><?php echo $password ?></td>
                                                    <td><?php echo $row['user_sns_type'] ?></td>
                                                    <td><?php echo $row['create_date'] ?></td>
                                                    <td><?php echo $row['update_date'] ?></td>
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
    <script>
        //등록 입력창
        function register() {
            var exit = true;

            $('.tabledit-save-button').each(function() {
                if($(this).css('display') == 'block') {
                    exit = false;
                }
            });

            if($('.btn-primary').length > 0 || exit == false) {
                $('#register-data').remove();
                return false;
            }

            $('#tbody').prepend(
                "<tr id='register-data'>" +
                    "<td><input type='text' id='email' name='email'></td>" +
                    "<td><input type='text' id='name' name='name'></td>" +
                    "<td><input type='text' id='pw' name='pw'></td>" +
                    "<td></td>" +
                    "<td></td>"+
                    "<td><button type='button' id='register' class='btn btn-sm btn-primary'>register</button></td>" +
                "</tr>"
            )
        }

        //세이브 버튼 생성 및 입력폼 활성화
        $('.tabledit-edit-button').click(function() {
            var exit = true;
            var userNumber = $(this).val();
            
            $('.tabledit-save-button').each(function() {
                if($(this).css('display') == 'block') {
                    exit = false;
                }
            });

            if($('.btn-primary').length > 0 || exit == false) {
                $('.tabledit-save-button.index_' + userNumber).hide();

                var email = $('.' + userNumber + '.index_0').val();
                var name = $('.' + userNumber + '.index_1').val();
                var pw = $('.' + userNumber + '.index_2').val();

                $('.user_' + userNumber + '.index_0').html(email);
                $('.user_' + userNumber + '.index_1').html(name);
                $('.user_' + userNumber + '.index_2').html(pw);


                return false;
            }

            if($('.tabledit-save-button.index_' + userNumber).css('display') == 'none') {
                $('.tabledit-save-button.index_' + userNumber).show();

                var email = $('.user_' + userNumber + '.index_0').text();
                var name = $('.user_' + userNumber + '.index_1').text();
                var pw = $('.user_' + userNumber + '.index_2').text();

                $('.user_' + userNumber + '.index_0').html("<input class='" + userNumber + " index_0' name='email' type='text' value='" + email + "'><input name='no' type='hidden' value='" + userNumber + "'>");
                $('.user_' + userNumber + '.index_1').html("<input class='" + userNumber + " index_1' name='name' type='text' value='" + name + "'>");
                $('.user_' + userNumber + '.index_2').html("<input class='" + userNumber + " index_2' name='pw' type='text' value='" + pw + "'>");
                
                return false;
            }
        });

        //삭제버튼 활성화
        $('.tabledit-delete-button').click(function() {
            var userNumber = $(this).val();
            if($('.tabledit-confirm-button.index_' + userNumber).css('display') == 'none') {
                $('.tabledit-confirm-button.index_' + userNumber).show();
            } else {
                $('.tabledit-confirm-button.index_' + userNumber).hide();
            }
        });

        $(document).on("click", "#register", function() {

            $.ajax({
                url: './handler/UserHandler.php',
                type: 'post',
                data: $("#data-form").serialize(),
                success: function(result) {
                    if(result != 'false') {
                        location.reload();
                    } else {
                        return false;
                    }
                }

            });

            return false;
        });

        //업데이트
        $('.tabledit-save-button').click(function() {

            $.ajax({
                url: './handler/UserHandler.php',
                type: 'put',
                data: $("#data-form").serialize(),
                success: function(result) {
                    if(result != 'false') {
                        location.reload();
                    } else {
                        return false;
                    }
                }

            });
        });

         //삭제
         $('.tabledit-confirm-button').click(function() {
            $.ajax({
                url: './handler/UserHandler.php',
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
    <!-- End js -->
</body>
</html>