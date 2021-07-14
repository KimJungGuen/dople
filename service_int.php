<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>Madclother</title>
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<link href="css/service_int.css" rel="stylesheet" type="text/css">
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
				<p>번거롭고 복잡한 과정 NO</p>
				<p>간편하고 편리한 과정 YES</p>
			</div>
		</section>
		<section class="background bg2">
			<img src="images/oneimages.png" alt="">
		</section>
		<section class="background bg3">
			<div class="font font1">
				<p class="main-font">1. Deep trendTM<br>AI Crawling 적용으로 트렌드의 신속·정확한 분석 및 예측</p>
				<p class="sub-font">트렌드 분석 시간, 비용 절감<br>트렌드 예측 정확도 상승을 통한 차별화</p>
			</div>
			<img src="images/twoimages.png" alt="">
		</section>
		<section class="background bg4">
			<div class="font font2">
				<p class="main-font">2. NEOGarmentTM<br>브랜드별 특성과 트렌드에 맞는 완전 브랜드 맞춤형 의류 개발</p>
				<p class="sub-font">기존 의류 제조 산업의 FLOW자체를 바꾸는 Disruptive기술<br>아이덴티티 맞춤형 의류 형태로 진입장벽이 높은 기술</p>
			</div>
			<img src="images/threeimages.png" alt="">
		</section>
		<section class="background bg5">
			<div class="font font3">
				<p class="main-font">3. AIpatternTM <br>패턴사의 노하우를 담은 자동 패터닝</p>
				<p class="sub-font">하단 굴리기, 요척 최소화 등 패턴사 노하우 구현<br>고비용 공정의 AI 자동화를 통해 다품종 소량생산의 개발비 70%이상 절감</p>

			</div>
			<img src="images/fourimages.png" alt="">
		</section>
		<section class="background bg6">
			<div class="font font4">
				<p class="main-font">4. EASY-J.O.TM<br>Job Order 체계/단순화로<br>생산 전과정 온라인화 + 저비용 의류 개발 실현</p>
				<p class="sub-font">AI 트렌드분석, 디자인개발, 제작<br>전과정 온라인의 빠른 진행 으로 간편하게 작업지시서 작성</p>
			</div>
			<img src="images/fiveimages.png" alt="">
		</section>
	</div>

	<?php require_once("footer.php"); ?>

</body>
</html>

