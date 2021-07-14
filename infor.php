<?php 
	session_start();
	if($_SESSION['userSnsType'] != 'company') {
		header("Location: https://www.madclother.com/dev/index.php");
	}
?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
	<title>Madclother</title>
	<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/infor.css" rel="stylesheet" type="text/css">
	<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="js/respond.js"></script>
	<script tpye="text/javascript" src="js/default.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
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
					<h2 id="h2">개인정보</h2>
					</div>
				</div>          
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						<form id="update_form" name="contentForm" role="form">
							<div class="form schedule-assessment">
								<div class="row margin-top-l">
									<?php if(empty($_SESSION['naverToken']) && empty($_SESSION['kakaoToken'])) { ?>
										<div class="form-group col-md-12 text-center">
											<label for="password" class="login now">현재 비밀번호</label><br>
											<input name="old_password" id="old_password" class="input_filed" placeholder="비밀번호를 입력해주세요" type="password" data-password-exist-reqired
												data-password-exist-reqired-error="변경할 비밀번호들을 입력해주세요." data-minlength="8" data-minlength-error="비밀번호는 8자이상 15자이하로 입력해주세요." data-error="password를 입력해주세요">
											<div class="help-block with-errors"></div>
										</div><!-- close col-->  

										<div class="form-group col-md-12 text-center">
												<label for="password" class="login ch">변경할 비밀번호</label><br>
												<input name="new_password" id="new_password" class="input_filed" data-pwPattern placeholder="변경할 비밀번호를 입력해주세요" type="password"
													maxlength="15" data-minlength="8" data-minlength-error="비밀번호는 8자이상 15자이하 입력해주세요." data-error="password를 입력해주세요"
													data-pwPattern-error="문자,숫자,특수문자를 혼용해서 입력해주세요.">
												<div class="help-block with-errors"></div>
										</div>

										<div class="form-group col-md-12 text-center">
												<label for="password" class="login ch_db">변경할 비밀번호 확인</label><br>
												<input name="new_password_confirm" id="new_password_confirm" class="input_filed" placeholder="변경할 비밀번호를 입력해주세요" data-minlength="8" data-minlength-error="비밀번호는 8자이상 15자이하 입력해주세요."
													maxlength="15" data-match="#new_password" data-match-error="변경할 비밀번호가 일치하지 않습니다." type="password" data-error="password를 입력해주세요">
												<div class="help-block with-errors"></div>
										</div> 
									<?php } ?>
									<div class="form-group col-md-12 text-center">
											<label for="name" class="login nm">성명</label><br>
											<input name="name" id="name" class="input_filed" placeholder="이름을 입력해주세요" type="text" value="<?php echo $userName ?>" data-error="이름을 입력해주세요" required>
											<iv class="help-block with-errors"></iv>
									</div> 
								</div>
							</div>

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
			 * @brief:	커스텀 유효성 검사(비밀번호 입력시 변경비밀번호 입력 확인)
			 * @author:	김정근
			 * @date:	2020-11-23
			 */
			$('#update_form').validator({
				delay:1500000,
				custom:{
					'password-exist-reqired': function(){
						if($('#old_password').val() != "") {
							if(($('#new_password').val() == "") && ($('#new_password_confirm').val() == "")) {
								console.log('test');
								return true;
							}
						} else {
							console.log('tes12323');
							return false;
						}
					},
					'pwPattern': function() {
                        var password = $('#new_password').val();
                        regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,15}$/;

                        if(password.match(regex) == null) {
                            return true;
                        } else {
                            return false;
                        }
                    }
				},
				errors: {
					password_exist_reqired: '변경할 비밀번호를 입력해주세요.',
					pwPattern: '숫자,문자,특문을 혼용해주세요.'
				}
			});

			/**
			 * @brief:	커스텀 유효성 검사(비밀번호 입력시 변경비밀번호 입력 확인)
			 * @author:	김정근
			 * @date:	2020-11-23
			 */
			$('#update_form').validator().on('submit', function(e) {
				if(!e.isDefaultPrevented()) {
					$.ajax({
						url: './hendler/userHendler.php',
						type: 'put',
						data: $('#update_form').serialize(),
						success: function(result) {
							location.reload();
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

