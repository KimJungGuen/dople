<?php
    require_once('./model/HollerMaterial.php');
    require_once('./model/HollerType.php');
    $material = new HollerMaterial();
    $type = new HollerType();

    $result = $material->getsMaterial();
    $typeList = $type->getsTypeSelect('material');
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
                                                    <th>Type</th>
                                                    <th>name</th>
                                                    <th>icon</th>
                                                    <th>rate</th>
                                                    <th>sortation</th>
                                                    <th>create-date</th>
                                                    <th>update-date</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php foreach($result as $row) { ?>
                                                    <?php 
                                                        $sortation = "";

                                                        switch($row['material_sortation']) {
                                                            case 'choice': $sortation = "선택";
                                                                break;
                                                            case 'confirmation': $sortation = "확정";
                                                                break;
                                                            default:
                                                                break;
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <span class="span_index_<?php echo $row['material_number'] ?>">
                                                                <?php 
                                                                    foreach($typeList as $data) { 
                                                                        if($row['material_type'] == $data['type_value']) {
                                                                            echo $data['type_name'];
                                                                        }
                                                                    }
                                                                ?>
                                                            </span>
                                                            <select id="type" name="type" class="select_index_<?php echo $row['material_number'] ?>" style="display:none" disabled>
                                                                <?php foreach($typeList as $data) { ?>
                                                                    <?php if($row['material_type'] == $data['type_value']) { ?>
                                                                        <option value="<?php echo $data['type_value'] ?>" selected>
                                                                            <?php echo $data['type_name'] ?>
                                                                        </option>
                                                                    <?php } else { ?>
                                                                        <option value="<?php echo $data['type_value'] ?>">
                                                                            <?php echo $data['type_name'] ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td class="material_<?php echo $row['material_number'] ?> index_0"><?php echo $row['material_name'] ?></td>
                                                        <td class="material_img_<?php echo $row['material_number'] ?> index_1"><?php echo "<img src='img.php?no={$row['material_number']}' width='25'" ?></td>
                                                        <td class="material_<?php echo $row['material_number'] ?> index_2"><?php echo $row['material_rate'] ?></td>
                                                        <td>
                                                            <span class="span_index_<?php echo $row['material_number'] ?>">
                                                                <?php  echo $sortation ?>
                                                            </span>
                                                            <select id="sortation" name="sortation" class="select_index_<?php echo $row['material_number'] ?>" style="display:none" disabled>
                                                                <?php if($sortation == 'choice') { ?>
                                                                    <option value="choice" selected> 선택 </option>
                                                                    <option value="confirmation"> 확정 </option>
                                                                <?php }  else { ?>
                                                                    <option value="choice"> 선택 </option>
                                                                    <option value="confirmation" selected> 확정 </option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td class="material_<?php echo $row['material_number'] ?> index_3"><?php echo $row['material_create'] ?></td>
                                                        <td class="material_<?php echo $row['material_number'] ?> index_4"><?php echo $row['material_update'] ?></td>
                                                        <td style="white-space: nowrap; width: 15%;">
                                                            <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                                                <div class="btn-group btn-group-sm" style="float: none;">
                                                                    <button type="button" class="tabledit-edit-button btn btn-sm btn-info" style="float: none; margin: 5px;" value="<?php echo $row['material_number'] ?>"><span class="ti-pencil"></span></button>
                                                                    <button type="button" class="tabledit-delete-button btn btn-sm btn-info" style="float: none; margin: 5px;" value="<?php echo $row['material_number'] ?>"><span class="ti-trash"></span></button>
                                                                </div>
                                                                <button type="button" class="tabledit-save-button btn btn-sm btn-success index_<?php echo $row['material_number'] ?>" value="<?php echo $row['material_number'] ?>" style="display: none; float: none; margin: 5px;">Save</button>
                                                                <button type="button" class="tabledit-confirm-button btn btn-sm btn-danger index_<?php echo $row['material_number'] ?>" value="<?php echo $row['material_number'] ?>" style="display: none; margin: 5px; float: none;">Confirm</button>
                                                                <button type="button" class="tabledit-restore-button btn btn-sm btn-warning" style="display: none; float: none; margin: 5px;">Restore</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>name</th>
                                                    <th>icon</th>
                                                    <th>rate</th>
                                                    <th>sortation</th>
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
                                            <th>Type</th>
                                            <th>name</th>
                                            <th>icon</th>
                                            <th>rate</th>
                                            <th>sortation</th>
                                            <th>create-date</th>
                                            <th>update-date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($result as $row) { ?>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                            foreach($typeList as $data) { 
                                                                if($row['material_type'] == $data['type_value']) {
                                                                    echo $data['type_name'];
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['material_name'] ?></td>
                                                    <td><?php echo "<img src='img.php?no={$row['material_number']}' width='25'" ?></td>
                                                    <td><?php echo $row['material_rate'] ?></td>
                                                    <td></td>
                                                    <td><?php echo $row['material_create'] ?></td>
                                                    <td><?php echo $row['material_update'] ?></td>
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
                    "<td><select id='type' name='type'>" +
                        <?php foreach($typeList as $data) { ?> 
                            "<option value='<?php echo $data['type_value'] ?>'><?php echo $data['type_name'] ?></option>" +
                        <?php } ?>
                    "</select></td>" +
                    "<td><input type='text' id='name' name='name'></td>" +
                    "<td><input type='file' id='img' name='img'></td>" +
                    "<td></td>" +
                    "<td><select id='sortation' name='sortation'>" +
                        "<option value='choice'>선택</option>" +
                        "<option value='confirmation'>확정</option>" +
                    "</select></td>" +
                    "<td></td>" +
                    "<td></td>" +
                    "<td><button type='button' id='register' class='btn btn-sm btn-primary'>register</button></td>" +
                "</tr>"
            )
        }

        //세이브 버튼 생성 및 입력폼 활성화
        $('.tabledit-edit-button').click(function() {
            var exit = true;
            var materialNumber = $(this).val();

            $('.tabledit-save-button').each(function() {
                if($(this).css('display') == 'block') {
                    exit = false;
                }
            });

            if($('.btn-primary').length > 0 || exit == false) {
                $('.tabledit-save-button.index_' + materialNumber).hide();

                var name = $('.' + materialNumber + '.index_0').val();
                var rate = $('.' + materialNumber + '.index_2').val();

                $('.material_' + materialNumber + '.index_0').html(name);
                $('.material_img_' + materialNumber + '.index_1').html("<img src='img.php?no=" + materialNumber + "'width='25'>");
                $('.material_' + materialNumber + '.index_2').html(rate);
                $('.span_index_' + materialNumber).show();
                $('.select_index_' + materialNumber).css('display', 'none');
                $('.select_index_' + materialNumber).attr('disabled', true);
                return false;
            }
         
            if($('.tabledit-save-button.index_' + materialNumber).css('display') == 'none') {
                $('.tabledit-save-button.index_' + materialNumber).show();

                var name = $('.material_' + materialNumber + '.index_0').text();
                var rate = $('.material_' + materialNumber + '.index_2').text();

                $('.material_' + materialNumber + '.index_0').html("<input class='" + materialNumber + " index_0' name='name' type='text' value='" + name + "'><input name='no' type='hidden' value='" + materialNumber + "'>");
                $('.material_img_' + materialNumber + '.index_1').html("<input class='" + materialNumber + " index_1' name='img' type='file'>");
                $('.material_' + materialNumber + '.index_2').html("<input class='" + materialNumber + " index_2' name='rate' type='text' value='" + rate + "'>");
                $('.span_index_' + materialNumber).hide();
                $('.select_index_' + materialNumber).css('display', 'block');
                $('.select_index_' + materialNumber).attr('disabled', false);
            } 
        });

        //삭제버튼 활성화
        $('.tabledit-delete-button').click(function() {
            var materialNumber = $(this).val();
            if($('.tabledit-confirm-button.index_' + materialNumber).css('display') == 'none') {
                $('.tabledit-confirm-button.index_' + materialNumber).show();
            } else {
                $('.tabledit-confirm-button.index_' + materialNumber).hide();
            }
        });

        $(document).on("click", "#register", function() {
            console.log($('#name').val());
            var form = $('#data-form')[0];
            var formData = new FormData(form);

            $.ajax({
                url: './handler/MaterialHandler.php',
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
        $('.tabledit-save-button').click(function() {

            var form = $('#data-form')[0];
            var formData = new FormData(form);

            $.ajax({
                url: './handler/MaterialHandler.php',
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
        $('.tabledit-confirm-button').click(function() {
            $.ajax({
                url: './handler/MaterialHandler.php',
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