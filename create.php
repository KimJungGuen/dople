<?php 
    require_once("./dbConnect/hollerOrder.php");
    date_default_timezone_set('Asia/Seoul');
	session_start();
	if(!$_SESSION['userNumber']) {
		header("Location: http://hollerat.world/dev/index.php");
    }
    
    $model = new hollerOrder(); 
    
    $category = $model->getsCategory();
    $clothes = $model->getsClothes();
    $formData = (object)array(
        'startDay' => $_GET['start_day'] ?: date('Y-m-d', strtotime('-1 Months')),
        'endDay' => $_GET['end_day'] ?: date('Y-m-d'),
        'clothesNumber' => ($_GET['clothes'] == '옷종선택') ? null : $_GET['clothes'],
        'categoryNumber' => ($_GET['category'] == '구분선택') ? null : $_GET['category'],
        'model' => $_GET['model'] ?: null,
        'status' => ($_GET['status'] == '진행상태') ? null : $_GET['status'],
        'produce' => 1
    );
    $order = $model->getsOrder($_SESSION['userNumber'], $formData);
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>Madclother</title>
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<link href="css/sample.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/sample.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
</head>

<body style="overflow: auto;">
    <?php require_once("header.php"); ?>
    
    <div class="content">
        <section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
            <div class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center ">
                            <h2>생산 진행 상황</h2>
                        </div>
                        <form id="search_order">
                            <div class="col-xs-12 text-center sp-around">
                                <ul class="sp-list">
                                    <li>
                                        <label>결제일</label><br>
                                        <input type="text" id="datepicker" name="start_day" value="<?php echo $formData->startDay ?>"> 
                                    </li>
                                    <li>&#126;</li>
                                    <li>
                                        <label>결제일</label><br>
                                        <input type="text" id="datepicker_1" name="end_day" value="<?php echo $formData->endDay ?>">
                                    </li>
                                    <li>
                                        <label>구분</label><br>
                                        <select id="sortation" name="category" class="category">
                                            <option>구분선택</option>
                                            <?php foreach($category as $row) { ?>
                                                <?php if($_GET['category'] == $row['category_number']) { ?>
                                                    <option value="<?php echo $row['category_number'] ?>" selected>
                                                        <?php echo $row['category_name'] ?>
                                                    </option>
                                                <?php }  else { ?>
                                                    <option value="<?php echo $row['category_number'] ?>">
                                                        <?php echo $row['category_name'] ?> 
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </li>
                                    <li>
                                        <label>옷종</label><br>
                                        <select id="kind" name="clothes" class="category">
                                            <option selected>옷종선택</option>
                                            <?php foreach($clothes as $row) { ?> 
                                                <?php if($_GET['clothes'] == $row['clothes_number']) { ?>
                                                    <option value="<?php echo $row['clothes_number'] ?>" selected>
                                                        <?php echo $row['clothes_name'] ?>
                                                    </option>
                                                <?php }  else { ?>
                                                    <option value="<?php echo $row['clothes_number'] ?>">
                                                        <?php echo $row['clothes_name'] ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </li>
                                    <li>
                                        <label>모델명</label><br>
                                        <input id="model" type="text" name="model" value="<?php echo $_GET['model'] ?>">
                                    </li>
                                    <li>
                                        <label>현재상태</label><br>
                                        <select id="status" name="status" class="category">
                                            <?php 
                                                $status = array(
                                                    0 => '진행상태',
                                                    1 => '제작대기중',
                                                    2 => '제작중',
                                                    3 => '확인완료',
                                                    4 => '배송중'
                                                );
                                            ?>
                                            <?php foreach($status as $data) { ?>
                                                <?php if($_GET['status'] == $data) { ?>
                                                    <option selected><?php echo $data ?></option>
                                                <?php } else  { ?>
                                                    <option ><?php echo $data ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </li>
                                </ul>
                                <div class="reset">
                                    <button id="reset" type="button">초기화</button>
                                    <button><img src="images/search.png"></button>
                                </div>
                            </div>
                        </form>      
                        <table class="afternoon-session payment" cellspacing="1">
                            <thead>
                                <tr>
                                    <th scope="row">결제일</th>
                                    <th scope="row">구분</th>
                                    <th scope="row">옷종</th>
                                    <th scope="row">모델명</th>
                                    <th scope="row">현재상태</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($order as $row) { ?> 
                                    <tr>
                                        <td>
                                            <?php 
                                                $create = preg_replace('/(\d{1,2}:\d{1,2}:\d{1,2})/', '', $row['order_create']);
                                                $create = preg_replace('/-(?!.{2}\s)/', '년', $create);
                                                $create = str_replace('-', '월', $create);
                                                $create = preg_replace('/\s/', '일', $create);
                                                echo $create;
                                            ?>
                                        </td>
                                        <?php if($row['order_process'] == '가공의뢰')  { ?>
                                            <td colspan="3">
                                                <?php echo $row['order_process'] ?>
                                            </td>
                                        <?php } else { ?>
                                            <td>
                                                <?php echo $row['category_name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['clothes_name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['order_model'] ?>
                                            </td>
                                        <?php } ?>
                                        <td>
                                            <?php if($row['order_status'] == '배송완료') { ?>
                                                <label class="bt-encase">
                                                    <button class="bt bt-1" onclick="location.href='<?php echo "complete-injection.php?no={$row['order_number']}" ?>'">수정</button>
                                                    <button type="button" class="bt bt-3 create" value="<?php echo $row['order_number'] ?>">생산</button>
                                                </label>
                                            <?php } else { ?> 
                                                <?php echo $row['order_status'] ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody> 
                        </table>
                        
                        
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php require_once('footer.php');?>

    <script>
        $(document).on('submit', '#search_order', function() {
            var dateAfter = $('#datepicker').val();
            var dateBefore = $('#datepicker_1').val();

            //시작일 종료일 연산
            var dateAfter = dateAfter.split('-');
            var dateBefore = dateBefore.split('-');
            var afterYear = dateAfter[0];
            var beforeYear = dateBefore[0];
            var afterMonth = dateAfter[1];
            var beforeMonth = dateBefore[1];
            var afterDay = dateAfter[2];
            var beforeDay = dateBefore[2];
            var dateAlert = function() {alert('시작일을 종료일보다 앞 선 날짜로 설정해주세요.')};
            var yearCheck = (beforeYear - afterYear < 0) ? false : true;
            var monthCheck = (beforeMonth - afterMonth < 0) ? false : true;
            var dayCheck = (beforeDay - afterDay < 0) ? false : true;
            if (yearCheck) {
                if (monthCheck) {
                    if (dayCheck == false && beforeMonth - afterMonth == 0 && beforeYear - afterYear == 0) {
                        dateAlert();
                        return false;
                    }
                } else if (beforeYear - afterYear == 0) {
                    dateAlert()
                    return false;
                }
            } else { 
                dateAlert()
                return false;
            }
        });

        $('#reset').click(function() {
            var date = new Date();
            var year = date.getFullYear();
            var month = date.getMonth();
            var day =  date.getDate();

            var beforeDate = year + "-" + ("0" + (month + 1)).slice(-2) + "-" + ("0" + day).slice(-2);

            if (date.getMonth() == 0) {
                year = date.getFullYear() - 1;
                month = date.getMonth() + 12;
            }
            var afterDate = year + "-" + ("0" + (month)).slice(-2) + "-" + ("0" + day).slice(-2);

            $('#model').val('');
            $("#sortation option:eq(0)").prop("selected", true);
            $("#kind option:eq(0)").prop("selected", true);
            $("#status option:eq(0)").prop("selected", true);
            $('#datepicker_1').val(beforeDate);
            $('#datepicker').val(afterDate);
        });

        $(document).on('click', '.create', function() {
            $.ajax({
                url: './hendler/orderHendler.php',
                type: 'put',
                data:{
                    no: $(this).val()
                },
                success: function(result) {
                    if(result != 'false') {

                    }
                }
            })
        });
    </script>
</body>
</html>

