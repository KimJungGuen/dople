<?php
    require_once('./dbConnect/hollerPay.php');

    $pay = new HollerPay();
    
    session_start();
    $resultCard = $pay->getCard($_SESSION['userNumber'] ?: $_COOKIE['userNumber']);
    $resultAccount = $pay->getAccount($_SESSION['userNumber'] ?: $_COOKIE['userNumber']);
        
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>HOLLER-address</title>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<script type="text/javascript" src="js/pay.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css//pay.css" rel="stylesheet" type="text/css">
<link href="css/common_1.css" rel="stylesheet" type="text/css">
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
</head>

<body>


    <?php require_once("header.php"); ?>

	<section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
		<div class="wrapper">
            
        <?php require_once("infor-nav.php"); ?>

            <a href="pay_1.php"><button class="btn_ad">결제수단등록</button></a>	
		  <div class="container">
			<div class="row">
			  <div class="col-xs-12 text-center">
				<h2 id="h2">결제관리</h2>
			  </div>
			</div>          
			<div class="row">
			  <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<form name="contentForm" enctype="multipart/form-data" method="" action="" role="form" data-toggle="validator" novalidate="true">
				<div class="form schedule-assessment">
				  <div class="row margin-top-l">
                    <table class="afternoon-session" cellspacing="1">
                        <thead class="table_h">
                            <tr class="tale_r">
                                <th class="card" scope="row" colspan="4">등록 카드 &nbsp;<?php echo count($resultCard);?>개</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($resultCard as $card) { ?>
                            <?php
                                $bank = '';
                                switch($card['card_bank']) {
                                    case 'shinhan' : $bank = '신한'; break;
                                    case 'woori' : $bank = '우리'; break;
                                    default: break;
                                }
                                $number = preg_replace("/([0-9]{4})([0-9]{4})([0-9]{4})([0-9]{4})/", "$1************", $card['card_cradit_number']);
                            ?>
                                <tr>
                                    <td><img src="images/bccard.png" alt="비씨카드"></td>
                                    <td><?php echo $card['card_name'] ?></td>
                                    <td><?php echo "{$bank}카드" ?><br>
                                        <?php echo $number ?></td>
                                    <td>
                                        <button value="<?php echo $card['card_number'] ?>" name="Card" class="btn_d" type="button">삭제</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
			
					<table class="afternoon-session" cellspacing="1">
                        <thead class="table_h">
                            <tr class="tale_r">
                                <th class="card" scope="row" colspan="4">등록 통장 &nbsp; <?php echo count($resultAccount);?>개</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($resultAccount as $row) { ?>
                            <?php
                                switch($row['account_bank']) {
                                    case 'shinhan' : $bankAccount = '신한'; 
                                        $numberAccount = preg_replace("/([0-9]{3})([0-9]{3,})/", "$1-***-******", $row['account_cradit_number']);
                                        break;
                                    case 'woori' : $bankAccount = '우리'; 
                                        $numberAccount = preg_replace("/([0-9]{4})([0-9]{3,})/", "$1-***-******", $row['account_cradit_number']);
                                        break;
                                    default: break;
                                }
                            ?>
                                <tr>
                                    <td><img src="images/backbook_1.png" alt="비씨카드"></td>
                                    <td><?php echo $row['account_name'] ?></td>
                                    <td><?php echo "{$bankAccount}은행" ?><br>
                                        <?php echo $numberAccount ?></td>
                                    <td>
                                        <button value="<?php echo $row['account_number']?>" name="Account" class="btn_d" type="button">삭제</button>
                                    </td>
								</tr>
                            <?php } ?> 
                        </tbody>
                    </table>
				  <!-- close col-->
				</div><!-- close row-->
<!-- close row-->  
			  
			</div>

		  </div>
		</div>
	  </section>


      <?php require_once("footer.php"); ?>

    <script>

        /**
        @brief  카드&계좌 삭제
        @author 김정근
        @date   2020-11-26
         */
        $('.btn_d').click(function() {

            if($(this).attr('name') == 'Card') {
                var check = confirm('카드를 삭제하시겠습니까?');
            } else if($(this).attr('name') == 'Account') {
                var check = confirm('계좌를 삭제하시겠습니까?');
            }

            var targetUrl = './hendler/pay' + $(this).attr('name') + 'Hendler.php';
            
            if(check) {
                $.ajax({
                    url: targetUrl,
                    type: 'delete',
                    data: {
                        'no': $(this).val()
                    },
                    success: function(result) {
                        console.log(result);
                        if(result) {
                            location.reload();
                        }

                        return false;
                    },
                    error: function(result) {
                        return false;
                    }
                });
            }
        });
    </script>
</body>
</html>

