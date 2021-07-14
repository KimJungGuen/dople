<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
    <title>HOLLER-addess</title>
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/address_1.css" rel="stylesheet" type="text/css">
    <link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/respond.js"></script>
    <script type="text/javascript" src="js/default.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script> 
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
                  <h2 id="h2">주소관리 <p class="position">-주소등록</p></h2>
                  
                </div>
              </div>          
              <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                  <form id="register_form" name="contentForm" role="form" novalidate="true">
                  <div class="form schedule-assessment">
                    <div class="row margin-top-l"> 
  
                    <div class="add">
                          <div class="form-group col-md-12 text-center">
                                  <label for="post" class="login code">우편번호</label><br>
                                  <input name="post" id="post" class="input_filed" placeholder="" type="text" required readOnly data-address-required data-address-required-error="주소찾기를 해주세요." data-error="주소찾기를 해주세요" >
                                  <button id="address_find" class="bt_j" type="button">주소찾기</button>
                                  <div class="help-block with-errors"></div>
                          </div> 
                          <div id="daum_api" style="display:none;width:300px;"></div>
                          <div class="form-group col-md-12 text-center">
                                  <label for="post_1" class="login address">주소</label><br>
                                  <input name="post_1" id="post_1" class="input_filed input_filed_1 " placeholder="" type="text" required readOnly data-error="주소찾기를 해주세요" ><br>
                                  <label for="post_2" class="login daddress">상세주소</label><br>
                                  <input name="post_2" id="post_2" class="input_filed input_filed_1" placeholder="" type="text" data-error="">
                                  <div class="help-block with-errors"></div>
                          </div>
                          <div class="form-group col-md-12 text-center">
                                  <label for="recipient" class="login get">받는사람</label><br>
                                  <input name="recipient" id="recipient" class="input_filed" placeholder="" type="text" data-error="받는사람을 입력해주세요." required>
                                  <div class="help-block with-errors"></div>
                          </div> 
                    </div>
                    <!-- close col-->
                    </div><!-- close row-->
  
  
                    
                    </div>
                    <!-- close row-->
                    <div class="form-group text-center go">
                    <button class="btn">등록</button>	
                    <button class="btn" type="button" onclick="location.href='address.php'">취소</button></a>		  
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
          * @brief:	커스텀 유효성 검사(우편번호, 주소 입력확인)
          * @author:	김정근
          * @date:	2020-11-23
          */
          $('#register_form').validator({
            delay:15000000,
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

          /**
          @brief:  주소 등록
          @author: 김정근
          @date:   2020-11-25
           */
          $('#register_form').validator().on('submit', function(e) {
            if(!e.isDefaultPrevented()) {
              $.ajax({
                url: './hendler/addressHendler.php',
                type: 'post',
                data: $('#register_form').serialize(),
                success: function(result) {
                  if(result) {
                    location.href="address.php"
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
        </script>
  </body>
  </html>
    
    