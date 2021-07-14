<?php
    include("../NHNKCP_PAYMENT_STANDARD_LINUX_PHP/cfg/site_conf_inc.php");
    require("./dbConnect/holler.php"); 
    session_start();

    $model = new holler();
    $user = $model->getUser($_SESSION['userNumber'] ?: $_COOKIE['userNumber']);
    $_SESSION['orderNumber'] = $_POST['order_number'];
?>

<!doctype html>
<html>
<head>
<!-- <meta charset="utf-8"> -->
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Expires" content="-1">

<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<title>Madclother</title>
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<link href="css/payment.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
		/****************************************************************/
        /* m_Completepayment  설명                                      */
        /****************************************************************/
        /* 인증완료시 재귀 함수                                         */
        /* 해당 함수명은 절대 변경하면 안됩니다.                        */
        /* 해당 함수의 위치는 payplus.js 보다먼저 선언되어여 합니다.    */
        /* Web 방식의 경우 리턴 값이 form 으로 넘어옴                   */
        /****************************************************************/
		function m_Completepayment( FormOrJson, closeEvent ) 
        {
            var frm = document.order_info; 
         
            /********************************************************************/
            /* FormOrJson은 가맹점 임의 활용 금지                               */
            /* frm 값에 FormOrJson 값이 설정 됨 frm 값으로 활용 하셔야 됩니다.  */
            /* FormOrJson 값을 활용 하시려면 기술지원팀으로 문의바랍니다.       */
            /********************************************************************/
            GetField( frm, FormOrJson ); 

            
            if( frm.res_cd.value == "0000" )
            {
                frm.submit(); 
            }
            else
            {
                alert( "[" + frm.res_cd.value + "] " + frm.res_msg.value );
                
                closeEvent();
            }
        }
</script>

<script type="text/javascript" src='<?=$g_conf_js_url?>'></script>

<script type="text/javascript">
	
	function pay()
     {
      var frm = document.order_info;

      frm.pay_method.value="111000000000"; //신용카드

    //    if (frm.pay_method[0].checked)
    //    {
    //         frm.pay_method.value="100000000000"; //신용카드
    //    }

    //    else if (frm.pay_method[1].checked)
    //    {
    //        frm.pay_method.value="010000000000"; //계좌이체
    //    }

    //    else if (frm.pay_method[2].checked)
    //    {
    //        frm.pay_method.value="001000000000"; //가상계좌
    //    }

    //    else if (frm.pay_method[3].checked)
    //    {
    //        frm.pay_method.value="000010000000"; //휴대폰
    //    }

    //    else if (frm.pay_method[4].checked)
    //    {
    //        frm.pay_method.value="000100000000"; //포인트
    //    }

    //    else if (frm.pay_method[5].checked)
    //    {
    //        frm.pay_method.value="000000001000"; //상품권
    //    }

    //    else if (frm.pay_method[6].checked)
    //    {
    //        frm.pay_method.value="111000000000"; //신용카드/계좌이체/가상계좌
    //    }

     }
        /* 표준웹 실행 */
        function jsf__pay( form )
        {
			pay();
            try
            {
                KCP_Pay_Execute( form ); 
            }
            catch (e)
            {
                /* IE 에서 결제 정상종료시 throw로 스크립트 종료 */ 
            }
        }             

        /* 주문번호 생성 예제 */
        function init_orderid()
        {
            var today = new Date();
            var year  = today.getFullYear();
            var month = today.getMonth() + 1;
            var date  = today.getDate();
            var time  = today.getTime();

            if(parseInt(month) < 10) {
                month = "0" + month;
            }

            if(parseInt(date) < 10) {
                date = "0" + date;
            }

            var order_idxx = "Madclother" + year + "" + month + "" + date;

            document.order_info.ordr_idxx.value = order_idxx;            
        }
       
    </script>
</head>

<body onload = init_orderid();>

    <?php require_once('header.php') ?>
    
	<section class="footer-form padding-top-xl padding-bottom-xl" aria-label="Contact Form">
		<div class="wrapper">
            <div class="container">
                <div class="row">
                    <div>
                    <form name="order_info" method="post" action="../NHNKCP_PAYMENT_STANDARD_LINUX_PHP/sample/pp_cli_hub.php">
                        <ul class="list-type-1">
                            <!-- 주문번호(ordr_idxx) -->
                            <li>
                                <div class="right">
                                    <div class="ipt-type-1 pc-wd-2">
                                        <input type="hidden" name="ordr_idxx" value="" maxlength="40" readOnly/>
                                        <a href="#none" class="btn-clear"></a>
                                    </div>
                                </div>
                            </li>
                            <!-- 상품명(good_name) -->
                            <li>
                                <div class="left"><p class="title">상품명</p></div>
                                <div class="right">
                                    <div class="ipt-type-1 pc-wd-2">
                                        <input type="text" class="box" name="good_name" value="MadclotherSample" readOnly/>
                                        <a href="#none" class="btn-clear"></a>
                                    </div>
                                </div>
                            </li>
                            <!-- 결제금액(good_mny) - ※ 필수 : 값 설정시 ,(콤마)를 제외한 숫자만 입력하여 주십시오. -->
                            <li>
                                <div class="left"><p class="title">상품금액</p></div>
                                <div class="right">
                                    <div class="ipt-type-1 gap-2 pc-wd-2">
                                        <input type="text" class="box" name="good_mny" value="1004" maxlength="9" readOnly/>
                                            <a href="#none" class="btn-clear"></a>
                                        <span class="txt-price">원</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="line-type-1"></div>
                        <ul class="list-type-1">
                            <!-- 주문자명(buyr_name) -->
                            <li>
                                <div class="left"><p class="title">주문자명</p></div>
                                <div class="right">
                                    <div class="ipt-type-1 pc-wd-2">
                                        <input type="text" class="box" name="buyr_name" value="<?php echo $user['user_name'] ?>" />
                                        <a href="#none" class="btn-clear"></a>
                                    </div>
                                </div>
                            </li>
                            <!-- 주문자 E-mail(buyr_mail) -->
                            <li>
                                <div class="left"><p class="title">이메일</p></div>
                                <div class="right">
                                    <div class="ipt-type-1 pc-wd-2">
                                        <input type="text" class="box" name="buyr_mail" value="<?php echo $user['user_email'] ?>" />
                                        <a href="#none" class="btn-clear"></a>
                                    </div>
                                </div>
                            </li>
                        </ul> 
                        <?php echo var_dump($_SESSION['orderNumber']); ?>
                        <div class="line-type-1"></div>

                        <input type="hidden" id="radio-2-1" name="pay_method" value="111000000000"/>
                        <div Class="Line-Type-1"></div>
                        <ul class="list-btn-2">
                            <!-- D : 버튼 비활성시 a태그에 class disable 추가 -->
                            <!-- <li class="pc-only-show"><a href="../index.html" class="btn-type-3 pc-wd-2">뒤로</a></li> -->
                            <li><a href="#none" onclick="jsf__pay(document.order_info);" class="btn-type-2 pc-wd-3">결제요청</a></li>     
                        </ul>

                        <input type="hidden" name="req_tx"          value="pay" />
                        <input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd	?>" />
                        <input type="hidden" name="site_name"       value="<?=$g_conf_site_name ?>" />
                        <input type="hidden" name="quotaopt"        value="1"/>
                        <input type="hidden" name="currency"        value="WON"/>
                        <input type="hidden" name="module_type"     value="<?=$module_type ?>"/>
                        <input type="hidden" name="res_cd"          value=""/>
                        <input type="hidden" name="res_msg"         value=""/>
                        <input type="hidden" name="enc_info"        value=""/>
                        <input type="hidden" name="enc_data"        value=""/>
                        <input type="hidden" name="ret_pay_method"  value=""/>
                        <input type="hidden" name="tran_cd"         value=""/>
                        <input type="hidden" name="use_pay_method"  value=""/>
                        <input type="hidden" name="ordr_chk"        value=""/>
                        <input type="hidden" name="cash_yn"         value=""/>
                        <input type="hidden" name="cash_tr_code"    value=""/>
                        <input type="hidden" name="cash_id_info"    value=""/>
                        <input type="hidden" name="good_expr"       value="0">
                        <input type='hidden' name="skin_indx"       value="11">
                    </form>
                    
                </div>
            </div>
		</div>
	</section>

    

    <?php require_once('footer.php') ?>

    <script type="text/javascript" src="js/payment.js"></script>
</body>
</html>

