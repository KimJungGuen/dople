 //간편하게 재사용이 가능하도록 함수로 모듈화 
 $(function(){
     //이벤트 관련 함수 모아둔 함수
    function eventFunc(){
        // 윈도우 리사이징 이벤트 
        $(window).resize(function(){
            
            initScreen();

        });

        //.cd 클래스 선택자 클릭시 발생하는 이벤트
        $(".cd").click(function(){
            $(this).toggleClass("on");
            $(".add").toggle();
        });

        //.gnb_btn 클래스 선택자 클릭시 발생하는 이벤트
        $(".gnb_btn").click(function(){
            $(".gnb_list").slideToggle();
            return false;
        });

    }

    //결제관리 페이지 접속시 디바이스에 맞게 ui 초기화 시켜주는 함수
    function initScreen(){
        var type = null;

        if ( $(this).width() > 767 ) {
            $(".gnb_list").show();
            type = 'desktop';

        } else {
            $(".gnb_list").hide();
            type = 'mobile';
        }
        
        //해상도에 맞는 UI로 초기화시켜주는 함수
        setMobileMode(type);

    }

    //웹 활성화시 초기 세팅해야 되는 UI 관련 함수를 호출해주는 초기화 함수 (구조상 편리하게 모듈화 한것)
    function initFunc(){

        initScreen();
     
        //이벤트 모아둔 함수 활성화 
        eventFunc();

    }

     
 function setMobileMode(type){

    var colspanCount = 4;


    //모든 .afternoon-session tbody tr를 탐색 
    $('.afternoon-session tbody tr').each(function() {

        //.afternoon-session tbody tr 에 있는 첫번째 td, 두번째 td 를 사용하기 편하게 하기 위해 변수에 저장
        var td0 = $(this).find("td:eq(0)");
        var td1 = $(this).find("td:eq(1)");

        //type parameter에 따라 UI 제어
        if(type === 'mobile'){
            colspanCount = 3;
            
            //첫번째 td에 div element가 없을때 div element 형식으로 td1의 내용 (td1.himl()) 삽입
            if(td0.find('div').length < 1){
                td0.append("<div>" + td1.html() + "</div>");
            }
            
            //두번째 td 숨김
            td1.hide();
        }else{
            
            //첫번째 td에 div element 삭제
            td0.find('div').remove();
            
            //두번째 td 활성화
            td1.show();
        }

    });
     


    //모든 .afternoon-session thead th를 탐색 
    $('.afternoon-session thead th').each(function(){
        //colspan를 colspanCount 값으로 수정하는 메서드
        $(this).attr('colspan', colspanCount);
    });

}

initFunc();


});	


