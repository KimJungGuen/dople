<?php
    require_once('./dbConnect/hollerService.php');
    session_start();
    
    $model = new hollerService();
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Madclother</title>
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<link href="css/c-service.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/respond.js"></script> 
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/c-service.js"></script>
<?php
    if(isset($_SESSION['userNumber']) || isset($_COOKIE['userNumber'])) {
       echo "<link href='css/common_1.css' rel='stylesheet' type='text/css'>";
    } else {
        echo "<link href='css/common.css' rel='stylesheet' type='text/css'>";
    }
?>

</head>

<body style="overflow: auto;">
	<?php require_once('./header.php'); ?>

    <div class="visual">
            <h2>고객센터</h2>
            <img src="images/visual_img.jpg" alt="고객센터">
    </div>
    
    <div class="warp">
        <div class="inner">
            <div class="bt">
                <button class="tablink notice_btn" onclick="openPage('notice', this, '#fff')" id="defaultOpen">공지사항</button>
                <button class="tablink faq_btn" onclick="openPage('faq', this, '#fff')">FAQ</button>
                <button class="tablink contact_btn" onclick="openPage('contact', this, '#fff')">1:1문의</button>
            </div>
            <div id="notice" class="tabcontent">
                <h3>공지사항</h3>
                <?php if(empty($_GET['no'])) { ?>
                    <div class="tabcontent_warp">
                        <table class="notice_list">
                            <thead>
                                <tr>
                                    <th class="number">No</th>
                                    <th class="title">제목</th>
                                    <th class="date">등록일</th>
                                </tr>
                            </thead>
                            <tbody id="notice_tobody">
                                
                            </tbody>
                        </table>
                        <div class="page_wrap">
                            <div class="page_nation">
                            <a class="arrow pprev" href="#"><img src="images/arrow1.png" alt=""></a>
                            <a class="arrow prev" href="#"><img src="images/arrow2.png" alt=""></a>
                            <input id="point" type="hidden">
                            <a class="arrow next" href="#"><img src="images/arrow3.png" alt=""></a>
                            <a class="arrow nnext" href="#"><img src="images/arrow4.png" alt=""></a>
                            </div>
                        </div>
                        <div class="bt-2">
                            <?php if($_SESSION['adminNumber']) { ?>
                                <button class="bt_side2">글쓰기</button>
                            <?php } ?>
                        </div>
                    </div>
                    <form id="notice-form">
                        <div class="write">
                            <label for="name" class="name">제목</label>
                            <input name="title" id="notice_title" class="notice_write notice_input" placeholder="" type="text" ><br>
                            <label for="name" class="name">내용</label>
                            <textarea name="notice" class="notice_write notice_content" placeholder=""></textarea><br>
                            <div class="bt-3">
                                <button class="bt_side3" type="button">취소</button>
                                <button id="notice_submit" class="bt_side4" type="button">확인</button>
                            </div>
                        </div>
                    </form>
                <?php } else if($_GET['no']) {  
                    $notice = $model->getNotice($_GET['no']); ?>
                    <div class="tabcontent_warp">
                        <table class="notice_details">
                            <thead>
                                <tr>
                                    <th class="title">
                                        <?php echo $notice[0]['notice_title'] ?>
                                        <span class="data"><?php echo $notice[0]['notice_create'] ?></span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="line">
                                    <td class="content">
                                    <?php echo $notice[0]['notice_text'] ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="bt-2">
                            <button class="btn"><a href="c-service.php">목록</a></button>
                            <?php if($_SESSION['adminNumber']) { ?>
                                <button class="btn bt_side2">수정</button>
                                <button id="delete_notice" class="btn" type="button">삭제</button>
                            <?php } ?>
                        </div>
                    </div>
                    <form id="notice_update">
                        <div class="write">
                            <label for="name" class="name">제목</label>
                            <input name="title" id="notice_title" class="notice_write notice_input" name="title" placeholder="" type="text" value="<?php echo $notice[0]['notice_title'] ?>"><br>
                            <label for="name" class="name">내용</label>
                            <textarea class="notice_write notice_content" placeholder="" name="notice"><?php echo $notice[0]['notice_text'] ?></textarea><br>
                            <input id="notice_id" name="no" type="hidden" value="<?php echo $notice[0]['notice_number'] ?>">
                            <div class="bt-3">
                                <button class="bt_side3" type="button">취소</button>
                                <button id="update_notice" class="bt_side4" type="button">확인</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    
      
            <div id="faq" class="tabcontent">
                <h3>FAQ</h3>
                <div class="qanda">
                    <div class="search">
                            <input id="search_text" type="search" name="">
                            <img id="search" src="images/search-2.png" alt="돋보기">
                    </div>

                    <input id="faq_point" type="hidden">
                    <div class="bt-4">
                        <?php if($_SESSION['adminNumber']) { ?>
                            <button class="bt_side6">글쓰기</button>
                        <?php } ?>
                    </div>
                </div>
                <form id="faq_form">
                    <div class="write2">
                        <label for="name" class="name">제목</label>
                        <input name="title" id="faq_title" class="notice_write notice_input" placeholder="" type="text" ><br>
                        <label for="name" class="name">내용</label>
                        <textarea name="faq" class="notice_write notice_content" placeholder=""></textarea><br>
                        <div class="bt-5">
                            <button class="bt_side7" type="button">취소</button>
                            <button id="faq_register" class="bt_side8" type="button">등록</button>
                        </div>
                    </div>
                </form>
                <form id="faq_update_form">
                    <div class="write4">
                        <label for="name" class="name">제목</label>
                        <input name="title" id="faq_title_update" class="notice_write notice_input" placeholder="" type="text" ><br>
                        <label for="name" class="name">내용</label>
                        <textarea id="faq_update" name="faq" class="notice_write notice_content" placeholder=""></textarea><br>
                        <input id="faq_update_id" name="no" type="hidden" value="">
                        <div class="bt-5">
                            <button class="bt_side7" type="button">취소</button>
                            <button id="faq_update_btn" class="bt_side8" type="button">수정</button>
                        </div>
                    </div>
                </form>
            </div>    
            
            <div id="contact" class="tabcontent">
            <h3>1:1문의</h3>
            <div class="write3">

                <div class="w_list">
                    <label for="name" class="name">나의<br>문의목록</label>
                    <table class="inquiry_list">
                        <tbody>
                            <?php if($_SESSION['userNumber'] || $_COOKIE['userNumber']) { ?> <!-- 유저 !-->
                                <?php $rows = $model->getsInquiry($_SESSION['userNumber'] ?: $_COOKIE['userNumber']); ?>
                                <?php foreach($rows as $row) { ?>
                                    <tr class="line">
                                        <td class="title inquiry_title" data-number="<?php echo $row['inquiry_number'] ?>"><?php echo $row['inquiry_title'] ?></td>
                                        <td class="date">
                                            <?php 
                                                $create = preg_replace('/(\d{1,2}:\d{1,2}:\d{1,2})/', '', $row['inquiry_create']);
                                                $create = preg_replace('/-(?!.{2}\s)/', '년', $create);
                                                $create = str_replace('-', '월', $create);
                                                $create = preg_replace('/\s/', '일', $create);
                                                echo $create;
                                            ?>
                                        </td>
                                        <td class="state"><?php echo $row['inquiry_update'] ? '답변완료' : '접수중'; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php }  else if($_SESSION['adminNumber']) { ?> <!-- 관리자 !-->
                                <?php $rows = $model->getsAllInquiry(); ?>
                                <?php foreach($rows as $row) { ?>
                                    <tr class="line">
                                        <td class="title inquiry_title" data-number="<?php echo $row['inquiry_number'] ?>"><?php echo $row['inquiry_title'] ?></td>
                                        <td class="date">
                                            <?php 
                                                $create = preg_replace('/(\d{1,2}:\d{1,2}:\d{1,2})/', '', $row['inquiry_create']);
                                                $create = preg_replace('/-(?!.{2}\s)/', '년', $create);
                                                $create = str_replace('-', '월', $create);
                                                $create = preg_replace('/\s/', '일', $create);
                                                echo $create;
                                            ?>
                                        </td>
                                        <td class="state"><?php echo $row['inquiry_update'] ? '답변완료' : '접수중'; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="answer">
                        <p><img src="images/triangle.jpg" alt=""><span id="user_inquiry"></span>님이 문의 하신 내용에 대한 답변입니다</p>
                        <label for="name" class="name">제목</label>
                        <input id="answer_title" name="title" id="notice_title" class="notice_write notice_input" placeholder="" type="text" readonly disabled><br>
                        <label for="name" class="name">질문내용</label>
                        <div id="answer_question" class="notice_answer">
                        </div>
                        <label for="name" class="name">답변내용</label>
                        <?php if($_SESSION['adminNumber']) { ?>
                            <textarea id="admin_answer" name="answer" class="notice_answer" placeholder=""></textarea>
                        <?php } else { ?>
                            <textarea id="admin_answer" name="answer" class="notice_answer" placeholder="" readonly disabled></textarea>
                        <?php } ?>
                        
                        <input id="inquiry_number" type="hidden" >
                        <div class="bt-6">
                            <button class="btn_side4">확인</button>
                            <?php if($_SESSION['adminNumber']) { ?>
                                <button id="inquiry_update" type="button" class="btn_side5">수정</button>
                            <?php } ?>
                            <button type="button" class="btn_side6">취소</button>
                        </div>
                    </div>
                </div>
                
                <?php if($_SESSION['userNumber']) { ?> 
                    <form id="inquiry-form">
                        <label for="name" class="name">제목</label>
                        <input name="title" id="notice_title" class="notice_write notice_input" placeholder="" type="text" ><br>
                        <label for="name" class="name">내용</label>
                        <textarea id="inquiry_text" name="inquiry" class="notice_write notice_content" placeholder="" style="display: none;"></textarea>
                        <div contentEditable="true" id="textarea" class="notice_write notice_content" style="overflow: auto; display:inline-block;">
                        </div>
                        
                        <br>
                        <div class="add">
                            <label for="name" class="name">첨부파일</label>
                            <input type="file" name="image_1" id="image_1" class="file_img"/>
                            <button type="button" class="attach attach_add"><img src="images/free-icon-addthis-152821.png"></button>
                            <button type="button" class="attach add_del"><img src="images/free-icon-minus-151856.png"></button>
                        </div>
                        <p>첨부파일은 최대 5개까지 추가됩니다</p>
                        <div class="bt-3">
                            <button type="button" class="bt_side3">취소</button>
                            <button id="inquiry-registe" type="button" class="bt_side4">확인</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
            </div>
    </div>
   

    <?php require_once("footer.php"); ?>

    <script>

        $(function() {
            var data = get_query();
            
            $.ajax({
                url: './hendler/serviceHendler.php',
                type: 'get',
                data: {
                    page: data.page
                },
                success: function(result) {
                    result = JSON.parse(result);
                    
                    page = Math.floor(result.total / 5);

                    if(result.total % 5 != 0) {
                        page++;
                    }

                    for(var i = 1; i <= page; i++) {
                        $('#point').before("<a href='https://www.madclother.com/dev/c-service.php?page=" + i + "' class='act'>" + i + "</a>");
                    }

                    delete result.total;

                    var noticeNumber = result.noticeNumber;

                    delete result.noticeNumber;

                    $.each(result, function(key, item) {

                        create = item.notice_create.replace(/(\d{1,2}:\d{1,2}:\d{1,2})/, '');
                        create = create.replace(/-(?!.{2}\s)/, '년');
                        create = create.replace(/\-/, '월');
                        create = create.replace(/\s/, '일');

                        $('#notice_tobody').append(
                            "<tr class='line'>" +
                                "<td class='number'>" + noticeNumber + "</td>" +
                                "<td class='title'><a class='tile_link' href='c-service.php?no=" + item.notice_number + "'>" + item.notice_title + "</a></td>" +
                                "<td class='date'>" + create + "</td>" +
                            "</tr>"
                        );
                        noticeNumber--;
                    })
                }
            });


            $.ajax({
                url:'./hendler/faqHendler.php',
                type: 'get',
                data: {type: 'm'},
                success: function(result) {
                    result = JSON.parse(result);

                    $.each(result, function(key, item) {
                        $('#faq_point').before(
                            "<button class='accordion'>Q<span>" + item.faq_title + "</span></button>" +
                                "<div class='panel'>" +
                                    "<p>" + item.faq_text + "</p>" +
                                    <?php if($_SESSION['adminNumber']) { ?>
                                        "<button class='correct' data-value='" +  item.faq_number + "'>수정</button>" +
                                        "<button type='button' class='correct faq_delete btn' data-value='" +  item.faq_number + "'>삭제</button>" +
                                    <?php } ?>
                                "</div>"
                        );
                    });
                }
            });
        });

        $(document).on('keyup', '#textarea', function() {
            var index = [];
            var stack = [1,2,3,4,5];
            $(this).find('img').each(function() {
                var number = $(this).attr('id').split('_');

                index.push(Number(number[2]));
            });
            function filterIndex(val) {
                
                if(index.indexOf(val) == -1) {
                    console.log(index);
                    return val;
                }
            }

            var arr = stack.filter(filterIndex);

            $.each(arr, function(key, item){
               $('#image_' + item).val("");
            });
        });

        $(document).on('change', '.file_img', function() {
            var reader = new FileReader();
            var id = $(this).attr('id');
            reader.onload = function(e) {
                $('#textarea').find('img').each(function() {
                    
                    if($(this).attr('id') == 'pre_' + id) {
                        $(this).remove();
                    }
                });

                $('#textarea').append("<img id='pre_" + id + "' src='' width='150px' height='150px'>");
                $('#pre_' + id).attr('src', e.target.result);
            }

            reader.readAsDataURL($(this)[0].files[0]);
        });

        $(document).on('click', '.accordion', function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });

        $(document).on('click', '.correct', function() {
            $.ajax({
                url:'./hendler/faqHendler.php',
                type: 'get',
                data: {
                    type: 's',
                    no: $(this).data('value')
                },
                success: function(result) {
                    result = JSON.parse(result);

                    $('#faq_title_update').val(result.faq_title);
                    $('#faq_update').val(result.faq_text);
                    $('#faq_update_id').val(result.faq_number);
                }
            });
        });

        $('#update_notice').click(function() {
            $.ajax({
                url: './hendler/serviceHendler.php',
                type: 'put',
                data: $('#notice_update').serialize(),
                success: function(result) {
                    if(result) {
                        location.href = "https://www.madclother.com/dev/c-service.php";
                    } else {

                    }
                }
            });
        });

        $("#delete_notice").click(function() {
            $.ajax({
                url: './hendler/serviceHendler.php',
                type: 'delete',
                data: { no: $('#notice_id').val() },
                success: function(result) {
                    console.log(result);
                    if(result) {
                        location.href = "https://www.madclother.com/dev/c-service.php";
                    } else {

                    }
                }
            });
        });

        $('#faq_update_btn').click(function () {
            $.ajax({
                url:'./hendler/faqHendler.php',
                type: 'put',
                data: $('#faq_update_form').serialize(),
                success: function(result) {
                    if(result) {
                        location.reload();
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '.faq_delete', function() {
            $.ajax({
                url:'./hendler/faqHendler.php',
                type: 'delete',
                data: { no: $(this).data('value')},
                success: function(result) {
                    if(result) {
                        location.reload();
                    } else {

                    }
                }
            });
        }); 

        function get_query(){
            var url = document.location.href;
            var qs = url.substring(url.indexOf('?') + 1).split('&');
            for(var i = 0, result = {}; i < qs.length; i++){
                qs[i] = qs[i].split('=');
                result[qs[i][0]] = decodeURIComponent(qs[i][1]);
            }
            return result;
        }

        $(document).on('click', '#notice_submit', function() {
            var form = $('#notice-form')[0];
            var formData = new FormData(form);

            $.ajax({
                url: './hendler/serviceHendler.php',
                datatype: 'json',
                type: 'post',
                enctype: 'multipart/form-data',
                contentType : false,
                processData : false,
                data: formData,
                success: function(result) {
                    if(result) {
                        location.reload();
                    } else {
                        return false;
                    }
                }
            });
        });

        $(document).on('click', '#faq_register', function() {
            $.ajax({
                url: './hendler/faqHendler.php',
                datatype: 'json',
                type: 'post',
                data: $('#faq_form').serialize(),
                success: function(result) {
                    if(result) {
                        location.reload();
                    } else {
                        return false;
                    }
                }
            });
        });

        $(document).on('click', '#inquiry-registe', function() {
            $("#textarea").find('img').each(function() {
                $(this).attr('src', '');
            });
            $('#inquiry_text').val($('#textarea').html());
            console.log($('#inquiry_text').val());
            var form = $('#inquiry-form')[0];
            var formData = new FormData(form);

            $.ajax({
                url: './hendler/inquiryHendler.php',
                datatype: 'json',
                type: 'post',
                enctype: 'multipart/form-data',
                contentType : false,
                processData : false,
                data: formData,
                success: function(result) {
                    if(result) {
                        location.reload();
                    } else {
                        return false;
                    }
                }
            });
        });


        /**
         * @brief   1:1문의 상세
         * @author  김정근
         */
        $(document).on('click', '.inquiry_title', function() {
            $.ajax({
                url: './hendler/inquiryHendler.php',
                datatype: 'json',
                type: 'get',
                data:{
                    no: $(this).data('number')
                },
                success: function(result) {
                    result = JSON.parse(result);
                    $('#user_inquiry').text(result.user_name);
                    $('#answer_title').val(result.inquiry_title);
                    $('#answer_question').html(result.inquiry_question);

                    $('#answer_question').find('img').each(function(key, item) {
                        $(this).attr('id', Number(key + 1));
                        $(this).attr('src', "./img/inquiryImg.php?no=" + result.inquiry_number + "&img=" + $(this).attr('id'));
                    });
                    $('#admin_answer').val(result.inquiry_answer);
                    $('#inquiry_number').val(result.inquiry_number);
                }
            });

           
        });


        /**
         * @biref   1:1문의 답변
         * @author  김정근
         */
        $(document).on('click', '#inquiry_update', function() {
            $.ajax({
                url: './hendler/inquiryHendler.php',
                datatype: 'json',
                type: 'post',
                data:{
                    no: $('#inquiry_number').val(),
                    answer: $('#admin_answer').val()
                },
                success: function(result) {
                    result = JSON.parse(result);

                    if(result) {
                        location.reload();
                    }
                }
            });
        });

        /**
         * @biref   faq검색
         * @author  김정근
         * @date    2021-04-22
         */
        $(document).ready(function() {

            $('#search').on('click', searchFaq);
            $('#search_text').on('keyup', function(e) {
                if(e.keyCode == 13) {
                    searchFaq();
                }
            });

            function searchFaq() {
                $.ajax({
                    url: './hendler/faqHendler.php',
                    datatype: 'json',
                    type: 'get',
                    data: {
                        title: $('#search_text').val(),
                        type: 'search'
                    },
                    success: function(result) { 
                        result = JSON.parse(result);
                        $('#faq').find('.accordion').detach();
                        $('#faq').find('.panel').detach();
                        $.each(result, function(key, item) {
                            $('#faq_point').before(
                                "<button class='accordion'>Q<span>" + item.faq_title + "</span></button>" +
                                    "<div class='panel'>" +
                                        "<p>" + item.faq_text + "</p>" +
                                        <?php if($_SESSION['adminNumber']) { ?>
                                            "<button class='correct' data-value='" +  item.faq_number + "'>수정</button>" +
                                            "<button type='button' class='correct faq_delete btn' data-value='" +  item.faq_number + "'>삭제</button>" +
                                        <?php } ?>
                                    "</div>"
                            );

                            console.log(key + " : " + item);
                        });
                        
                    }
                });
            }
        });
    </script>
</body>
</html>