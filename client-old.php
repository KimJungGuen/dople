<?php 
    require_once('./dbConnect/hollerOrder.php');
    $model = new hollerOrder();

    $category = $model->getsCategory();
    $clothes = $model->getsClothes();
?>
<!doctype html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
        <title>HOLLER</title>
        <link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="js/respond.js"></script>
        <script type="text/javascript" src="js/default.js"></script>
        <script type="text/javascript" src="js/client.js"></script>
        <script src="js/jquery.steps.js"></script>
        <link href="css/client.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <?php require_once("header.php"); ?>
        
        <div class="content">

            <button class="m_bt">현재견적확인</button>
            <div class="interim">
                <table>
                    <tr>
                        <td>현재 견적 금액</td>
                    </tr>
                    <tr>
                        <td>반팔 10000</td>
                    </tr>
                    <tr>
                        <td>나그랑2000</td>
                    </tr>
                    <tr>
                    <tr>
                        <td>총액 12000</td>
                    </tr>
                </table>
            </div>

                <!-- <button style="color : black" onclick="onNext()">앞</button> -->
                <h1 class="main-title">의뢰자 종류</h1>
                <!-- <button style="color : black" onclick="onPrevious()">뒤</button> -->

            <div id="wizard" class="bundle">
                <h2>의뢰자 종류</h2>
                <section>
                    <div class="client-k">
                        <div class="kind">
                            <div class="pers box">
                                <img src="images/individual.png" alt="개인">
                                <p>개인</p>
                            </div>
                            <div class="comp box">
                                <img src="images/company.png" alt="기업">
                                <p>기업</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <form name="contentForm" class="form-sty"  role="form" data-toggle="validator" novalidate="true">
                                <div class="form schedule-assessment">
                                    <div class="row margin-top-l"> 
                                        <div class="add">
                                            <div class="form-group col-md-12 text-center">
                                                <label for="business" class="login get">기업명</label><br>
                                                <input name="business" id="businessname" class="input_filed" placeholder="" type="text" >
                                                <div class="help-block with-errors"></div>
                                            </div> 
                                            <div class="form-group col-md-12 text-center">
                                                <label for="post" class="login code">우편번호</label><br>
                                                <input name="post" id="post" class="input_filed input_f2" placeholder="" type="text" >
                                                <button class="bt_j">주소찾기</button>
                                                <div class="help-block with-errors"></div>
                                            </div> 
                                            <div class="form-group col-md-12 text-center">
                                                <label for="post" class="login address">주소</label><br>
                                                <input name="post" id="post_1" class="input_filed" placeholder="" type="text" ><br>
                                                <label for="post" class="login daddress">상세주소</label><br>
                                                <input name="post" id="post_2" class="input_filed" placeholder="" type="text" >
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group col-md-12 text-center">
                                                <label for="business" class="login get">사업자 등록번호</label><br>
                                                <input name="business" id="business" class="input_filed"  placeholder="" type="text" >
                                                <div class="help-block with-errors"></div>
                                            </div> 
                                            <div class="form-group col-md-12 text-center">
                                                <label for="business" class="login get">세금 담당자 성명</label><br>
                                                <input name="business" id="tax_name" class="input_filed" placeholder="" type="text" >
                                                <div class="help-block with-errors"></div>
                                            </div> 
                                            <div class="form-group col-md-12 text-center">
                                                <label for="business" class="login get">세금 담당자 이메일</label><br>
                                                <input name="business" id="tax_email" class="input_filed" placeholder="" type="email" >
                                                <div class="help-block with-errors"></div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>

                

                <h2>의뢰방식</h2>
                <section>
                    <div class="means">
                        <div class="process box">
                            <span data-tooltip-text=
                            "
                            본사에서 일부만 원단, 부자재, 생산">
                            <img src="images/process.png" alt="임가공">
                            <p>임가공</p>
                            </span>
                        </div>
                        <div class="full box">
                            <span data-tooltip-text=
                            "
                            귀사에서 디자인만 제공
                            본사에서 원단, 부자재, 생산">
                            <img src="images/full.png" alt="완사입">
                            <p>완사입</p>
                            </span>
                        </div>
                        <div class="request box">
                            <img src="images/request.png" alt="가공의뢰">
                            <p>가공의뢰</p>
                        </div>
                    </div>
                </section>

                <h2>의류카테고리</h2>
                <section>
                    <div class="category">
                        <?php foreach($category as $row) { ?>
                            <div class="box">
                                <img src="img/categoryImg.php?no=<?php echo $row['category_number'] ?>" alt="남성">
                                <p><?php echo $row['category_name'] ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </section>

                <h2>의류종류</h2>
                <section>
                    <div class="type">
                        <?php foreach($clothes as $row) { ?>
                            <div class="clothes box">
                                <input type="hidden" class="clothes_value" name="clothes_value" value="<?php echo $row['clothes_number'] ?>">
                                <img src="img/clothesImg.php?no=<?php echo $row['clothes_number'] ?>" alt="남성">
                                <p><?php echo $row['clothes_name'] ?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <div id="type_detail" class="type_detail">
                    </div>
                </section>


                <h2>의류핏</h2>
                <section>
                    <div id="fit" class="fit">
                        <div class="typo">
                            <p>원하는 핏이 없나요?</p>
                            <a href="#"><p>&lt;&lt; 상담페이지로 바로가기 &gt;&gt;</p></a>
                        </div>
                    </div>
                </section>




                <h2>의류개수 및 그레이딩</h2>
                <section>
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <form name="contentForm"  role="form" data-toggle="validator" novalidate="true">
                                <div class="form schedule-assessment">
                                    <div class="row margin-top-l">
                                            <table class="afternoon-session grading_all" cellspacing="1">
                                                <thead>
                                                    <tr>
                                                        <th scope="row">사이즈</th>
                                                        <th scope="row">그레이딩</th>
                                                        <th scope="row">생산개수</th>
                                                        <th scope="row">봉제</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        <tr>
                                                            <td> 
                                                                <div class="form-group col-md-12 text-center">
                                                                    <select id="size_sel" name="size" class="size_choose">
                                                                        <option selected>사이즈선택</option>
                                                                        <option >XXS</option>
                                                                        <option >XS</option>
                                                                        <option >S</option>
                                                                        <option >M</option>
                                                                        <option >L</option>
                                                                        <option >XL</option>
                                                                        <option >XXL</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <label>
                                                                    <input name="grading" id="gd" class="grading" placeholder="" type="text" >cm
                                                                </label>
                                                            </td> 
                                                            <td>
                                                                <label>
                                                                    <input name="number" id="rnumber" class="production" placeholder="" type="text" >
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <div class="form-group col-md-12 text-center">
                                                                    <select id="sewing" name="size" class="size_choose">
                                                                        <option selected>봉제선택</option>
                                                                        <option>일반</option>
                                                                        <option>해리테이프</option>
                                                                        <option>해리+어깨갈라삼봉</option>
                                                                        <option>해리+전체(고급봉제)</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                        <input class="addsize" type="checkbox" name="digital_brochure" >추가사이즈수량
                                        </label>
                                    </div>
                                    <table class="afternoon-session sizeadd" cellspacing="1">
                                        <thead>
                                            <tr>
                                                <th scope="row">사이즈</th>
                                                <th scope="row">XXS</th>
                                                <th scope="row">XS</th>
                                                <th scope="row">S</th>
                                                <th scope="row">M</th>
                                                <th scope="row">L</th>
                                                <th scope="row">XL</th>
                                                <th scope="row">XXL</th>
                                            </tr>
                                        </thead>
                                        <tbody class="quantity">
                                                <tr>
                                                    <td>수량</td>
                                                    <td>
                                                        <label>
                                                            <input name="XXS" id="rnumber" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="XS" id="rnumber" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="S" id="rnumber" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="M" id="rnumber" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="L" id="rnumber" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="XL" id="rnumber" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="XXL" id="rnumber" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <table class="afternoon-session grading_w" cellspacing="1">
                                        <thead>
                                            <tr>
                                                <th scope="row"></th>
                                                <th scope="row">어깨넓이</th>
                                                <th scope="row">가슴둘레</th>
                                                <th scope="row">허리둘레</th>
                                                <th scope="row">밑단둘레</th>
                                                <th scope="row">암홀직선</th>
                                                <th scope="row">소매기장</th>
                                                <th scope="row">소매통</th>
                                                <th scope="row">소매부리</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                
                                                <tr>
                                                    <td>
                                                        <label class="list">
                                                            기준
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="shoulder" id="shoulder" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="chest" id="chest" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="waist" id="waist" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="curtail" id="curtail" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="armhole" id="armhole" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="sleeve-l" id="sleeve-l" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="sleeve-w" id="sleeve-w" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="sleeve-b" id="sleeve-b" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="list">
                                                            그레이딩
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="shoulder" id="shoulder-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="chest" id="chest-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="waist" id="waist-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="curtail" id="curtail-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="armhole" id="armhole-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="sleeve-l" id="sleeve-l-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="sleeve-w" id="sleeve-w-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="sleeve-b" id="sleeve-b-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <table class="afternoon-session grading_w2" cellspacing="1">
                                        <thead>
                                            <tr>
                                                <th scope="row">총기장</th>
                                                <th scope="row">목깊이</th>
                                                <th scope="row">목너비</th>
                                                <th scope="row">에리높이</th>
                                                <th scope="row" colspan="4" width="56.5%">라벨<span>(최소1000장)</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                
                                                <tr>
                                                    <td>
                                                        <label>
                                                            <input name="length" id="length" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="deepthroat" id="deepthroat" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="neckwidth" id="neckwidth" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="collar" id="collar" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td class="col" colspan="4" rowspan="2">
                                                        <label>
                                                            <input class="cd" type="checkbox" name="digital_brochure" >꼬마<span>(8,000원)</span>
                                                        </label>
                                                        <label>
                                                            <input class="cd" type="checkbox" name="digital_brochure" >케어<span>(10,000원)</span>
                                                        </label>
                                                        <label>
                                                            <input class="cd" type="checkbox" name="digital_brochure" >메인<span>(200,000원)</span>
                                                        </label>
                                                        <label>
                                                            <input class="cd" type="checkbox" name="digital_brochure" >안함
                                                        </label>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>
                                                            <input name="length" id="length-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="deepthroat" id="deepthroat-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="neckwidth" id="neckwidth-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input name="collar" id="collar-2" class="size_w" placeholder="" type="text" >
                                                        </label>
                                                    </td>
                                                    
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>      
                </div>
                </section>


                <h2>원단 및 부자재</h2>
                <section>
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <form name="contentForm"  role="form" data-toggle="validator" novalidate="true">
                                <div class="form schedule-assessment">
                                    <div class="row margin-top-l">
                                        <p>
                                            1.원단<span>(1개선택)</span>
                                        </p>
                                        <table class="afternoon-session fabric choice" cellspacing="1">
                                            <thead>
                                                <tr>
                                                    <th scope="row">원단</th>
                                                    <th scope="row">이미지</th>
                                                    <th scope="row">선택한 원단</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group col-md-12 text-center">
                                                                <select id="size_sel" name="size" class="size_choose">
                                                                    <option selected>원단선택</option>
                                                                    <option>키티버니포니</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                            
                                        <p class="subsidiary">
                                            2.부자재<span>(복수선택가능)</span>
                                        </p>
                                        <table class="afternoon-session subsidiary choice" cellspacing="1">
                                            <thead>
                                                <tr>
                                                    <th scope="row">부자재</th>
                                                    <th scope="row">이미지</th>
                                                    <th scope="row">선택한 부자재</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-group col-md-12 text-center">
                                                            <select id="size_sel" name="size" class="size_choose">
                                                                <option selected>부자재선택</option>
                                                                <option>트윌테이프</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>


                <h2>가공방식</h2>
                <section>
                    <div class="processing_m">
                        <div class="file_load process_g ">
                            <form>
                                <p>
                                    <label for="image">1.가공 이미지 파일 업로드</label>
                                    <br />
                                    <input type="file" name="image" id="image" class="file_img"/>
                                </p>
                            </form>
                            <div id="image_preview" class="img_view">
                                <img src="#" />
                                <br />
                                <a href="#" class="bt_remove">Remove</a>
                            </div>
                            <p class="ex">나염, DTG : 가로 2500px이상 , 배경 투명, 상하좌우없이 꽉 채운 이미지<br>
                                전사, 자수: AI(일러스트)확장된 형식의 이미지</p>
                        </div>
                        <div class="way process_g">
                            <p>2.가공방식</p><br>
                                <div class="form-group col-md-12 text-center">
                                    <select id="processing_s" name="select" class="process_s">
                                        <option selected>가공방식선택</option>
                                        <option>나염</option>
                                        <option>전사</option>
                                        <option>자수</option>
                                        <option>DTG</option>
                                    </select>
                                </div>
                        </div>
                        <div class="position process_g">
                            <p>3.가공위치</p>
                            <img src="images/thumb_l_81D1779E5BCD43942C9245C62F602064.jpg" alt="가공위치선택">
                            <p>&ast;가공을 원하시는 위치에 체크해주세요</p>
                            <p>&ast;가공을 원하시는 위치가 많은 경우 상담문의를 해주세요</p>
                        </div>
                        <div class="actual_size process_g">
                            <p>4.전체실측사이즈</p>
                            <div class="actual_size">
                                <img src="images/2019070114294200000050283.png" alt="실측사이즈">
                                <div class="label_as">
                                    <label>어깨넓이</label>
                                        <input name="measure" id="actual-w" class="size_w" placeholder="" type="text" >
                                    <label>가슴단면</label>
                                        <input name="measure" id="actual-s" class="size_w" placeholder="" type="text" >
                                    <label>소매길이</label>
                                        <input name="measure" id="actual-l" class="size_w" placeholder="" type="text" >
                                    <label>총장</label>
                                        <input name="measure" id="actual-a" class="size_w" placeholder="" type="text" >
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <h2>납기일 종류</h2>
                <section>
                    <section>
                    <div class="due">
                        <div class="general box">
                            <p>일반</p>
                        </div>
                        <div class="fast box">
                            <p>Fast Fashion 2.0</p>
                        </div>
                        <div class="fast_ex">
                        <img src="images/fast_icon.png" alt="">
                        <p>Fast Fashion 2.0이란?</p>
                        </div>
                    </div>


                </section>

                </section>
                <h2>견적금액 및 납기 예정일 확인</h2>
                <section>
                    <div class="estimate">
                        <table  class="estimate_t">
                            <tr>
                                <td>견적금액 및 납기 예정일 확인</td>
                            </tr>
                            <tr>
                                <td>반팔 10000</td>
                            </tr>
                            <tr>
                                <td>나그랑2000</td>
                            </tr>
                            <tr>
                                <td>최종금액 12000000</td>
                            </tr>
                            <tr>
                                <td>납기예정일 2021년 1월10일</td>
                            </tr>
                        </table>
                    </div>
                </section>
                
            </div>
        </div>

        <?php require_once("footer.php"); ?>
                            
        <script>
            $(document).on('click', '.clothes.box', function() {
                console.log($(this).find('.clothes_value').val());

                var clothesNumber = $(this).find('.clothes_value').val();
                
                $.ajax({
                    url: './hendler/orderHendler.php',
                    type: 'get',
                    data: {
                        'no': clothesNumber,
                        'category': 'detail'
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        $.each(data, function(key, item) {
                            $('#type_detail').append(
                                "<div class='detail box'>" +
                                    "<img src='img/clothesDetailImg.php?no=" + item['clothes_detail_number'] + "'>" +
                                    "<p>" + item['clothes_detail_name'] + "</p>" +
                                "</div>"
                            );
                        });
                    }
                });

                $.ajax({
                    url: './hendler/orderHendler.php',
                    type: 'get',
                    data: {
                        'no': clothesNumber,
                        'category': 'fit'
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        $.each(data, function(key, item) {
                            $('#fit').prepend(
                                "<div class='fit box'>" +
                                    "<img src='img/fitImg.php?no=" + item['fit_number'] + "'>" +
                                    "<p>" + item['fit_name'] + "</p>" +
                                "</div>"
                            );
                        });
                    }
                });
            }); 
        </script>
    </body>
</html>