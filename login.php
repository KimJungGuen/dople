<?php
	session_start();

	if(isset($_SESSION['userNumber'])) {
		echo header("Location: https://www.madclother.com/dev/index.php");
	}

	function set_state(){
		$mt = microtime();
		$rand = mt_rand();

		return md5($mt . $rend);
	}

	if(empty($_SESSION['state'])) {
		
		$_SESSION['state'] = set_state();
	}

	$client_id = "1aCf8hMK4fRySy2xbdDC";
	$redirectURI = urlencode("https://www.madclother.com/dev/sns/naver.php");
	$state = $_SESSION['state'];
	$naverApiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;

	$redirecId = "75111ed7e4065ed9710e3071ebf306c9";
	$kakaoURL = "https://kauth.kakao.com/oauth/authorize?client_id=" . $redirecId . "&redirect_uri=https://www.madclother.com/dev/sns/kakao.php&response_type=code&state=" . $state;
?>

<!doctype html>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
		<title>Madclother-Login</title>
		<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
		<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="js/respond.js"></script>
		<script type="text/javascript" src="js/default.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
		<link href="css/login.css" rel="stylesheet" type="text/css">
		
	</head>

	<body>
		<script>
			window.fbAsyncInit = function() {
				FB.init({
				appId      : '1910119825842209',
				cookie     : true,
				xfbml      : true,
				version    : 'v10.0'
				});
				
				FB.AppEvents.logPageView(); 
			};

			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "https://connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<?php require_once("header.php"); ?>
		<section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
			<div class="wrapper">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-center">
							<h2 id="h2">LOGIN</h2>
						</div>
					</div>          

					<form id="login_form" method="post" name="contentForm" role="form" data-toggle="validator">
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
							<div class="form schedule-assessment">
								<div class="row margin-top-l">
									<div class="form-group col-md-12 text-center">
										<label for="email" class="login">아이디(이메일)</label><br>
										<input name="email" id="email" placeholder="이메일을 입력해주세요" maxlength="50" type="email" data-loginClear data-error="email을 입력해주세요." required>
										<div class="help-block with-errors"></div>
									</div><!-- close col-->  
									<div class="form-group col-md-12 text-center">
										<label for="password" class="login lg">비밀번호</label><br>
										<input name="password" id="password" placeholder="비밀번호를 입력해주세요" maxlength="15" type="password" data-loginClear data-error="password를 입력해주세요" required>
										<div class="help-block with-errors"></div>
									</div><!-- close col-->
								</div><!-- close row-->
		
								<div class="row">
									<div class="form-group col-md-12">
										<div class="text-center">
											<div class="checkbox">
												<label>
												<input id="auto_login" type="checkbox" name="digital_brochure" value="yes">
													자동로그인
												</label>
											</div>
										</div>
									</div>
								</div><!-- close row-->

								<div class="form-group text-center">
									<!--<input id="login_btn" class="btn_login" value="로그인" type="submit"> -->
									<button id="login_btn" class="btn_login" type="submit">로그인</button>
								</div>
								<div class="form-group text-center">
									<ul class="link">
										<li><a href="/member/find/loginId" class="link_find">아이디찾기</a></li>
										<li><a href="password_find.php" class="link_find">비밀번호찾기</a></li>
										<li><a href="join.php" class="link_find">회원가입</a></li>
									</ul>
								</div>
								<hr>
								<div class="snslogin  text-center">
									<p>SNS계정으로 간편하게 회원가입/로그인 하세요</p>
									<ul class="sns">
										<li><a id="naver_login" href="javascript:naver();"><img src="images/naver.jpg" alt="네이버"></a></li>
										<li><a id="face_login" href="javascript:facebook();"><img src="images/facebook.jpg" alt="페이스북"></a></li>
										<!-- <li>
											<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
												<img src="images/facebook.jpg" alt="페이스북">
											</fb:login-button>
										</li> -->
										<li><a href="javascript:kakao()"><img src="images/kakao.jpg" alt="카카오톡"></a></li>
										<li><a href=""><img src="images/apple.jpg" alt="애플"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</section>

		<?php require_once("footer.php"); ?>

		<script type="text/javascript">

			/**
			 * @brief	페북 로그인 상태 확인
			 * @author	김정근
			 * @date	2021-06-01
			 */
			function facebook() {
				FB.login(function(response){
					if(response.status == "connected") {
						faceBookUser();
					} else {

					}
				}, {scope: 'public_profile,email'});
			}


			/**
			 * @brief	페북 유저 정보 확인
			 * @author	김정근
			 * @date	2021-06-01
			 */
			function faceBookUser() {
				FB.api('/me', function(response) {
					console.log(response);
					$.ajax({
						url: "hendler/loginHendler.php",
						type: "post",
						data: {
							name: 	response.name,
							id:		response.id,
							type: 	'faceBook'
						},
						success:function(result) {
							location.href="index.php";
						}
					});
				});
			}
			

			/**
			 * @biref	네이버로그인
			 * @author	김정근
			 * @date	2020-01-06
			 */
			function naver(){
				var naverUrl = "<?php echo $naverApiURL ?>";
				var win = window.open(naverUrl, "_blank", "width=720");
			}

			/**
			 * @biref	카카오로그인
			 * @author	김정근
			 * @date	2020-01-06
			 */
			function kakao(){
				var kakaoUrl = "<?php echo $kakaoURL ?>";
				var win = window.open(kakaoUrl, "_blank", "width=720");
			}

			/**
			@biref : 	커스텀 에러 메시지 제거
			@author : 	김정근
			@date : 	2020-11-18
			*/
			$('#login_form').validator({
				custom:{
					'loginClear': function() {
						if($('#email').val() != '' || $('#password').val()) {
							$('.help-block.with-errors').html('');
						}
						return false;
					}
				},
				errors: {
					loginClear: ''
				}
			})

			/**
			@biref : 	로그인
			@author : 	김정근
			@date : 	2020-11-16
			*/
			$('#login_form').validator().on('submit', function(e) {
				console.log(!e.isDefaultPrevented());
				if(!e.isDefaultPrevented()) {
					$.ajax({
						url: './hendler/loginHendler.php',
						type: 'post',
						async: false,
						data: {
							'user_email': $('#email').val(),
							'user_password': $('#password').val(),
							'auto_login': $('#auto_login').prop('checked')
						},
						datatype: 'json',
						success: function(result) {
							var result = $.parseJSON(result);
							if(result.data) {
								location.href = 'index.php';
							} else{
								$('.help-block.with-errors').html("<ul class='list-unstyled'><li>아이디 또는 비밀번호가 틀렸습니다.</li></ul>");
								$('li').css('color', '#a94442');
							}
						},
						error: function(result) {
							alert('접속에 실패했습니다.');
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

