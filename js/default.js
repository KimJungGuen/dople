$(function(){

    //이벤트 관련 함수 모아둔 함수
    function eventFunc(){
        // 윈도우 리사이징 이벤트 
        $(window).resize(function(){
            
            initScreen();

        });

        //.cd 클래스 선택자 클릭시 발생하는 이벤트

            $(".add_1").hide()
            $(".cd").click(function(){
            $(this).toggleClass("on");
            $(".add_1").toggle();
        });

        //.gnb_btn 클래스 선택자 클릭시 발생하는 이벤트
        $(".gnb_btn").click(function(){
            $(".gnb_list").slideToggle();
            return false;
        });

    }

    //결제관리 페이지 접속시 디바이스에 맞게 ui 초기화 시켜주는 함수
    function initScreen(){


        if ( $(this).width() > 767 ) {
            $(".gnb_list").show();

            
        } else {
            $(".gnb_list").hide();

        }
        
    }

    function initFunc(){
        eventFunc();
        initScreen();
    }

initFunc();

});	
