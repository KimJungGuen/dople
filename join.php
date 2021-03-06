<!doctype html>
    <html lang="ko">
        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
        <title>Madclother</title>
        <link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
		<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="js/respond.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
        <link href="css/join.css" rel="stylesheet" type="text/css">
        <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

        <?php
            session_start();
            if($_SESSION['userEmail'] && $_COOKIE['userEmail']) {
                echo ("<link href='css/common_1.css' rel='stylesheet' type='text/css'>");
            } else {
                echo ("<link href='css/common.css' rel='stylesheet' type='text/css'>");
            }
        ?>
    </head>

    <body >
        <?php require_once("header.php"); ?>    

        <section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
            <div class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h2 id="h2">JOIN</h2>
                        </div>
                    </div>
                    <form id="register_form" name="contentForm" data-toggle="validator" role="form" >          
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                                <div class="form schedule-assessment">
                                    <div class="row margin-top-l">
                                        <div class="form-group col-md-12 text-center">
                                            <label for="email" class="login">?????????(?????????)</label><br>
                                            <input name="email" id="email" class="input_filed" maxlength="50" placeholder="???????????? ??????????????????" type="email" data-emailClear data-error="email??? ??????????????????." 
                                                required>
                                            <input name="duplicate" id="duplicate" type="hidden" value="true">
                                            <div class="help-block with-errors email"></div>
                                        </div><!-- close col-->  
                                        <div class="form-group col-md-12 text-center">
                                                <label for="password" class="login lg">????????????</label><br>
                                                <input name="password" id="password" class="input_filed" data-pwPattern maxlength="15" placeholder="??????????????? ??????????????????" type="password" data-minlength="8" data-error="password??? 8????????? 15??? ????????? ??????????????????" data-pwPattern-error="??????,??????,??????????????? ???????????? ??????????????????."  required>
                                                <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group col-md-12 text-center">
                                                <label for="password" class="login lg">??????????????????</label><br>
                                                <input name="password_confirm" id="password_confirm" class="input_filed" maxlength="15" placeholder="??????????????? ??????????????????" type="password" 
                                                    data-minlength="8" data-match="#password" data-match-error="??????????????? ???????????? ????????????." data-error="password??? 8????????? 15??? ????????? ??????????????????" required>
                                                <div class="help-block with-errors"></div>
                                        </div> 
                                        <div class="form-group col-md-12 text-center">
                                                <label for="name" class="login lg">??????</label><br>
                                                <input name="name" id="name" maxlength="10" class="input_filed" placeholder="????????? ??????????????????" type="text" pattern="(^[a-zA-Z]{1,15}$)|(^[???-???]{1,15}$)"
                                                    data-error="????????? ??????????????????" required>
                                                <div class="help-block with-errors"></div>
                                        </div> 

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="text-center">
                                                    <div class="checkbox">
                                                        <label>
                                                        <input class="cd" type="checkbox" name="digital_brochure" value="true">
                                                        ??????????????????(??????)
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="add">
                                                <div class="form-group col-md-12 text-center">
                                                        <label for="post" class="login lg">????????????</label><br>
                                                        <input name="post" id="post" class="input_filed" maxlength="10" placeholder="" type="text" readonly>
                                                        <button id="address_find" class="bt_j" type="button">????????????</button>
                                                        <div class="help-block with-errors"></div>
                                                </div> 
                                                <div id="daum_api" style="display:none;width:300px;"></div>
                                                <div class="form-group col-md-12 text-center">
                                                        <label for="post" class="login address">??????</label><br>
                                                        <input name="post_1" id="post_1" class="input_filed" maxlength="50" placeholder="" type="text" readonly><br>
                                                        <label for="post" class="login daddress">????????????</label><br>
                                                        <input name="post_2" id="post_2" class="input_filed" maxlength="50" placeholder="" type="text"   >
                                                        <div class="help-block with-errors"></div>
                                                </div>
                                        </div>
                                    <!-- close col-->
                                    </div><!-- close row-->
                                </div>
                                <!-- close row-->
                                    <div class="form-group text-center go">
                                        <button class="btn">????????????</button>	
                                        <button id="cancellation" class="btn" type="button">??????</button>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <?php require_once("footer.php"); ?>

        <script type="text/javascript">
        

            /*
				@biref :	???/??? ???????????? ??????		
				@author :	?????????
				@date :		2020-11-12	
			*/
            $(function(){
                $(".gnb_btn").click(function(){
                    $(".gnb_list").slideToggle();
                    return false;
                });

                $(window).resize(function(){
                    if ( $(this).width() > 767 ) {
                            $(".gnb_list").show();
                    } else {
                        $(".gnb_list").hide();
                    }
                });

                $(function(){
                    $(".add").hide();
                    $(".cd").click(function(){
                        $(this).toggleClass("on");
                        $(".add").toggle();
                    });
                });
            });	

            $('#register_form').validator({
                delay:1500000,
				custom:{
					'emailClear': function() {
						$('.help-block.with-errors.email').html('');
						return false;
					},
                    'pwPattern': function() {
                        var password = $('#password').val();
                        regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,15}$/;

                        if(password.match(regex) == null) {
                            return true;
                        } else {
                            return false;
                        }
                    }
				},
				errors: {
					emailClear: '',
                    pwPattern: ''
				}
			});

            /**
             * @brief:  ?????? ??????
             * @author: ?????????
             * @date:   2020-11-17
             */
            $('#register_form').validator().on('submit', function(e) {
                if($('#email').val() != '') {
                    if($('#duplicate').val() == 'true') {
                        $('.help-block.with-errors.email').html("<ul class='list-unstyled'><li class='custom'>????????? ??????????????????.</li></ul>");
                        $('li.custom').css('color', '#a94442');
                        return false;
                    } else {
                        $('.help-block.with-errors.email').html("<ul class='list-unstyled'><li class='custom'>?????? ????????? ??????????????????.</li></ul>");
                        $('li.custom').css('color', 'green');
                    }
                }
                
                if(!e.isDefaultPrevented()) {
						$.ajax({
							url: './hendler/userHendler.php',
							type: 'post',
							data: $('#register_form').serialize(),
							datatype: 'json',
							success: function(result) {
                                var result = JSON.parse(result);

                                if(result.registerResult > 0) {
                                    location.href = 'login.php';
                                } else {
                                    location.href = 'error.php';
                                }
							},
							error: function(result) {
                                location.href = 'error.php';
							}
						});
						return false;
					} else {
						return false;
					}
            });

            

            /**
             * @brief:  ????????? ????????????
             * @author: ?????????
             * @date:   2020-11-17
             */
            $('#email').focusout(function() {
                var regex = /^(([a-zA-Z0-9\_\-]){1,}@([a-zA-Z0-9\.\_\-]){1,})$/;
                var regexResult = $('#email').val().search(regex);
                if($('#email').val() != '' && regexResult > -1) {
                    $.ajax({
                        url: './hendler/etcHendler.php',
                        type: 'get',
                        data: {
                            'email': $('#email').val()
                        },
                        datatype: 'json',
                        success: function(result){
                            var result = JSON.parse(result);
                            console.log(result);
                            if(result.duplicate) {
                                $('.help-block.with-errors.email').html("<ul class='list-unstyled'><li class='custom'>" + result.msg + "</li></ul>");
                                $('li.custom').css('color', '#a94442');
                                $('#duplicate').val(true);
                            } else {
                                $('.help-block.with-errors.email').html("<ul class='list-unstyled'><li class='custom'>" + result.msg + "</li></ul>");
                                $('li.custom').css('color', 'green');
                                $('#duplicate').val(false);
                            }
                        }
                    });
                }
            });

            /**
             * @brief:  ?????? ?????? api
             * @author: ?????????
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

            /*
				@biref :	?????? ??????		
				@author :	?????????
				@date :		2020-11-19	
			*/
            $('#cancellation').click(function(){
                location.href = 'index.php';
            });

            /**
                @biref  ???????????? ??????
                @author ?????????
                @date   2021-06-10
             */
             $('.cd').click(function() {
                if($('.cd').prop('checked') == true) {
                    $('body').attr('style', 'overflow: auto');
                } else {
                    $('body').attr('style', 'overflow: hidden');
                    $('html body').stop().animate({scrollTop: 0}, 0)
                }
             });

            
        </script>
    </body>
</html>