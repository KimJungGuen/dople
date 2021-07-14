<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>Madclother</title>
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<link href="css/electronic.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<?php session_start(); ?>
</head>

<body>

    <?php require_once('header.php') ?>
    
	<section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
		<div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center ">
                        <h2>전자계약서</h2>
                    </div>          
                    <input id="email" type="hidden">
                        
                    <div class="form-group col-md-12">
                        <div class="text-center">
                            <div class="electronic-box">
                            </div>
                            <div class="checkbox">
                                <label>
                                    동의하시겠습니까
                                    <input id="check" class="agree" type="checkbox" name="digital_brochure" >
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 bt">
                        <button id="next">다음</button>		  
                    </div>

                    <form id="order_info" name="order" action="payment.php" method="post">
                        <input name="order_number" type="hidden" value="<?=$_POST['order_number'] ?>">
                    </form>
                </div>
            </div>
		</div>
    </section>
    <input type="hidden" id="user" value="<?php echo ($_SESSION['userNumber'] ?: $_COOKIE['userNumber']); ?>">


    <?php require_once('footer.php') ?>


    <script>
        $(document).on('click', '#next', function() {
            if($("#check").prop("checked") == false) {
                alert("동의해주시길 바랍니다");
            } else {
                $.ajax({
                    url: "hendler/electronic.php",
                    type: "post",
                    data: {
                        userNumber: $('#user').val()
                    }, 
                    success: function(result) {
                        if(result == "true") {
                            console.log('test');
                            $('#order_info').submit();
                        }
                    }
                }); 
            }
        });
    </script>
</body>
</html>

