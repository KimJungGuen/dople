<?php
    session_start();
       
    if(isset($_SESSION['autoLogin']) && isset($_SESSION['userNumber'])) {
        setcookie('userNumber', $_SESSION['userNumber'], time() + 3600);
    } else if(empty($_SESSION['userNumber'])) {
        setcookie('userNumber', $_SESSION['userNumber'], time() - 3600);
        $_COOKIE['userNumber'] = null;
    }
    
?>
<header>
    <div class="inner">
        <h1><a href="index.php"><img src="images/logo_2.png"></a></h1>
        <input type="hidden" id="sns_type" name="sns_type" value="<?php echo $_SESSION['userSnsType'] ?>">
        <nav class="gnb">
            <a href="#" class="gnb_btn"><img src="images/gnb_btn.png" alt="전체메뉴"></a>
            
            <ul class="gnb_list">
                <?php if(isset($_SESSION['userNumber']) || isset($_COOKIE['userNumber'])) { ?>
                    <li><a href='client.php'>생산의뢰</a></li>
                    <li><a href='sample.php'>샘플</a></li>
                    <li><a href='create.php'>생산</a></li>
                    <li><a href='c-service.php'>고객센터</a></li>
                <?php }  else { ?>
                    <li><a href="service_int.php">서비스소개</a></li>
                    <li><a href="ug.php">이용안내</a></li>
                    <li><a href="c-service.php">고객센터</a></li>
                <?php } ?>
                <?php 	
                    if(isset($_SESSION['userNumber']) || isset($_COOKIE['userNumber'])) {
                        if($_SESSION['userSnsType'] != 'company') {
                            $link = 'address.php';
                        } else {
                            $link = 'infor.php';
                        }
                        
                        echo("
                            <li><a href='javascript:logout();'>로그아웃</a></li>
                            <li><img src='images/line.jpg' alt='' ></li>
                            <li><a href='{$link}'>정보수정</a></li>	
                        ");
                    } else {
                        echo("
                            <li><a href='login.php'>로그인</a></li>
                            <li><img src='images/line.jpg' alt='' ></li>
                            <li><a href='join.php'>회원가입</a></li>	
                        ");
                    }
                ?>
            </ul>
        </nav>
    </div>		
</header>

<script type="text/javascript">

    /**
	@biref : 	로그인
	@author : 	김정근
	@date : 	2020-11-17
	 */
    function logout(){ 
        //자사 서비스 로그아웃
        $.ajax({
			url: './hendler/loginHendler.php',
			type: 'delete',
			datatype: 'json',
			success: function(result) {
                location.href = 'index.php';
			},
			error: function(result) {
			}
		});
    }
</script>