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
                                                    <th>Name</th>
                                                    <th>icon</th>
                                                    <th>rate</th>
                                                    <th>create-date</th>
                                                    <th>update-date</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>icon</th>
                                                    <th>rate</th>
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
                                            <th>Name</th>
                                            <th>icon</th>
                                            <th>rate</th>
                                            <th>create-date</th>
                                            <th>update-date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($result as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row['category_name'] ?></td>
                                                    <td><?php echo "<img src='img.php?no={$row['category_number']}' width='25'" ?></td>
                                                    <td><?php echo $row['category_rate'] ?></td>
                                                    <td><?php echo $row['category_create'] ?></td>
                                                    <td><?php echo $row['category_update'] ?></td>
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

        //카테고리 데이터 불러오기 
        $(function() {
            $.ajax({
                url: './handler/CategoryHandler.php',
                type: 'get',
                success: function(result) {
                    result = JSON.parse(result);

                    $('.dataTables_empty').remove();

                    $.each(result, function(index, item) {
                        if(item.category_update == null) {
                            item.category_update = '';
                        }

                        $('#tbody').append(
                            "<tr>" +
                                "<td class='category_" + item.category_number + " index_0'>" + item.category_name + "</td>" +
                                "<td class='category_img_" + item.category_number + " index_1'><img src='img.php?no=" + item.category_number + "' width='25'></td>" +
                                "<td class='category_" + item.category_number + " index_2'>" + item.category_rate + "</td>" +
                                "<td class='category_" + item.category_number + " index_3'>" + item.category_create + "</td>" +
                                "<td class='category_" + item.category_number + " index_4'>" + item.category_update + "</td>" +
                                "<td style='white-space: nowrap; width: 15%;'>" +
                                    "<div class='tabledit-toolbar btn-toolbar' style='text-align: left;'>" +
                                        "<div class='btn-group btn-group-sm' style='float: none;'>" +
                                            "<button type='button' class='tabledit-edit-button btn btn-sm btn-info' style='float: none; margin: 5px;' value='" + item.category_number + "'><span class='ti-pencil'></span></button>" +
                                            "<button type='button' class='tabledit-delete-button btn btn-sm btn-info' style='float: none; margin: 5px;' value='" + item.category_number + "'><span class='ti-trash'></span></button>" +
                                        "</div>" +
                                        "<button type='button' class='tabledit-save-button btn btn-sm btn-success index_" + item.category_number + "' value='" + item.category_number + "' style='display: none; float: none; margin: 5px;'>Save</button>" +
                                        "<button type='button' class='tabledit-confirm-button btn btn-sm btn-danger index_" + item.category_number + "' value='" + item.category_number + "' style='display: none; margin: 5px; float: none;'>Confirm</button>" +
                                        "<button type='button' class='tabledit-restore-button btn btn-sm btn-warning' style='display: none; float: none; margin: 5px;'>Restore</button>" +
                                    "</div>" +
                                "</td>" +
                            "</tr>"
                        );
                    });

                    
                   
                }

            });
        });

        //등록
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
                    "<td><input type='text' id='name' name='name'></td>" +
                    "<td><input type='file' id='img' name='img'></td>" +
                    "<td></td>" +
                    "<td></td>" +
                    "<td></td>" +
                    "<td><button type='button' id='register' class='btn btn-sm btn-primary'>register</button></td>" +
                "</tr>"
            )
        }

        //세이브 버튼 생성 및 입력폼 활성화
        $(document).on('click', '.tabledit-edit-button', function() {
            var exit = true;
            var categoryNumber = $(this).val();
            console.log(categoryNumber);
            $('.tabledit-save-button').each(function() {
                if($(this).css('display') == 'block') {
                    exit = false;
                }
            });

            if($('.btn-primary').length > 0 || exit == false) {
                $('.tabledit-save-button.index_' + categoryNumber).hide();

                var name = $('.' + categoryNumber + '.index_0').val();
                var rate = $('.' + categoryNumber + '.index_2').val();

                $('.category_' + categoryNumber + '.index_0').html(name);
                $('.category_img_' + categoryNumber + '.index_1').html("<img src='img.php?no=" + categoryNumber + "'width='25'>");
                $('.category_' + categoryNumber + '.index_2').html(rate);

                return false;
            }

            if($('.tabledit-save-button.index_' + categoryNumber).css('display') == 'none') {
                $('.tabledit-save-button.index_' + categoryNumber).show();

                var name = $('.category_' + categoryNumber + '.index_0').text();
                var rate = $('.category_' + categoryNumber + '.index_2').text();

                $('.category_' + categoryNumber + '.index_0').html("<input class='" + categoryNumber + " index_0' name='name' type='text' value='" + name + "'><input name='no' type='hidden' value='" + categoryNumber + "'>");
                $('.category_img_' + categoryNumber + '.index_1').html("<input class='" + categoryNumber + " index_1' name='img' type='file'>");
                $('.category_' + categoryNumber + '.index_2').html("<input class='" + categoryNumber + " index_2' name='rate' type='text' value='" + rate + "'>");
            }
        });

        //삭제버튼 활성화
        $(document).on('click', '.tabledit-delete-button', function() {
            var categoryNumber = $(this).val();
            if($('.tabledit-confirm-button.index_' + categoryNumber).css('display') == 'none') {
                $('.tabledit-confirm-button.index_' + categoryNumber).show();
            } else {
                $('.tabledit-confirm-button.index_' + categoryNumber).hide();
            }
        });

        $(document).on("click", "#register", function() {
            var form = $('#data-form')[0];
            var formData = new FormData(form);

            $.ajax({
                url: './handler/CategoryHandler.php',
                type: 'post',
                enctype: 'multipart/form-data',
                contentType : false,
                processData : false,
                data: formData,
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
        $(document).on('click', '.tabledit-save-button', function() {
            var form = $('#data-form')[0];
            var formData = new FormData(form);

            $.ajax({
                url: './handler/CategoryHandler.php',
                type: 'post',
                enctype: 'multipart/form-data',
                contentType : false,
                processData : false,
                data: formData,
                success:function(result){
                    if(result != 'false') {
                        location.reload();
                    }
                }
            });
        });

        //삭제
        $(document).on('click', '.tabledit-confirm-button', function() {
            $.ajax({
                url: './handler/CategoryHandler.php',
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