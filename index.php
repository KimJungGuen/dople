<?php 
    session_start();
    require_once('./dbConnect/holler.php');

    $model = new holler();

    $user = $model->getUserPwStatus($_SESSION['userNumber']);
    
    if($user == 'failed') {
        header("Location: https://www.madclother.com/dev/infor.php");
    }

?>
<!doctype html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
        <title>Madclother</title>
        <link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="css/common.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/lodash.js"></script>
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        <style>
            <?php
                session_start();
                    if(isset($_SESSION['userNumber']) || $_COOKIE['userNumber']) {
                        echo ("
                            .gnb_list li:nth-child(3){
                                display: inline-block; 
                                padding-right: 40px;
                            }
                            .gnb_list li:nth-child(4){
                                display: inline-block; 
                                padding-left: 0px;
                                padding-right: 237px;
                            }
                            .gnb_list li:nth-child(5){
                                display: inline-block; 
                                padding-left: 76px;
                            }
                        ");
                    }
            ?>
        </style>
    </head>

    <body>

        <?php require_once("header.php"); ?>
   
        <div class="container">
            <section class="background">
                <div class="content-wrapper">
                    <video width="100%" autoplay loop muted>
                        <source src="video/m_video.mp4">
                    </video>
                    <p class="content-title typo">생산부터 포장까지 원스톱 서비스<br>Madclother</p>
                    <p class="content-subtitle typo">언제 어디서나 클릭 몇번으로 하는 의류 제작</p>
                    <div class="text">
                    <?php if(empty($_SESSION['userNumber']) && empty($_COOKIE['userNumber'])) { ?>
                        <button class="login-btn">로그인</button>
                    <?php } ?>
                </div>
            </div>
            </section>
            <section class="background">
            <div class="content-wrapper">
                <p class="content-title">트렌드</p>
                <p class="content-subtitle">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras ut massa mattis nibh semper pretium.</p>
            </div>
            </section>
            <section class="background">
            <div class="content-wrapper">
                <img class="pc" src="images/moniter.png" alt="">
                <p class="content-title">의류형태사이즈</p>
                <p class="content-subtitle">Nullam tristique urna sed tellus ornare congue. Etiam vitae erat at nibh aliquam dapibus.</p>
            </div>
            </section>
            <section class="background">
                <div class="content-wrapper">
                <p class="content-title">패턴</p>
                <p class="content-subtitle">Nullam tristique urna sed tellus ornare congue. Etiam vitae erat at nibh aliquam dapibus.</p>
                </div>
            </section>
            <section class="background">
                <div class="content-wrapper">
                <p class="content-title">작업지시서</p>
                <p class="content-subtitle">Nullam tristique urna sed tellus ornare congue. Etiam vitae erat at nibh aliquam dapibus.</p>
                </div>
            </section>
        </div>

        <?php require_once("footer.php"); ?>

        <script type="text/javascript">

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
        });

        $(document).on('click', '.login-btn', function() {
            location.href="login.php";
        });
        </script>


    </body>
</html>

