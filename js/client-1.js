$(function ()
{
    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        // enablePagination : false,
        onStepChanging: function (event, currentIndex, newIndex) {
            if(currentIndex < 4  && currentIndex < newIndex) {
                var boxName = [
                    ["sortation_box", "prosses_box"],
                    "category_box", 
                    ["clothes_box", "detail_box"],
                    "fit_box"
                ];

                var exit = false;
                var check = [false, false];

                $('.box.' + boxName[currentIndex]).each(function() {
                    if(currentIndex == 0 || currentIndex == 2) {
                        for(var i = 0; i < 2; i++) {
                            $('.box.' + boxName[currentIndex][i]).each(function() {
                                if($(this).css('background-color') == 'rgb(218, 165, 32)') {
                                    
                                    check[i] = true;
                                }
                            });
                        }

                        if(check[0] && check[1]) {
                            exit = true;
                        }
                    } else if($(this).css('background-color') == 'rgb(218, 165, 32)') {
                        exit = true;
                    }
                });
                console.log(exit);
                if(!exit) {
                    return false;
                }
            }
            var titleItems = ["의뢰자 종류 및 의뢰방식","의류카테고리", "의류종류","의류핏", "의류개수 및 원단", "그레이딩", "부자재", "가공방식", "납기일 종류", "견적금액 및 납기 예정일 확인"];
            var mainTitle = document.getElementsByClassName('main-title');
            mainTitle[0].innerText = titleItems[newIndex];
            console.log("currentIndex : ", currentIndex, "newIndex : ",newIndex);
            if(newIndex === 3){
                $(".interim").show();
            } else if(newIndex <= 2){
                $(".interim,.m_bt").hide();
            } 
            
            return true;
        }
    });

    $(document).on('click', '.box', function() {
        var boxName = $(this).attr('class').split(' ');
        
        $('.box.' + boxName[1]).each(function() {
            if($(this).css('background-color') == 'rgb(218, 165, 32)') {
                $(this).css("background","#efefef");
            }
        });
        
        $(this).css("background","#daa520");
        $(this).css("color","#000");
    });

    $(".type_detail").hide();
    $(".type >.box").click(function(){
        console.log("3");
        $(".type").hide();
        $(".type_detail").show();
    });
    
    $(".interim").hide();




      function initScreen(){


        if ( $(this).width() > 767 ) {
            $(".m_bt").hide();
            
            
        } else {
            
            $(".m_bt").click(function(){
                $(this).toggleClass("on");
                $(".interim").toggle();
            });
        }
        
    }

    initScreen();

    $('.file_img').on('change', function() {
        
        ext = $(this).val().split('.').pop().toLowerCase(); //확장자
        
        //배열에 추출한 확장자가 존재하는지 체크
        if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            resetFormElement($(this)); //폼 초기화
            window.alert('이미지 파일이 아닙니다! (gif, png, jpg, jpeg 만 업로드 가능)');
        } else {
            file = $('.file_img').prop("files")[0];
            blobURL = window.URL.createObjectURL(file);
            $('.img_view img').attr('src', blobURL);
            $('.img_view').slideDown(); //업로드한 이미지 미리보기 
            $(this).slideUp(); //파일 양식 감춤
        }
    });

    $('.img_view a').bind('click', function() {
        resetFormElement($('#image')); //전달한 양식 초기화
        $('.file_img').slideDown(); //파일 양식 보여줌
        $(this).parent().slideUp(); //미리 보기 영역 감춤
        return false; //기본 이벤트 막음
    });

    function resetFormElement(e) {
        e.wrap('<form>').closest('form').get(0).reset(); 
        //리셋하려는 폼양식 요소를 폼(<form>) 으로 감싸고 (wrap()) , 
        //요소를 감싸고 있는 가장 가까운 폼( closest('form')) 에서 Dom요소를 반환받고 ( get(0) ),
        //DOM에서 제공하는 초기화 메서드 reset()을 호출
        e.unwrap(); //감싼 <form> 태그를 제거
    }




});

