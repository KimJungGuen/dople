<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>HOLLER-Login</title>
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/common_1.css" rel="stylesheet" type="text/css">
<link href="css/pay_2.css" rel="stylesheet" type="text/css">
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
</head>

<body>
	<?php require_once("header.php"); ?>

	<section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
		<div class="wrapper">
            
		<?php require_once("infor-nav.php"); ?>
		  <div class="container">
			<div class="row">
			  <div class="col-xs-12 text-center">
				<h2 id="h2">결제관리 <p class="position">-결제등록수단(계좌)</p></h2>
			  </div>
			</div>          
			<div class="row">
			  <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<form id="register_form" name="contentForm" role="form" data-toggle="validator" novalidate="true">
				<div class="form schedule-assessment">
				  <div class="row margin-top-l">
                    <div class="form-group col-md-12 text-center">
						<label for="name" class="login lg">등록할 이름</label><br>
						<input name="name" id="name" class="input_filed" placeholder="이름을 입력해주세요" type="text" value="" required="required" data-error="이름을 입력해주세요">
						<div class="help-block with-errors"></div>
				  </div> 
                    <div class="form-group col-md-12 text-center">
						<label for="password" class="login now">계좌번호</label><br>
						<input name="account" id="account" class="input_filed" pattern="[0-9]{1,14}" data-pattern-error="숫자만 입력해주세요." 
							maxlength="14" data-minlength="11" placeholder="계좌번호를 입력해주세요" type="password" data-error="계좌번호를 입력해주세요" required>
						<div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-12 text-center">
                            <label class="cd_nm" for="card">은행</label><br>
								<select id="cd_s" name="bank" class="card_f" data-error="은행을 선택해주세요." required>
									<option value="">은행을 선택해주세요</option>
									<option value="shinhan">신한은행</option>
									<option value="woori">우리은행</option>\
								</select>
							<div class="help-block with-errors"></div>
					</div>


                  <div class="form-group col-md-12 text-center">
                    <label for="password" class="login ch_db">성명</label><br>
                    <input name="owner" id="owner" class="input_filed" type="text" value="" data-error="password를 입력해주세요" required>
                    <div class="help-block with-errors"></div>
                    </div> 

			
				  <!-- close col-->
				</div><!-- close row-->


				  
				 </div>
				  <!-- close row-->
				  <div class="form-group text-center go">
				  <button class="btn">등록</button>	
				  <button class="btn_c" type="button" onclick="location.href='pay.php'">취소</button>		  
				  </div>
				</div>
	  
			  </form>
			</div>

		  </div>
		</div>
	  </section>


	  <?php require_once("footer.php"); ?>

	<script>

		/**
		@brief:  계좌 등록
		@author: 김정근
		@date:   2020-11-27
		*/
		$('#register_form').validator({delay:1500000}).on('submit', function(e) {
			if(!e.isDefaultPrevented()) {
				$.ajax({
				url: './hendler/payAccountHendler.php',
				type: 'post',
				data: $('#register_form').serialize(),
				success: function(result) {
					if(result) {
						location.href = "pay.php";
					} else {
						//실패 메시지
					}

					return false;
				},
				error: function(result) {
					return false;
				}
				});

				return false;
			} else {
				return false;
			}
		});
	</script>

</body>
</html>

