<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>HOLLER-address</title>	
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<link href="css//pay_1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<script type="text/javascript" src="js/default.js"></script>


</head>

<body>

	<?php require_once("header.php"); ?>

	<section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
		<div class="wrapper">
            
		<?php require_once("infor-nav.php"); ?>
            	
		  <div class="container">
			<div class="row">
			  <div class="col-xs-12 text-center">
				<h2 id="h2">계좌관리 <p class="position">-계좌수단등록</p></h2>
			  </div>
			</div>           	
			<div class="row">
			  <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
					<form name="contentForm"  role="form" data-toggle="validator" novalidate="true">
						<div class="form schedule-assessment">
						<div class="row margin-top-l">
							<a href="pay_2.php">
								<div class="box box-1">
									<img src="images/card.png" alt="카드등록">
									<p>카드등록</p>
								</div>
							</a>
							<a href="pay_3.php">
								<div class="box">
									<img src="images/backbook_1.png" alt="계좌등록">
									<p class="enroll">계좌등록</p>
								</div>
							</a>

						</div><!-- close row-->
					</form>
				</div>
				<a href="pay.php"><button class="btn_ad">취소</button></a>
            </div>
                       
		  </div>
		</div>
	  </section>

	  <?php require_once("footer.php"); ?>

</body>
</html>

