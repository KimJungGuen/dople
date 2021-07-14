$(document).on('click', '#next', function() {
    if($('#check').prop('checked') == true) {
        // var IMP = window.IMP;
        // IMP.init('imp53095663');

        // IMP.request_pay({
        //     pg: 'kakaopay',
        //     pay_method: 'card',
        //     merchant_uid: 'merchant_' + new Date().getTime(),
        //     name: 'MadclotherTest',
        //     amount: 1,
        //     buyer_email: 'dbdpfk158@naver.com',
        //     m_redirect_url: 'https://www.madclother.com/dev/electronic.php'
        // }, function(rsp) {
        //     if ( rsp.success ) {
        //         var msg = '결제가 완료되었습니다.';
        //         msg += '고유ID : ' + rsp.imp_uid;
        //         msg += '상점 거래ID : ' + rsp.merchant_uid;
        //         msg += '결제 금액 : ' + rsp.paid_amount;
        //         msg += '카드 승인번호 : ' + rsp.apply_num;
        //     } else {
        //         var msg = '결제에 실패하였습니다.';
        //         msg += '에러내용 : ' + rsp.error_msg;
        //     }
        //     alert(msg);
        // });
        location.href="http://madclother.com/payment.php";
    } else {
        alert("");
    }
    
});