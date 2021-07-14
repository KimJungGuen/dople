<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>Madclother</title>
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/password_find.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

</head>

<body>
	<?php require_once('./header.php'); ?>

	<section class="container footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
			<div class="row">
			  <div class="col-xs-12 text-center">
				<h2>비밀번호찾기</h2>
			  </div>
			</div>          
			<div class="row">
				<form id="password_form" name="contentForm"  role="form" data-toggle="validator">
                        <div class="form-group col-md-12 text-center">
                            <label for="email" class="login">아이디(이메일)</label><br>
                            <input name="email" id="email" class="input_id" placeholder="이메일을 입력해주세요" type="email" required>
                            <div class="help-block with-errors"></div>
							<p id="unable" class="notify">해당 이메일이 존재하지 않습니다</p>
							<p id="able" class="notify">해당 이메일로 임시비밀번호를 전송하였습니다</p>
							<button id="find_password" type="submit" class="bt_check">확인</button>
                        </div><!-- close col-->  
                </form>
			  </div>
	  </section>




	  <?php require_once('./footer.php'); ?>

	
	<script>
		$('#password_form').validator({
			delay:1500000	
		});

		$("#password_form").validator().on('submit', function (e){
			console.log(e);
			if(!e.isDefaultPrevented()) {
				var findEmail = $('#email').val();
				$.ajax({
					url: './hendler/passwordHendler.php',
					type: 'get',
					data: {
						email: findEmail
					},
					success: function(result) {
						result = JSON.parse(result);

						if(result) {
							$('#able').show();
							$.ajax({
								url: './hendler/passwordHendler.php',
								type: 'post',
								data: {
									email: findEmail
								},
								success: function(result) {
									result = JSON.parse(result)

									if(result) {
										location.href = 'https://www.madclother.com/dev/login.php';
									} else {
										alert("연결에 실패했습니다. 다시 시도해 주세요.");
									}
								}
							});
						} else {
							if($('#email').val() != '') {
								$('#unable').show();
							}
						}
					}
				});
			}

			return false;
		});

		$(document).on('keydown', '#email', function() {
			$('#able').hide();
			$('#unable').hide();
		});
	</script>
</body>
</html>

