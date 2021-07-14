<?php
  require_once('./dbConnect/hollerBusiness.php');

  $business = new HollerBusiness();

  session_start();
  $result = $business->getBusiness($_SESSION['userEmail'] ?: $_COOKIE['userEmail']);
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>HOLLER-Login</title>
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script> 
<link href="css/licensee.css" rel="stylesheet" type="text/css">
<link href="css/common_1.css" rel="stylesheet" type="text/css">

</head>

<body>
	<?php require_once("header.php"); ?>   

	<section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
		<div class="wrapper">
            
		<?php require_once("infor-nav.php"); ?>
		  <div class="container">
			<div class="row">
			  <div class="col-xs-12 text-center">
				<h2 id="h2">사업자 관리</h2>
			  </div>
			</div>          
			<div class="row">
			  <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<form id="update_form" name="contentForm" role="form" novalidate="true">
				<div class="form schedule-assessment">
				  <div class="row margin-top-l">

                    <div class="form-group col-md-12 text-center">
						<label for="business" class="login license">사업자등록번호</label><br>
						<input name="business" id="business" class="input_filed" data-minlength="10" maxlength="10" pattern="^[0-9]{1,10}$" data-pattern-error="숫자만 입력해주세요." placeholder="사업자등록번호를 기입해주세요" type="text"data-error="사업자등록번호를 기입해주세요" required>
						<div class="help-block with-errors"></div>
					</div> 
					
                    <div class="form-group col-md-12 text-center">
                        <label for="name" class="login shop">상호</label>
                        <label for="name" class="login shop">대표자</label><br>
						<input name="mutual" id="mutual" class="input_filed input_small" maxlength="100" placeholder="상호를 입력해주세요" type="text" value="" required="required" data-error="상호를 입력해주세요">
						<input name="ceo" id="ceo" class="input_filed input_small" maxlength="10" pattern="(^[a-zA-Z]{1,10}$)|(^[가-힣]{1,10}$)" data-pattern-error="문자만 입력해주세요." placeholder="대표자를 입력해주세요" type="text" data-error="대표자를 입력해주세요" required>
                        <div class="help-block with-errors"></div>
					  </div><!-- close col--> 
					  
                    <div class="form-group col-md-12 text-center">
                        <label for="post" class="login code">우편번호</label><br>
                        <input name="post" id="post" class="input_filed z_code" maxlength="6" placeholder="" type="text" required readOnly data-address-required data-address-required-error="주소찾기를 해주세요." data-error="주소찾기를 해주세요">
                        <button id="address_find" class="bt_j" type="button">주소찾기</button>
                        <div class="help-block with-errors"></div>
					</div> 

					<div id="daum_api" style="display:none;width:300px;"></div>

                    <div class="form-group col-md-12 text-center">
                        <label for="post" class="login address">주소</label><br>
                        <input name="post_1" id="post_1" class="input_filed input_filed_1" maxlength="150" placeholder="" type="text" required readOnly data-error=""><br>
                        <label for="post" class="login daddress">상세주소</label><br>
                        <input name="post_2" id="post_2" class="input_filed input_filed_1" maxlength="150" placeholder="" type="text">
                        <div class="help-block with-errors"></div>
					</div>
					
                    <div class="form-group col-md-12 text-center">
                        <label for="name" class="login shop">업태</label>
                        <label for="name" class="login shop">종목</label><br>
						<input name="condition" id="condition" class="input_filed input_small" maxlength="25" placeholder="업태를 입력해주세요" type="text" required data-error="업태를 입력해주세요">
						<input name="industry" id="industry" class="input_filed input_small" maxlength="25" placeholder="종목을 입력해주세요" type="text" required data-error="종목을 입력해주세요">
                        <div class="help-block with-errors"></div>
					</div>
					
                    <div class="form-group col-md-12 text-center">
						<label for="email" class="login">계산서 수신메일</label><br>
						<input name="email" id="email" class="input_filed" placeholder="이메일을 입력해주세요" type="email"  required data-error="email을 입력해주세요.">
						<div class="help-block with-errors"></div>
					</div>
                
				    <div class="form-group col-md-12 text-center">
						<label for="name" class="login nm">담당자</label><br>
						<input name="name" id="name" class="input_filed" placeholder="담당자 이름을 입력해주세요" type="text" required maxlength="10" pattern="(^[a-zA-Z]{1,10}$)|(^[가-힣]{1,10}$)" data-error="담당자 이름을 입력해주세요">
						<div class="help-block with-errors"></div>
					</div>
					
				    <div class="form-group col-md-12 text-center">
						<label for="number" class="login ch_db">담당자 연락처</label><br>
						<input name="phone" id="phone" class="input_filed" maxlength="11" data-minlength="9" placeholder="연락처를 입력해주세요" type="text" required pattern="[0-9]{1,}" data-pattern-error="숫자만 입력해주세요." data-error="연락처를 입력해주세요">
						<div class="help-block with-errors"></div>
				    </div> 
					<input id="no" name="no" type="hidden" value="">
				  <!-- close col-->
				</div><!-- close row-->

				</div>
					<!-- close row-->
					<div class="form-group text-center go">
					<button class="btn">수정</button>	
					<button class="btn_c" type="button" onclick="location.href='index.php'">취소</button>		  
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
		@brief:   유저 정보 조회, 주소 정보 조회
		@author:  김정근
		@date:    2020-11-25
		*/
		$(function() {
			$.ajax({
				url: './hendler/businessHendler.php',
				type: 'get',
				data: {
					'no': <?php echo $_POST['no']; ?>
				},
				success: function(result){
					var result = JSON.parse(result);

					if(result) {
						$('#business').val(result.business);
						$('#ceo').val(result.ceo);
						$('#condition').val(result.condition);
						$('#email').val(result.email);
						$('#industry').val(result.industry);
						$('#mutual').val(result.mutual);
						$('#name').val(result.name);
						$('#no').val(result.no);
						$('#phone').val(result.phone);
						$('#post').val(result.post);
						$('#post_1').val(result.post_1);
						$('#post_2').val(result.post_2);
					}
				}
			});
		});

		/**
		@brief:  주소 수정
		@author: 김정근
		@date:   2020-11-25
		*/
		$('#update_form').validator({delay:1500000}).on('submit', function(e) {
			if(!e.isDefaultPrevented()) {
				$.ajax({
					url: './hendler/businessHendler.php',
					type: 'put',
					data: $('#update_form').serialize(),
					success: function(result) {
						if(result) {
							location.href="licensee_main.php"
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

		/**
		* @brief:  다음 주소 api
		* @author: 김정근
		* @date:   2020-11-17
		*/
		$('#address_find').click(function() {
			var element_daum_api = document.getElementById("daum_api");

			if($('#daum_api').css('display') == 'none') {
				new daum.Postcode({
					oncomplete:function(data) {
						$('#post').val(data.zonecode);
						$('#post_1').val(data.address);
						$('#post_2').focus();
					}
					, onclose:function(state) {
						if(state === "COMPLETE_CLOSE") {
							$('#daum_api').css('display', 'none');
							$('#daum_api').slideUp();
						}
					}
				}).embed(element_daum_api);

				$('#daum_api').slideDown();
			} else {
				$('#daum_api').css('display', 'none');
				$('#daum_api').slideUp();
			}
		});

		/**
		* @brief:	커스텀 유효성 검사(우편번호, 주소 입력확인)
		* @author:	김정근
		* @date:	2020-11-23
		*/
		$('#register_form').validator({
			custom:{
				'address-required': function(){
				if($('#post').val() != '' && $('#post_1').val() != '') {
					return false;
				} else {
					return true;
				}
				}
			},
			errors: {
				address_required: ""
			}
		});

		
	</script>
</body>
</html>

