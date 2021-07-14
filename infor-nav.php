<?php 
    require_once('./dbConnect/holler.php');
    session_start(); 
    $user = new holler();
    $userName = $user->getUserName($_SESSION['userNumber']);
?>
<nav class="quick_menu">
    <div class="quick_p">
        <P>안녕하세요<br>
            <span id="guest">
                <?php echo $userName ?>님
            </span>
        </P>
    </div>

    <ul class="quick_list">
        <?php if($_SESSION['userSnsType'] == 'company') { ?>
            <li><a href="infor.php">개인정보</a></li>
        <?php } ?>
        <li><a href="address.php">주소관리</a></li>
        <li><a href="pay.php">결제관리</a></li>
        <li><a href="licensee_main.php">사업자 관리</a></li>
    </ul>  
</nav>