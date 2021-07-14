var insertData = {
    material:[],
    subsidiary:[],
    size:{},
    grading:{},
    label:{
        main:[],
        care:[]
    },
    detailLocation:{}
};

$(function () {
    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        labels: {
            next: $('#next').html(),
            previous : $('#previous').html()
        },
        // enablePagination : false,
        onStepChanging: function (event, currentIndex, newIndex) {
            if(currentIndex == 0 && currentIndex < newIndex) {
                result = boxValidation(currentIndex);

                return result;
            }
            if($('#complete_injection').data('value') == 'true' || $('#im_processing').data('value') == 'true') {
                if(currentIndex == 4) {
                    $('.before').show();
                    $('.grading_w tbody .after').remove();
                    var mSize = false;
                    var sizeId = [];
                    $('input:checkbox[name=digital_brochure]:checked').each(function(length, data) {
                        if($(this).val() != 'M') {
                            sizeId.push($(this).val());
                        } else {
                            sizeId.splice(0,0,$(this).val());
                        }
                        insertData['size'][$(this).val()] = $('#' + $(this).val()).val(); 
                    });
    
                    $.each(sizeId, function(index, item) {
                        valueId = item;
                        var gradingLength = $('input:checkbox[name=digital_brochure]:checked').length;
    
                        $('.grading_w').each(function(key, item) {
                            var before = $(this).find('.before').clone();
                            before.remove('span');
                            before.data('size', valueId);
                            before.find('input').remove('.mobile');
                            before.find('input').attr('class', '');
                            before.find('input').addClass('size_grading');
                            before.find('input').addClass('size_w');
    
                            if(gradingLength > 1 && index != 0) {
                                before.find('.list').text('그레이딩' + valueId);
                                before.find('input').addClass('grading_value');
                                before.find('input').val('');
                            }  else {
                                $('.grading-ct').text("*기준사이즈는 " + valueId + "사이즈 입니다");
                                before.find('input').addClass('input_size_value');
                            }
    
                            before.find('input').each(function(key, data) {
                                var id = $(this).attr('id') + "-" + valueId;
                                $(this).attr('id', id);
                            });
    
                            before.attr('class', 'after');
                            if(sizeId == 'M') {
                                $(this).find('tbody').prepend(before);
                            } else {
                                $(this).find('tbody').append(before);
                            }
                            
                        });
                    });
                    
                    $('.before').hide();
                }
    
                if(currentIndex == 5) {
                    $(".size_grading").each(function(key, item) {
                        insertData['grading'][$(item).attr('id')] = $(item).val();
                    });
                }

                if($('#complete_injection').data('value') == 'true') {
                    if(currentIndex == 6 && currentIndex < newIndex) {
                        result = true;
                        insertData['label_check'] = '';
                        $('input:checkbox[name=digital_brochure_label]:checked').each(function() {
                            insertData['label_check'] += $(this).val() + ".";
                        });

                        if($('input:checkbox[name=digital_brochure_label]:checked').length < 1) {
                            $('#mark-label').addClass('select_mis');
                            result = false;
                        }
        
                        if(result) {
                            if($('#made-main').prop('checked')) {
                                if($('#image-main').length < 1) {
                                    result = false;
                                }
                            }

                            if($('#ready-made-main').prop('checked')) {
                                if($('#select_main').val() == '') {
                                    result = false;
                                }
                            }

                            if($('#made-care').prop('checked')) {
                                if($('#image-care').length < 1) {
                                    result = false;
                                }
                            }

                            if($('#ready-made-care').prop('checked')) {
                                if($('#select_care').val() == '') {
                                    result = false;
                                }
                            }
                        }
        
                        if($('.confirm_img_sub').length < 1 || $('table.subsidiary_table').length != $('.confirm_img_sub').length) {
                            $('#prosses7').addClass('select_mis');
                            result = false;
                        }
        
                        return result;
                    }
                }
    
                if(currentIndex == 5 && currentIndex < newIndex) {
                    result = true;
                    
                    $(".size_grading").each(function(key, item) {
                        if($(item).val() == "") {
                            $(this).addClass('select_mis');
                            result = false;
                        }
                    });
    
                    return result;
                }

                if(currentIndex == 4 && currentIndex < newIndex) {
                    if($('#complete_injection').data('value') == 'true') {
                        if($('.confirm_img').length < 1 || $('table.material_table').length != $('.confirm_img').length) {
                            $('#prosses5').addClass('select_mis');
                            return false;;
                        }
                    }
    
                    if($('input:checkbox[name=digital_brochure]:checked').length < 1) {
                        $('.check-size').addClass('select_mis');
                        return false;
                    } else {
                        var result = true;
    
                        $('input:checkbox[name=digital_brochure]:checked').each(function() {
                            var sizeId = $(this).val()
                            
                            if(!$("#" + sizeId).val()) {
                                $("#" + sizeId).addClass('select_mis');
                                $("#" + sizeId).focus();
    
                                result = false;
                            }
                        });
    
                        if($('#sewing option:selected').val() == "") {
                            $('#sewing').addClass('select_mis');
                            result = false;
                        } 
    
                        return result;
                    }
                }

                if(currentIndex < 4  && currentIndex < newIndex) {
                    result = boxValidation(currentIndex);

                    return result;
                }
            }

            // 화면 캡처
            // if(currentIndex == 7) {
            //     var img = $("body")[0];

            //     html2canvas(img).then(function(canvas) {
            //         var myImg = canvas.toDataURL("image/png");
            //         myImg = myImg.replace("data:image/png;base64,", "");
            //         insertData['process_img'] = myImg;
            //     });
            // }
            
            if(currentIndex == 8 && currentIndex < newIndex) {
                result = false;

                $('.box.delivery_box').each(function(key, item) {
                    if($(this).data('value') == 'true') {
                        result =true;

                        insertData['delivery_box'] = $(this).data('insert');
                    }
                });

                if(!result) {
                    $('.box.delivery_box').css("animation", "danger 1500ms 3");
                    result = false;
                }

                return result;
            }

            if(currentIndex == 7 && currentIndex < newIndex) {
                result = true;

                if($('#processing_s option:selected').val() == "") {
                    $('#processing_s').addClass('select_mis');
                    result = false;
                }

                $('.detail-location').each(function(key, item) {
                    insertData['detailLocation'][$(item).attr('id')] = $(this).val();

                    if($(this).val() == "") {
                        $(this).addClass('select_mis');
                        result = false;
                    }
                }); 

                return result;
            }

            var titleItems = ["의뢰자 종류 및 의뢰방식","의류카테고리", "의류종류","의류핏", "의류개수 및 원단", "그레이딩", "부자재", "가공방식", "납기일 종류", "견적금액 및 납기 예정일 확인"];
            var mainTitle = document.getElementsByClassName('main-title');
            mainTitle[0].innerText = titleItems[newIndex];

            if(newIndex === 3){
                $(".interim").show();
            } else if(newIndex <= 2){
                $(".interim,.m_bt").hide();
            } 
            
            return true;
        },
        onStepChanged: function(event, currentIndex, newIndex){
            
            if($('#manufacturing_check').data('value') == true) {
                $('#wizard').steps('setStep', 7);
                $('#manufacturing_check').data('value', false);
            }
            
            if($('#im_processing_check').data('value') == true) {
                if(currentIndex == 6) {
                    $('#wizard').steps('setStep', 7);
                }
                $('#prosses5').hide();
                $('#material_p').hide();
                $('#prosses5').attr('disabled', true);
                $('#subsidiary-label').hide();
                $('#subsidiary-label').attr('disabled', true);
            } else {
                $('#prosses5').show();
                $('#material_p').show   ();
                $('#prosses5').attr('disabled', false);
                $('#subsidiary-label').show();
                $('#subsidiary-label').attr('disabled', false);
            }
        },
        onFinishing: function (event, currentIndex) {
            console.log(insertData);

            var form = $('#subsidiary-label')[0];
            var formData = new FormData(form);

            formData.append('sortation', insertData['sortation_box']);
            formData.append('category', insertData['category_box']);
            formData.append('clothesDetail', insertData['detail_box']);
            formData.append('clothes', insertData['clothes_box']);
            formData.append('fit', insertData['fit_box']);
            formData.append('delivery', insertData['delivery_box']);
            formData.append('process', insertData['prosses_box']);
            formData.append('sewing', insertData['sewing']);
            formData.append('sizeNumber', insertData['size_number']);
            formData.append('label', insertData['label_check']);
            formData.append('labelMainType', $('input:checkbox[name=label-main]:checked').val());
            formData.append('labelCareType', $('input:checkbox[name=label-care]:checked').val());
            formData.append('labelMainNumber', $("#select_main").val());
            formData.append('labelCareNumber', $("#select_care").val());
            formData.append('labelKomaNumber', $("#select_koma").val());
            formData.append('manufacturingType',$('#processing_s option:selected').val());
            formData.append('fitName', insertData['fit_name']);

            $.each(insertData['grading'], function(key, item) {
                formData.append("grading[" + key + "]", item);
            });
            $.each(insertData['material'], function(key, item) {
                formData.append("material[" + key + "]", item);
            });
            $.each(insertData['subsidiary'], function(key, item) {
                formData.append("subsidiary[" + key + "]", item);
            });
            $.each(insertData['size'], function(key, item) {
                console.log(key);
                formData.append("size[" + key + "]", item);
            });
            $.each(insertData['detailLocation'], function(key, item) {
                formData.append("detailLocation[" + key + "]", item);
            });
            formData.append('image-care', $('#image-care')[0].files[0]);
            $('.bkg-file').each(function() {
                formData.append($(this).attr('id'), $(this)[0].files[0]);
            });
            $('.canvas-img-top').each(function(key, item) {
                formData.append("top[" + $(this).attr('id') + "]", $(this).val());
            });
            $('.canvas-img-left').each(function(key,item) {
                formData.append("left[" + $(this).attr('id') + "]", $(this).val());
            });

            $('.angle').each(function(key,item) {
                formData.append("angle[" + $(this).attr('id') + "]", $(this).val());
            });

            var key = ['scaleX', 'scaleY'];

            for(var i = 0; i < 2; i++) {
                $('.' + key[i]).each(function() {
                    formData.append(key[i] + "[" + $(this).attr('id') + "]" , Math.round(Number($(this).val() * 100000)));
                });
                
            }

            console.log(formData);
            $.ajax({
                url: './hendler/orderHendler.php',
                datatype: 'json',
                type: 'post',
                enctype: 'multipart/form-data',
                contentType : false,
                processData : false,
                data: formData,
                success: function(result) {
                    if(result) {
                        location.href = 'https://www.madclother.com/dev/electronic.php';
                    } else {
                        return false;
                    }
                }
            });

            return false;
        }
    });

    function boxValidation(currentIndex) {
        var boxName = [
            ["sortation_box", "prosses_box"],
            "category_box", 
            ["clothes_box", "detail_box"],
            "fit_box"
        ];

        var spanIndex = {
            "sortation_box": 0,
            "prosses_box": 1,
            "category_box": 2,
            "clothes_box": 3,
            "detail_box": 4,
            "fit_box": 5
        };

        var exit = false;
        var check = [false, false];

        $('.box.' + boxName[currentIndex]).each(function() {
            if(currentIndex == 0 || currentIndex == 2) {
                for(var i = 0; i < 2; i++) {
                    $('.box.' + boxName[currentIndex][i]).each(function() {
                        if($(this).data('value') == 'true') {
                            check[i] = true;
                        }
                    });
                }

                if(check[0] && check[1]) {
                    exit = true;
                }

                if(!check[0]) {
                    if(currentIndex == 0) {
                        $('.sortation_box').css("animation", "danger 1500ms 3");
                    } else if(currentIndex == 2) {
                        $('.clothes_box').css("animation", "danger 1500ms 3");
                    }
                    $(".sub-title-error span").eq(spanIndex[boxName[currentIndex][0]]).show(); 
                }

                if(!check[1]) {
                    if(currentIndex == 0) {
                        $('.prosses_box').css("animation", "danger 1500ms 3");
                    } else if(currentIndex == 2) {
                        $('.detail_box').css("animation", "danger 1500ms 3");
                    }
                    $(".sub-title-error span").eq(spanIndex[boxName[currentIndex][1]]).show(); 
                }
            } else if($(this).data('value') == 'true') {
                exit = true;
            }
        });

        if(!exit) {
            if(currentIndex == 1 || currentIndex == 3) {
                $('.box.' + boxName[currentIndex]).css("animation", "danger 1500ms 3");
                $(".sub-title-error span").eq(spanIndex[boxName[currentIndex]]).show(); 
            }
            
            return false;
        } else {
            return exit;
        }
    }

    // base64 blob형으로 전환
    // function base64toBlob(base64Data, contentType) {
    //     contentType = contentType || '';
    //     var sliceSize = 1024;
    //     var byteCharacters = atob(base64Data);
    //     var bytesLength = byteCharacters.length;
    //     var slicesCount = Math.ceil(bytesLength / sliceSize);
    //     var byteArrays = new Array(slicesCount);
    
    //     for (var sliceIndex = 0; sliceIndex < slicesCount; ++sliceIndex) {
    //         var begin = sliceIndex * sliceSize;
    //         var end = Math.min(begin + sliceSize, bytesLength);
    
    //         var bytes = new Array(end - begin);
    //         for (var offset = begin, i = 0; offset < end; ++i, ++offset) {
    //             bytes[i] = byteCharacters[offset].charCodeAt(0);
    //         }
    //         byteArrays[sliceIndex] = new Uint8Array(bytes);
    //     }
    //     return new Blob(byteArrays, { type: contentType });
    // }

    $('#processing_s').change(function() {

        if($(this).val() == 'DTG') {
            $('.position.process_g').show();
        } else {
            $('.position.process_g').hide();
        }
    });

    $('#manufacturing_img').click(function() {
        $(this).parents('p').removeClass('select_mis');
    });

    $('#processing_s').click(function() {
        $(this).removeClass('select_mis');
    });

    $('.detail-location').click(function() {
        $(this).removeClass('select_mis');
    });

    $('#image-care').click(function() {
        $(this).parents('td').removeClass('select_mis');
    }); 

    $('#image-main').click(function() {
        $(this).parents('td').removeClass('select_mis');
    }); 

    $('.label-check-main').click(function() {
        $(this).parents('td').removeClass('select_mis');
    });

    $('.label-check-care').click(function() {
        $(this).parents('td').removeClass('select_mis');
    });

    $('.check-b').click(function() {
        $('#mark-label').removeClass('select_mis');
    });

    $('#prosses7').click(function() {
        $(this).removeClass('select_mis');
    });

    $('#prosses5').click(function() {
        $(this).removeClass('select_mis');
    });

    $('.check-s').click(function() {
        $('.check-size').removeClass('select_mis');
        $('.size_val').removeClass('select_mis');
    });

    $('#sewing').click(function() {
        $(this).removeClass('select_mis');
    });

    $('.size_val').click(function() {
        $(this).removeClass('select_mis');
    });

    $(document).on('click', '.grading_value', function() {
        $(this).removeClass('select_mis');
    });

    $(document).on('click', '.fit_box', function() {
        insertData['fit_name'] = $(this).find('p').text();
    });

    $(document).on('change', '#sewing', function() {
        insertData['sewing'] = $('#sewing option:selected').val();
    });

    $(".kind .box").click(function(){            
        $('html,body').animate({scrollTop:$(".means").offset().top}, 1000);
    });
  
    $(".m_bt").click(function(){
        $(".interim").fadeToggle(500);
    });
    
    $(document).on('click','.size_w0',function(){
        $(".arrow").hide();
        $(".arrow0").show();
    });
    $(document).on('click','.size_w1',function(){
        $(".arrow").hide();
        $(".arrow1").show();
    });
    $(document).on('click','.size_w2',function(){
        $(".arrow").hide();
        $(".arrow2").show();
    });
    $(document).on('click','.size_w3',function(){
        $(".arrow").hide();
        $(".arrow3").show();
    });
    $(document).on('click','.size_w4',function(){
        $(".arrow").hide();
        $(".arrow4").show();
    });
    $(document).on('click','.size_w5',function(){
        $(".arrow").hide();
        $(".arrow5").show();
    });
    $(document).on('click','.size_w6',function(){
        $(".arrow").hide();
        $(".arrow6").show();
    });
    $(document).on('click','.size_w7',function(){
        $(".arrow").hide();
        $(".arrow7").show();
    });
    $(document).on('click','.size_w8',function(){
        $(".arrow").hide();
        $(".arrow8").show();
    });
    $(document).on('click','.size_w9',function(){
        $(".arrow").hide();
        $(".arrow9").show();
    });

    $(document).on('click', '.box', function() {
        var boxName = $(this).attr('class').split(' ');
        $('.box').css("animation", false);
        $(".sub-title-error span").hide(); 
       
        $('.box.' + boxName[1]).each(function() {
            if($(this).data('value') == 'true') {
                $(this).data('value','false');
                $(this).css("background","#efefef");
            }
        });
        insertData[boxName[1]] = $(this).data('insert');

        var boxDetail = $(this).attr('class').split(' ');
        
        if( boxDetail[1] == 'prosses_box') { 
            if( $(this).attr('id') == 'manufacturing' ) {
                $('#manufacturing_check').data('value', true);
            } else {
                $('#manufacturing_check').data('value', false);
            }
    
            if( $(this).attr('id') == 'im_processing' ) {
                $('#im_processing_check').data('value', true);
            } else {
                $('#im_processing_check').data('value', false);
            }
        }
        
        $(this).data('value', 'true');
        $(this).css("background","#daa520");
        $(this).css("color","#000");
    });


    $(document).on('click','.type >.box',function(){
        
        $(".type_detail,.type_detail_p1").show();
        $('html,body').animate({scrollTop:$(".type_detail").offset().top}, 1000);
    });

    $(document).on('click','input.check-label',function(){
        var id = $(this).attr('id');

        if($(this).prop('checked')) {

            $.ajax({
                url: './hendler/orderHendler.php?category=label&type=' + $(this).data('value'),
                type: 'get',
                success: function(result) {
                    var result = JSON.parse(result);
                    $('#select_' + id).html("<option value=''>선택</option>");
                    $.each(result, function(key, item) {
                        $('#select_' + id).append("<option value='" + item.label_number + "'>" + item.label_name + "</option>");
                    });
                }
            });

            $("#label-" + id).show();
            $("#none").prop('checked', false);
        } else {
            $("#label-" + id).hide();
        }
    });

    $(document).on('click','input.label-check-main',function(){
        $('.label-check-main').prop('checked', false);
        $(this).prop('checked', true);

        if($(this).attr('id') == "ready-made-main") {
            $('#select_main').attr('disabled', false);
            $('.label_img').eq(1).show();
            $('.label_file').eq(1).hide();
        } else {
            $('#select_main').attr('disabled', true);
            $('.label_img').eq(1).hide();
            $('.label_file').eq(1).show();
        }
    });

    $(document).on('click','input.label-check-care',function(){
        $('.label-check-care').prop('checked', false);
        $(this).prop('checked', true);

        if($(this).attr('id') == "ready-made-care") {
            $('#select_care').attr('disabled', false);
            $('.label_img').eq(0).show();
            $('.label_file').eq(0).hide();
        } else {
            $('#select_care').attr('disabled', true);
            $('.label_img').eq(0).hide();
            $('.label_file').eq(0).show();
        }
    });

    $(document).on('change', '.label_select', function() {
        $img = $("#" + $(this).data('id'));
        $($img).attr('src', './img/orderImg.php?category=label&no=' + $(this).val());
        console.log($img);
    });

    function setToday() {
        var date = new Date();

        var year = date.getFullYear() + "년 ";
        var month = (date.getMonth() + 1) + "월 ";
        var day = ("0" + date.getDate()).slice(-2) + "일";
        var today = "납기예정일,: " + year + month + day;
        $("#today_date").html(today);
    }

    setToday();
    

    function initScreen(){

        $(".type_detail,.type_detail_p1").hide();
        $(".interim").hide();
        $(".blind-main").hide();
        $(".m_bt").hide();
        $(".arrow").hide();
        $(".sub-title-error span").hide(); 
    }

    initScreen();

    $('.file_img').on('change', function() {
        var index = $(".file_img").index(this);

        ext = $(this).val().split('.').pop().toLowerCase(); //확장자
        
        //배열에 추출한 확장자가 존재하는지 체크
        if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            resetFormElement($(this)); //폼 초기화
            window.alert('이미지 파일이 아닙니다! (gif, png, jpg, jpeg 만 업로드 가능)');
        } else {
            file = $(this).prop("files")[0];
            blobURL = window.URL.createObjectURL(file);
            $('.img_view img').eq(index).attr('src', blobURL);
            $('.img_view').eq(index).slideDown(); //업로드한 이미지 미리보기 
            $(this).slideUp(); //파일 양식 감춤
        }
    });

    $('.img_view a').bind('click', function() {
        var index = $(".img_view a").index(this);
        resetFormElement($('.file_img').eq(index)); //전달한 양식 초기화
        $('.file_img').eq(index).slideDown(); //파일 양식 보여줌
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