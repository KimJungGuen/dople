<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>Madclother</title>
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<link href="css/ug.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<style>
	<?php
	session_start();
		if(isset($_SESSION['userNumber']) || $_COOKIE['userNumber']) {
			echo ("
				.gnb_list li:nth-child(3){
					display: inline-block; 
					padding-right: 40px;
				}
				.gnb_list li:nth-child(4){
					display: inline-block; 
					padding-left: 0px;
					padding-right: 237px;
				}
				.gnb_list li:nth-child(5){
					display: inline-block; 
					padding-left: 76px;
				}
			");
		}
	?>
</style>
</head>

<body>



    <?php require_once("header.php"); ?>


	<div class="container">
		<section class="background bg1">
			<div class="visual_f">
				<p>HOW IT WORKS</p>
			</div>
		</section>
		<section class="background bg2">
			<div class="font">
                <div class="font1">
                    <p>이용안내</p><img src="images/line1 (2).jpg" alt="">
                </div>
                <div class="font2">
                    <p>&#45;&nbsp;전과정이 온라인화 되어 타기업과는 차별화 된 저비용의  의류 제작 프로그램 입니다</p><br>
                    <p>&#45;&nbsp;회원가입 후 회원님의 아이덴티티를 입력해주셔야 AI를 이용한 트렌드 의류를 추천받으실 수 있습니다</p><br>
                    <p>&#45;&nbsp;서비스 이용중 프로그램에 문제가발생했을겨우 고객센터에 문의 또는 070-4740-9998로 전화주시기 바랍니다</p>
                </div>
                <img class="line" src="images/line1 (1).jpg" alt="">
            </div>
		</section>
		<section class="background bg3">
            <div class="userimg">
                <div class="im img_1">
                <img src="images/1u.png" alt="">
                <p><strong>1.</strong>가입 시 입력한 아이덴티티가<br> 
                    반영된 맞춤형 디자인을 확인 후<br> 
                    원하는 디자인을 선택해주세요</p>
                </div>
                <img class="og" src="images/y_arrow.png" alt="">
                <div class="im img_2">
                <img src="images/2u.png" alt="">
                <p><strong>2.</strong> 생산의뢰를 클릭하신 후<br> 
                    나만의 아이덴티티가  접목된<br> 
                    가공을 의뢰해주세요</p>
                </div>
                <img class="og" src="images/y_arrow.png" alt="">
                <div class="im img_3">
                <img src="images/3u.png" alt="">
                <p><strong>3.</strong>선금결제 진행한 후<br>샘플작업을진행합니다</p>
                </div>
                <div class="im img_4">
                <img src="images/4u.png" alt="">
                <p><strong>4.</strong> 샘플 왈료 후<br>확인작업을진행합니다<br> 
                    <strong class="ep"> ※수정사항이 없을경우에는<br>본생산을 진행</strong></p>
                </div>
                <img class="og" src="images/y_arrow.png" alt="">
                <div class="im img_5">
                <img src="images/5u.png" alt="">
                <p><strong>5.</strong> 샘플 확인 후 수정작업이<br>필요한 경우 다시 생산의뢰단계에서<br>
                     수정을 진행합니다</p>
                </div>
                <img class="og" src="images/y_arrow.png" alt="">
                <div class="im img_6">
                <img src="images/6u.png" alt="">
                <p><strong>6.</strong> 2차 샘플제작을<br> 진행합니다 </p>
                </div>
                <div class="im img_7">
                <img src="images/7u.png" alt="">
                <p><strong>7.</strong> 2차샘플 확인 후<br> 본생산을 진행합니다</p>
                </div>
                <img class="og" src="images/y_arrow.png" alt="">
                <div class="im img_8">
                <img src="images/8u.png" alt="">
                <p><strong>8.</strong> 제작 완성 후<br>  상품 출고가 됩니다</p>
                </div>
                <img class="og" src="images/y_arrow.png" alt="">
                <div class="im img_9">
                <img src="images/9u.png" alt="">
                <p><strong>9.</strong> 잔금 결제 </p>
                </div>
            </div>
		</section>
	</div>




    <?php require_once("footer.php"); ?>

</body>
</html>

