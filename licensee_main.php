<?php
  require_once('./dbConnect/hollerBusiness.php');

  $business = new HollerBusiness();

  session_start();
  $result = $business->getsBusiness($_SESSION['userNumber'] ?: $_COOKIE['userNumber']);
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>HOLLER-address</title>
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<link href="css//address.css" rel="stylesheet" type="text/css">
<link href="css/common_1.css" rel="stylesheet" type="text/css">

</head>

<body>

  <?php require_once("header.php"); ?>  

	<section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
		<div class="wrapper">
            
      <?php require_once("infor-nav.php"); ?>

            <a href="licensee.php"><button class="btn_ad">사업자등록</button></a>	
		  <div class="container">
			<div class="row">
			  <div class="col-xs-12 text-center">
				<h2 id="h2">사업자 관리</h2>
			  </div>
			</div>          
			<div class="row">
			  <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
				<form name="contentForm"  role="form" data-toggle="validator" novalidate="true">
				<div class="form schedule-assessment">
				  <div class="row margin-top-l">
                    <table class="afternoon-session" cellspacing="1">
                        <thead>
                            <tr>
                                <th scope="row">상호</th>
                                <th scope="row">주소</th>
                                <th scope="row">수정 / 삭제</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach($result as $row) { ?>
                            <tr>
                                <td><?php echo $row['business_mutual'] ?></td>
                                <td><?php echo "{$row['business_address']}<br>{$row['business_address_detail']}" ?></td>
                                <td>
                                    <button class="btn_a" type="button" value="<?php echo $row['business_number'] ?>" onclick="location.href='licensee_1.php'">수정</button>
                                    <button class="btn_d" type="button" value="<?php echo $row['business_number'] ?>">삭제</button>
                                
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
        @brief:   주소 수정 페이지 이동
        @author:  김정근
        @date:    2020-11-25
        */
        $('.btn_a').click(function() {
          var $newForm = $('<form></form>');
          $newForm.attr('name', 'update_form');
          $newForm.attr('method', 'post');
          $newForm.attr('action', './licensee_1.php');
          $newForm.appendTo('body');
          $newForm.append($('<input/>', {type: 'hidden', name:'no', value:$(this).val()}));
          $newForm.submit();
          
        });

        /**
        @brief  주소삭제
        @author 김정근
        @date   2020-11-26
        */
        $('.btn_d').click(function() {
          var check = confirm('사업자 정보를 삭제하시겠습니까?');

          if(check) {
            $.ajax({
              url: './hendler/businessHendler.php',
              type: 'delete',
              data: {
                'no': $(this).val()
              },
              success: function(result) {
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

