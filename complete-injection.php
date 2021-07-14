<?php 
    require_once('./dbConnect/hollerOrder.php');
    $model = new hollerOrder();

    $category = $model->getsCategory();
    $clothes = $model->getsClothes();
    $material = $model->getsTypeSelect('material'); 
    $subsidiary = $model->getsTypeSelect('subsidiary');
    $order = $model->getOrder($_GET['no']);
    // echo var_dump($order);
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
<link href="css/client_update.css" rel="stylesheet" type="text/css">
<link href="images/mad_icon.ico" rel="shortcut icon" type="image/x-icon">
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script src="js/jquery.steps.js"></script>
<script type="text/javascript" src="js/respond.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="js/complete-injection.js"></script>
<script type="text/javascript" src="js/fabric.js"></script>
<script type="text/javascript" src="js/imgCanvas.js"></script>
</head>

<body>
    <?php require_once("header.php"); ?>
    <input id="order_number" type="hidden" value="<?php echo $order['order_number']?>">
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
            <h1 class="main-title">의뢰자 종류 및 의뢰방식</h1>
            <!-- <button style="color : black" onclick="onPrevious()">뒤</button> -->

        <div id="wizard" class="bundle">
            <h2>의뢰자 종류 및 의뢰방식</h2>
            <section>
                <div class="client-k">
                    <p class="sub-title sub-title-error">1.의뢰자 종류&nbsp;<span>(의뢰자종류를 선택해주세요)</span></p>
                    <div class="kind">
                        <input id="kind" type="hidden" value="<?php echo $order['order_sortation'] ?>">
                        <div class="box sortation_box" data-value="false" data-insert="개인">
                            <img src="images/individual.png"  alt="개인" >
                            <p>개인</p>
                        </div>
                        <div class="box sortation_box" data-value="false" data-insert="법인">
                            <img src="images/company.png" alt="기업">
                            <p>기업</p>
                        </div> 
                    </div>
                    <p class="sub-title sub-title-error">2.의뢰방식&nbsp;<span>(의뢰방식을 선택해주세요)</span></p>
                <div class="means">
                    <input id="order_process" type="hidden" value="<?php echo $order['order_process'] ?>">
                    <div id="im_processing" class="box prosses_box" data-value="false" data-insert="임가공">
                        <span data-tooltip-text=
                        "
                        본사에서 일부만 원단, 부자재, 생산">
                        <img src="images/process.png" alt="임가공">
                        <p>임가공</p>
                        <input id="im_processing_check" type="hidden" data-value="false">
                        </span>
                    </div>
                    <div id="complete_injection" class="box prosses_box" data-value="false" data-insert="완사입">
                        <span data-tooltip-text=
                        "
                        귀사에서 디자인만 제공
                        본사에서 원단, 부자재, 생산">
                        <img src="images/full.png" alt="완사입">
                        <p>완사입</p>
                        
                        </span>
                    </div>
                    <div id="manufacturing" class="box prosses_box" data-value="false" data-insert="가공의뢰">
                        <img src="images/request.png" alt="가공의뢰">
                        <p>가공의뢰</p>
                        <input id="manufacturing_check" type="hidden" data-value="false">
                    </div>
                </div>
                </div>
            </section>

            <h2>의류카테고리</h2>
            <section>
                <p class="sub-title-error"><span>카테고리를 선택해주세요</span></p>
                <div class="category">
                    <input id="category_num" type="hidden" value="<?php echo $order['order_category_number'] ?>">
                    <?php foreach($category as $row) { ?>
                        <div class="box category_box" data-value="false" data-insert="<?php echo $row['category_number'] ?>">
                            <img src="img/categoryImg.php?no=<?php echo $row['category_number'] ?>" alt="남성">
                            <p><?php echo $row['category_name'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </section>

            <h2>의류종류</h2>
            <section>
                <p class="type_detail_p sub-title-error">1.의류종류&nbsp;<span>(카테고리를 선택해주세요)</span></p>
                <div class="type">
                    <input id="clothes_num" type="hidden" value="<?php echo $order['order_clothes_number'] ?>">
                    <?php foreach($clothes as $row) { ?>
                        <div class="box clothes_box" data-value="false" data-insert="<?php echo $row['clothes_number'] ?>">
                            <input type="hidden" class="clothes_value" name="clothes_value" value="<?php echo $row['clothes_number'] ?>">
                            <input type="hidden" class="clothes_material" value="<?php echo $row['clothes_material'] ?>">
                            <img src="img/clothesImg.php?no=<?php echo $row['clothes_number'] ?>" alt="남성">
                            <p><?php echo $row['clothes_name'] ?></p>
                        </div>
                    <?php } ?>
                </div>
                <p class="type_detail_p1 sub-title-error">2.의류세부항목&nbsp;<span>(세부항목을 선택해주세요)</span></p>
                <input id="clothes_detail_num" type="hidden" value="<?php echo $order['order_clothes_detail'] ?>">
                <div id="type_detail" class="type_detail">
                    
                </div>
            </section>


            <h2>의류핏</h2>
            <section>
                <p class="sub-title-error sub-title-error1"><span>의류핏을 선택해주세요</span></p>
                <div id="fit" class="fit">
                    <input id="fit_num" type="hidden" value="<?php echo $order['order_fit_number'] ?>">
                    <div id="fit_value">
                    </div>
                    <div class="typo">
                        <p>원하는 핏이 없나요?</p>
                        <a href="#"><p>&lt;&lt; 상담페이지로 바로가기 &gt;&gt;</p></a>
                    </div>
                </div>
            </section>


            <h2>의류개수 및 원단</h2>
            <section>
                <div class="row chart">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <form name="contentForm"  role="form" data-toggle="validator" novalidate="true">
                            <div class="form schedule-assessment">
                                <div class="row margin-top-l">
                                    <?php 
                                        $materiaNumbers = explode('.', $order['order_material_number']);
                                        array_pop($materiaNumbers);
                                        $materialLength = count($materiaNumbers);

                                        foreach($materiaNumbers as $materialNumber) { 
                                            $materialData = $model->getMaterial($materialNumber);
                                            echo "<input class='material_value' type='hidden' value='{$materialData['material_type']}' data-name='{$materialData['material_name']}'>";
                                        }

                                        foreach($materiaNumbers as $materialNumber) {
                                            echo "<input class='material_confirm_value' type='hidden' value='{$materialNumber}'>";
                                        }
                                    ?>
                                    <input id="material_length" type="hidden" value="<?php echo $materialLength ?>">
                                    <p id="material_p" class="sub-title">
                                        1.원단<span>(1개선택)</span>
                                    </p>
                                    <p id="material_add" onClick="javascript:addMaterial();" class="sub-title-2">
                                        <img src="images/plus.png">추가하기
                                    </p>
                                    <div id="prosses5">
                                        <table id="material_table" class="afternoon-session fabric choice material_table" cellspacing="1">
                                            <thead>
                                                <tr>
                                                    <th scope="row">타입</th>
                                                    <th scope="row">색상</th>
                                                    <th scope="row">선택한 원단</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group col-md-12 text-center">
                                                                <select id="material_type_0" name="material_type" class="size_choose material_type" onChange="javascript:getMaterial(this);">
                                                                    <option selected>재질선택</option>
                                                                    <?php foreach($material as $row) { ?>
                                                                        <option value="<?php echo $row['type_value'] ?>"><?php echo $row['type_name'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="material_img">
                                                        </td>
                                                        <td class="confirmation">
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="sub-title">
                                        2.의류개수
                                    </p>
                                    <?php 
                                        $sizeButton = explode('.', $order['order_size_quantity']);
                                        array_pop($sizeButton);                          
                                        foreach($sizeButton as $size) {
                                            $sizeValue = explode(':', $size);
                                            echo "<input class='size_size' type='hidden' value='{$sizeValue[0]}' data-value='{$sizeValue[1]}'>";
                                        }
                                    ?>
                                    <input id="sewing_value" type="hidden" value="<?php echo $order['order_sewing'] ?>">

                                    <table class="afternoon-session grading_all" cellspacing="1">
                                            <thead>
                                                <tr>
                                                    <th scope="row">사이즈</th>
                                                    <th scope="row">봉제</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <td class="check-size" >
                                                                <label>
                                                                    <input class="check-s size_check" type="checkbox" name="digital_brochure" value="XXS">XXS
                                                                </label>
                                                                <label>
                                                                    <input class="check-s size_check" type="checkbox" name="digital_brochure" value="XS">XS
                                                                </label>
                                                                <label>
                                                                    <input class="check-s size_check" type="checkbox" name="digital_brochure" value="S">S
                                                                </label>
                                                                <label>
                                                                    <input class="check-s size_check" type="checkbox" name="digital_brochure" value="M">M
                                                                </label>
                                                                <label>
                                                                    <input class="check-s size_check" type="checkbox" name="digital_brochure" value="L">L
                                                                </label>
                                                                <label>
                                                                    <input class="check-s size_check" type="checkbox" name="digital_brochure" value="XL">XL
                                                                </label>
                                                                <label>
                                                                    <input class="check-s size_check" type="checkbox" name="digital_brochure" value="XXL">XXL
                                                                </label>
                                                        </td>
                                                        <td>
                                                            <div class="form-group col-md-12 text-center">
                                                                <select id="sewing" name="size" class="size_choose">
                                                                    <option value="" selected>봉제선택</option>
                                                                    <option value="defalut" >일반</option>
                                                                    <option value="tape">해리테이프</option>
                                                                    <option value="hery_shoulder">해리+어깨갈라삼봉</option>
                                                                    <option value="hery_all">해리+전체(고급봉제)</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                    </table>
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
                                                        <input name="XXS" id="XXS" class="size_w size_val" placeholder="" type="text" maxlength="5" disabled readonly>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="XS" id="XS" class="size_w size_val" placeholder="" type="text" maxlength="5" disabled readonly>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="S" id="S" class="size_w size_val" placeholder="" type="text" maxlength="5" disabled readonly>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="M" id="M" class="size_w size_val" placeholder="" type="text" maxlength="5" disabled readonly>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="L" id="L" class="size_w size_val" placeholder="" type="text" maxlength="5" disabled readonly>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="XL" id="XL" class="size_w size_val" placeholder="" type="text" maxlength="5" disabled readonly>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <input name="XXL" id="XXL" class="size_w size_val" placeholder="" type="text" maxlength="5" disabled readonly>
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



            <h2>그레이딩</h2>
            <section>
                <div class="row grad">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <form name="contentForm"  role="form" data-toggle="validator" novalidate="true">
                            <div class="form schedule-assessment">
                                <div id="grading_div" class="row margin-top-l">
                                <p class="grading-ct">&ast;기준사이즈는 M사이즈 입니다</p>
                                    <?php 
                                        $grading_size = explode('.', $order['order_size_grading']);
                                        array_pop($grading_size);

                                        foreach($grading_size as $value) {
                                            $id = explode(':', $value);
                                            echo "<input class='order_grading' type='hidden' value='{$id[0]}' data-value='{$id[1]}'>";
                                        }
                                    ?>
                                    <div class="arrow-all">
                                        <img class="clothes-size" src="images/thumb-1.jpg" alt="실측사이즈">
                                        <img class="arrow arrow0" src="images/line-1.png" alt="">
                                        <img class="arrow arrow1" src="images/line-2.png" alt="">
                                        <img class="arrow arrow2" src="images/line-3.png" alt="">
                                        <img class="arrow arrow3" src="images/line-4.png" alt="">
                                        <img class="arrow arrow4" src="images/line-5.png" alt="">
                                        <img class="arrow arrow5" src="images/line-6.png" alt="">
                                        <img class="arrow arrow6" src="images/line-7.png" alt="">
                                        <img class="arrow arrow7" src="images/line-8.png" alt="">
                                        <img class="arrow arrow8" src="images/line-9.png" alt="">
                                        <img class="arrow arrow9" src="images/line-10.png" alt="">
                                    </div>
                                    <div class="g-bt">
                                        <div class="g-bt2">
                                            <button id="2_per" class="grading" type="button">2%</button><button id="3_per" class="grading" type="button">3%</button><button id="4_per" class="grading" type="button">4%</button><br>
                                            <button id="2_cm" class="grading" type="button">2cm</button><button id="3_cm" class="grading" type="button">3cm</button><button id="4_cm" class="grading" type="button">4cm</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>      
              </div>
            </section>


            <h2>부자재</h2>
            <section>
                <div class="row sub">
                    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                        <form id="subsidiary-label" name="contentForm"  role="form" data-toggle="validator" novalidate="true">
                            <div class="form schedule-assessment">
                                <div class="row  margin-top-l">
                                    <p>
                                        1.라벨<span>(최소1000장)</span>
                                    </p>
                                    <?php 
                                        $label = explode('.', $order['order_label']); 
                                        array_pop($label);

                                        foreach($label as $value) {
                                            echo "<input id='order_{$value}' class='order_label' type='hidden' value='{$value}'>";
                                        }
                                    ?>
                                    <table class="afternoon-session label_s" cellspacing="1">
                                        <thead>
                                            <tr>
                                                <th scope="row">라벨</th>
                                                <th scope="row">선택한 라벨</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td id="mark-label">
                                                            <label>
                                                                <input id="koma" class="check-b check-label" type="checkbox" name="digital_brochure_label" value="koma" data-value="꼬마">꼬마<span>(8,000원)</span>
                                                            </label>
                                                            <label>
                                                                <input id="care" class="check-b check-care check-label" type="checkbox" name="digital_brochure_label" value="care" data-value="케어">케어<span>(10,000원)</span>
                                                            </label>
                                                            <label>
                                                                <input id="main" class="check-b check-main check-label" type="checkbox" name="digital_brochure_label" value="main" data-value="메인">메인<span>(200,000원)</span>
                                                            </label>
                                                            <label>
                                                                <input id="none" class="check-b" type="checkbox" name="digital_brochure_label" value="none">안함
                                                            </label>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <input id="order_main_label" type="hidden" value="<?php echo $order['order_ml_type']; ?>">
                                                <input id="order_care_label" type="hidden" value="<?php echo $order['order_cl_type']; ?>">
                                                <form id="label-form-koma">
                                                    <table id="label-koma" class="afternoon-session blind-main" cellspacing="1">
                                                    <input id="koma_number" class="label_number" type="hidden" value="<?php echo $order['order_kl_number'] ?>" >
                                                        <thead>
                                                            <tr>
                                                                <th scope="row">분류</th>
                                                                <th scope="row">업로드</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr >
                                                                <td>
                                                                    <label>
                                                                        <select id="select_koma" class="label_select" data-id="koma_label_img" data-value="<?php echo $order['order_kl_number'] ?>">
                                                                            <option value="">선택</option>
                                                                        </select>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <img id="koma_label_img" src="">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                                <form id="label-form-main">
                                                    <table id="label-main" class="afternoon-session blind-main" cellspacing="1">
                                                    <input id="main_number" class="label_number" type="hidden" value="<?php echo $order['order_ml_number'] ?>" >
                                                        <thead>
                                                            <tr>
                                                                <th scope="row">분류</th>
                                                                <th scope="row">업로드</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr >
                                                                <td>
                                                                    <label>
                                                                        <input id="ready-made-main" class="check-b label-check-main" type="checkbox" name="label-main" value="aready">기성
                                                                    </label>
                                                                    <label>
                                                                        <input id="made-main" class="check-b label-check-main" type="checkbox" name="label-main" value="made">제작
                                                                    </label>
                                                                </td>
                                                                <td class="label_file" style="display: none">
                                                                    <div class="file_load process_g ">
                                                                        <p>
                                                                            <label for="image" class="s-title">제작 라벨<br> 파일 업로드</label>
                                                                            <br />
                                                                            <input type="file" name="image-main" id="image-main" class="file_img"/>
                                                                        </p>
                                                                        <div id="image_preview" class="img_view">
                                                                            <img src="#" />
                                                                            <br />
                                                                            <a href="#" class="bt_remove">다른 이미지 업로드</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="label_img" style="display: none">
                                                                    <select id="select_main" class="label_select" data-id="main_label_img" disabled data-value="<?php echo $order['order_ml_number'] ?>">
                                                                        <option value="">선택</option>
                                                                    </select>
                                                                    <img id="main_label_img" src="">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                                <form id="label-form-care">
                                                    <table id="label-care" class="afternoon-session blind-main" cellspacing="1">
                                                    <input id="care_number" class="label_number" type="hidden" value="<?php echo $order['order_cl_number'] ?>" >
                                                        <thead>
                                                            <tr>
                                                                <th scope="row">분류</th>
                                                                <th scope="row">업로드</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr >
                                                                <td>
                                                                    <label>
                                                                        <input id="ready-made-care" class="check-b label-check-care" type="checkbox" name="label-care" value="aready">기성
                                                                    </label>
                                                                    <label>
                                                                        <input id="made-care" class="check-b label-check-care" type="checkbox" name="label-care" value="made">제작
                                                                    </label>
                                                                </td>
                                                                <td  class="label_file" style="display: none">
                                                                    <div class="file_load process_g ">
                                                                        <p>
                                                                            <label for="image" class="s-title">제작 라벨<br> 파일 업로드</label>
                                                                            <br />
                                                                            <input type="file" name="image-care" id="image-care" class="file_img"/>
                                                                        </p>
                                                                        <div id="image_preview" class="img_view">
                                                                            <img src="#" />
                                                                            <br />
                                                                            <a href="#" class="bt_remove">다른 이미지 업로드</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="label_img" style="display: none">
                                                                    <select id="select_care" class="label_select" data-id="care_label_img" disabled>
                                                                        <option value="">선택</option>
                                                                    </select>
                                                                    <img id="care_label_img" src="">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                    <p id="subsidiary_add" class="sub-title-2" onClick="javascript:addSubsidiary();">
                                        <img src="images/plus.png">추가하기
                                    </p>    
                                    <p class="sub-p">
                                        2.부자재<span>(복수선택가능)</span>
                                    </p>
                                    <?php 
                                        $subsidiaryNumbers = explode('.', $order['order_subsidiary_number']);
                                        array_pop($subsidiaryNumbers);
                                        $subsidiaryLength = count($subsidiaryNumbers);

                                        foreach($subsidiaryNumbers as $subsidiaryNumber) { 
                                            $subsidiaryData = $model->getSubsidinary($subsidiaryNumber);
                                            echo "<input class='subsidiary_value' type='hidden' value='{$subsidiaryData['subsidiary_type']}' data-name='{$subsidiaryData['subsidiary_name']}' data-number='{$subsidiaryNumber}'>";
                                        }
                                    ?>
                                    <input id="subsidiary_length" type="hidden" value="<?php echo $subsidiaryLength ?>">
                                    <div id="prosses7">                                  
                                        <table id="subsidiary_table" class="afternoon-session subsidiary choice subsidiary_table" cellspacing="1">
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
                                                        <select id="subsidiary_type_0" name="subsidiary" class="subsidiary_choose" onChange="javascript:getSubsidiary(this);">
                                                            <option selected>부자재선택</option>
                                                            <?php foreach($subsidiary as $row) { ?>
                                                                <option value="<?php echo $row['type_value'] ?>"><?php echo $row['type_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td class="subsidiary_img"></td>
                                                    <td class="subsidiary_img_confirm"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>


            <h2>가공방식</h2>
            <section>
                <div class="processing_m">
                    <form id="manufacturing_form">
                        <input id="process_type" type="hidden" value="<?php echo $order['order_process_type'] ?>">
                        <div class="way process_g">
                            <p class="s-title">1.가공방식</p><br>
                                <div class="form-group col-md-12 text-center">
                                    <select id="processing_s" name="processing_type" class="process_s">
                                        <option value='' selected>가공방식선택</option>
                                        <option value="나염">나염</option>
                                        <option value="전사">전사</option>
                                        <option value="자수">자수</option>
                                        <option value="DTG">DTG</option>
                                    </select>
                                </div>
                        </div>

                        <?php 
                            $locationTop = explode('.', $order['order_pd_top']);
                            $locationLeft = explode('.', $order['order_pd_left']);
                            $scaleX = explode('.', $order['order_pd_sx']);
                            $scaleY = explode('.', $order['order_pd_sy']);
                            $angles = explode('.', $order['order_pd_angle']);

                            array_pop($locationTop);
                            array_pop($locationLeft);
                            array_pop($scaleX);
                            array_pop($scaleY);
                            array_pop($angles);

                            foreach($locationTop as $top) {
                                $top = explode(':', $top);
                                echo "<input type='hidden' id='{$top[0]}-location' class='location_top' value='{$top[1]}'>";
                            }

                            foreach($locationLeft as $left) {
                                $left = explode(':', $left);
                                echo "<input type='hidden' id='{$left[0]}-location' class='location_left' value='{$left[1]}'>";
                            }

                            foreach($scaleX as $scale) {
                                $X = explode(':', $scale);
                                echo "<input type='hidden' id='{$X[0]}' class='scale_x' value='{$X[1]}'>";
                            }

                            foreach($scaleY as $scale) {
                                $Y = explode(':', $scale);
                                echo "<input type='hidden' id='{$Y[0]}' class='scale_y' value='{$Y[1]}'>";
                            }

                            foreach($angles as $angle) {
                                $result = explode(':', $angle);
                                echo "<input type='hidden' id='{$result[0]}' class='angle' value='{$result[1]}'>";
                            }
                        ?>
                        
                        <div class="position process_g">
                            <p class="s-title">2.가공면</p>
                            <p class="ex">&ast;가공을 원하시는 위치에 체크해주세요<br>
                        &ast;가공을 원하시는 위치가 많은 경우 상담문의를 해주세요</p>
                            <div id="process-capture" class="process-img">
                                <div id="front" class="img-wrapper">
                                    앞<img id="fornt_img" class="" src="images/thumb-1.jpg" alt="가공면선택">
                                    <div id="front-area">
                                        <canvas id="front-canvas" class="canvas" width="150" height="200"> </canvas>
                                    </div>
                                    <img id="front-canvas-img" class="bkg" src="img/orderImg.php?no=<?php echo $order['order_number']?>&sortation=process&location=front" style="display: none;">
                                    <input type="file" id="front-upload" class="bkg-file" data-id="front-canvas" data-top="front-top-location" data-left="front-left-location" 
                                        data-input-top="front-top" data-input-left="front-left" data-x="front-scaleX" data-y="front-scaleY" data-angle="front-angle"/>
                                    <br>
                                    Top: <input type="text" id="front-top" class="canvas-img-top move" data-id="front-canvas"/>
                                    <br>
                                    Left: <input type="text" id="front-left" class="canvas-img-left move" data-id="front-canvas"/>
                                </div>
                                <br>
                                <div id="back" class="img-wrapper">
                                    뒤<img src="images/thumb-2.jpg" alt="가공면선택">
                                    <div id="back_area">
                                        <canvas id="back-canvas"  class="canvas"width="150" height="200"> </canvas>
                                    </div>
                                    <img id="back-canvas-img" class="bkg" src="img/orderImg.php?no=<?php echo $order['order_number']?>&sortation=process&location=back" style="display: none;">
                                    <input type="file" id="back-upload" class="bkg-file" data-id="back-canvas" data-top="back-top-location" data-left="back-left-location"
                                        data-input-top="back-top" data-input-left="back-left" data-x="back-scaleX" data-y="back-scaleY" data-angle="back-angle"/>
                                    <br>
                                    Top: <input type="text" id="back-top" class="canvas-img-top move" data-id="back-canvas"/>
                                    <br>
                                    Left: <input type="text" id="back-left" class="canvas-img-left move" data-id="back-canvas"/>
                                </div>
                                <br>
                                <div id="left" class="img-wrapper">
                                    좌<img src="images/side_1.jpg" alt="가공면선택">
                                    <div id="left_area">
                                        <canvas id="left-canvas" class="canvas" width="75" height="260"> </canvas>
                                    </div>
                                    <img id="left-canvas-img" class="bkg" src="img/orderImg.php?no=<?php echo $order['order_number']?>&sortation=process&location=left" style="display: none;">
                                    <input type="file" id="left-upload" class="bkg-file" data-id="left-canvas" data-top="left-top-location" data-left="left-left-location"
                                        data-input-top="left-top" data-input-left="left-left" data-x="left-scaleX" data-y="left-scaleY" data-angle="left-angle"/>
                                    <br>
                                    Top: <input type="text" id="left-top" class="canvas-img-top move" data-id="left-canvas"/>
                                    <br>
                                    Left: <input type="text" id="left-left" class="canvas-img-left move" data-id="left-canvas"/>
                                </div>
                                <br>
                                <div id="right" calss="img-wrapper">
                                    우<img src="images/side_2.jpg" alt="가공면선택">
                                    <div id="right_area">
                                        <canvas id="right-canvas" class="canvas" width="75" height="260"> </canvas>
                                    </div>
                                    <img id="rifht-canvas-img" class="bkg" src="img/orderImg.php?no=<?php echo $order['order_number']?>&sortation=process&location=right" style="display: none;">
                                    <input type="file" id="right-upload" class="bkg-file" data-id="right-canvas" data-top="right-top-location" data-left="right-left-location"
                                        data-input-top="right-top" data-input-left="right-left" data-x="right-scaleX" data-y="right-scaleY" data-angle="right-angle"/>
                                    <br>
                                    Top: <input type="text" id="right-top" class="canvas-img-top move" data-id="right-canvas"/>
                                    <br>
                                    Left: <input type="text" id="right-left" class="canvas-img-left move" data-id="right-canvas"/>
                                </div>
                                <br>
                            </div>
                        </div>

                        <?php
                            $location = explode('.', $order['order_detail_location']);
                            array_pop($location);

                            foreach($location as $detail) {
                                $value = explode(':', $detail);
                                echo "<input class='order_detail_location' type='hidden' value='{$value[1]}' data-id='{$value[0]}'>";
                            }
                        ?>
                        <div class="actual_size process_g">
                            <p class="s-title">4.상세가공위치</p>
                            <div class="actual_size">
                                <div class="label_as">
                                    <label>앞</label>
                                        <textarea id="front_detail" name="front_detatil" class="size_w detail-location" placeholder=""></textarea>
                                    <label>뒤</label>
                                        <textarea id="back_detail" name="back_detail" class="size_w detail-location" placeholder=""></textarea>
                                    <label>좌</label>
                                        <textarea id="left_detail" name="left_detail" class="size_w detail-location" placeholder=""></textarea>
                                    <label>우</label>
                                        <textarea id="right_detail" name="right_detail" class="size_w detail-location" placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <h2>납기일 종류</h2>
            <section>
                <input id="delivery" type="hidden" value="<?php echo $order['order_delivery'] ?>">
                <div class="due">
                    <div class="box delivery_box" data-value="false" data-insert="일반">
                        <p>일반</p>
                    </div>
                    <div class="box delivery_box" data-value="false" data-insert="특급">
                        <p>Fast Fashion 2.0</p>
                    </div>
                    <div class="fast_ex">
                    <img src="images/fast_icon.png" alt="">
                    <p>Fast Fashion 2.0이란?</p>
                    </div>
                </div>
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
                            <td id="today_date"></td>
                        </tr>
                    </table>

                    <!-- 개인사업자 세금계산서
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
                    </div> -->
                </section>
         </div>
    </div>

    <?php require_once("footer.php"); ?>

    <script>
        /**
         * @brief   수정 자료 표시
         * @author  김정근
         * @date    2021-02-09
         */
        $(function() {
            var box = {
                '#kind': '.sortation_box',
                '#order_process': '.prosses_box',
                '#category_num': '.category_box',
                '#clothes_num': '.clothes_box'
            }

            $.each(box, function(key, item) {
                $(item).each(function() {
                    if($(this).data('insert') == $(key).val()) {
                        $(this).trigger("click");
                    }
                });
            });

            for(i=0; i<$('#material_length').val() - 1; i++) {
                $('#material_add').trigger('click');
            }

            $('.material_value').each(function() {
                var index = $(this).index();
                var name = $(this).data('name');
                $('.material_type').eq(index).val($(this).val());
                $('.material_type').eq(index).trigger('change');
            });


            $('.size_size').each(function() {
                var check = $(this).val();
                var size = $(this).data('value');
                $('.size_check').each(function() {
                    if($(this).val() == check) {
                        $(this).prop('checked', true);
                    }
                });

                $('#' + check).val(size);
            });

            if($('#sewing_value').val() != undefined) {
                $('#sewing').val($('#sewing_value').val());
                $('#sewing').trigger('change');
            }

            $('.order_label').each(function() {
                var value = $(this).val();
                $('#' + value).trigger('click');
            });

            if($('#main').prop('checked')) {
                var no = $('#order_number').val();
                var label = $('#order_main_label').val(); 

                if(label == 'made') {
                    $('#made-main').trigger('click');
                    $('#made-main').prop('checked', true);
                } else if(label == 'aready') {
                    $('#ready-made-main').trigger('click')
                    $('#ready-made-main').prop('checked', true);
                }

                $('.img_view img').eq(0).attr('src', "./img/orderImg.php?no=" + no + "&sortation=main");
                $('.img_view').eq(0).slideDown(); //업로드한 이미지 미리보기 
                $('.file_img').eq(0).slideUp(); //파일 양식 감춤
            }

            if($('#care').prop('checked')) {
                var no = $('#order_number').val();
                var label = $('#order_care_label').val(); 

                if(label == 'made') {
                    $('#made-care').trigger('click');
                    $('#made-care').prop('checked', true);
                } else if(label == 'aready') {
                    $('#ready-made-care').trigger('click')
                    $('#ready-made-care').prop('checked', true);
                }

                $('.img_view img').eq(1).attr('src', "./img/orderImg.php?no=" + no + "&sortation=care");
                $('.img_view').eq(1).slideDown(); //업로드한 이미지 미리보기 
                $('.file_img').eq(1).slideUp(); //파일 양식 감춤
            }

            for(i=0; i<$('#subsidiary_length').val() - 1; i++) {
                $('#subsidiary_add').trigger('click');
            }

            $('.subsidiary_value').each(function() {
                var index = $('.subsidiary_value').index(this);
                
                $('#subsidiary_type_' + index).val($(this).val());
                $('#subsidiary_type_' + index).trigger('change');
            });

            if($('#process_type').val() != undefined) {
                $('#processing_s').val($('#process_type').val());
            }

            if($('#order_process_img').val() !=undefined) {
                var no = $('#order_number').val();

                $('.img_view img').eq(2).attr('src', "./img/orderImg.php?no=" + no + "&sortation=process");
                $('.img_view').eq(2).slideDown(); //업로드한 이미지 미리보기 
                $('.file_img').eq(2).slideUp(); //파일 양식 감춤
            }

            $('.order_detail_location').each(function() {
                $('#' + $(this).data('id')).val($(this).val());
            });

            $('.delivery_box').each(function() {
                if($(this).data('insert') == $('#delivery').val()) {
                    $(this).trigger('click')
                }
            });

            $('.label_select').trigger('change'); 
        });
        
        /**
         * @brief   카테고리, 핏 조회
         * @author  김정근
         * @date    2020-10
         */
        $(document).on('click', '.box.clothes_box', function() {
            var clothesNumber = $(this).find('.clothes_value').val();
            
            $.ajax({
                url: './hendler/orderHendler.php',
                type: 'get',
                data: {
                    'no': clothesNumber,
                    'category': 'detail'
                },
                success: function(result) {
                    $("#type_detail").html("");
                    var data = JSON.parse(result);
                    $.each(data, function(key, item) {
                        $('#type_detail').append(
                            "<div class='box detail_box' data-value='false' data-insert='" + item['clothes_detail_number'] + "'>" +
                                "<img src='img/clothesDetailImg.php?no=" + item['clothes_detail_number'] + "'>" +
                                "<p>" + item['clothes_detail_name'] + "</p>" +
                            "</div>"
                        );
                        
                        if($('#clothes_detail_num').val() == item['clothes_detail_number']) {
                            $('.detail_box').eq(key).trigger('click');
                        }
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
                    $('.fit_box').remove();
                    var data = JSON.parse(result);
                    $.each(data, function(key, item) {
                        $('#fit').prepend(
                            "<div class='box fit_box' data-value='false' data-insert='" + item['fit_number'] + "'>" +
                                "<input type='hidden' class='fit_value' name='fit_value' value='" + item['fit_number'] + "'>" +
                                "<img src='img/fitImg.php?no=" + item['fit_number'] + "'>" +
                                "<p>" + item['fit_name'] + "</p>" +
                            "</div>"
                        );
                    });

                    $('.fit_box').each(function() {
                        if($('#fit_num').val() == $(this).data('insert')) {
                            $(this).trigger('click');
                        }
                    });
                }
            });

            var clothesMaterial = $(this).find('.clothes_material').val();

            if(clothesMaterial != 'multi') {
                $('#material_add').hide();
            } else {
                $('#material_add').show();
            }
        }); 


        /**
         * @brief   사이즈 조회
         * @author  김정근 
         * @date    2020-12-10
         */
        $(document).on('click', '.box.fit_box', function() {
            var fitNumber = $(this).find('.fit_value').val();
            
            $.ajax({
                url: './hendler/orderHendler.php',
                type: 'get',
                data: {
                    'no': fitNumber,
                    'category': 'size'
                },
                success: function(result) {
                    var data = JSON.parse(result);
                    var sizeList = {};

                    $.each(data, function(key, item) {
                        // $('#' + key).val(item);
                        if(item == null || key == 'size_create' || key == 'size_update') {
                            delete data[key];
                        } else {
                            switch(key) {
                                case 'size_shoulder_width': sizeList[key] = '어깨넓이';
                                    break;
                                case 'size_chest': sizeList[key] = '가슴둘레';
                                    break;
                                case 'size_bottom_width': sizeList[key] = '하단넓이';
                                    break;
                                case 'size_total_length': sizeList[key] = '총장';
                                    break;
                                case 'size_neck_hole': sizeList[key] = '낵홀';
                                    break;
                                case 'size_arm_hole': sizeList[key] = '암홀';
                                    break;
                                case 'size_sleeve_length': sizeList[key] = '소매길이';
                                    break;
                                case 'size_sleeve_width': sizeList[key] = '소내넓이';
                                    break;
                                case 'size_shibori': sizeList[key] = '시보리';
                                    break;
                                case 'size_neck_depth': sizeList[key] = '목 깊이';
                                    break;
                                default: insertData['size_number'] = item; delete data[key];
                                    break;
                            }
                        }
                    });

                    var tableLength = 1;
                    var rowLength = 0;
                    $(".afternoon-session.grading_w").remove();
                    $("#select_fit").remove();

                    $.each(data, function(key, item) {
                        if(rowLength == 0) {
                            $("#grading_div").append(
                                "<table class='afternoon-session grading_w grading_index" + tableLength + "' cellspacing='1'>" +
                                    "<thead>" +
                                        "<tr><th scope='row'></th></tr>" +
                                    "</thead>" +
                                    "<tbody>" +
                                        "<tr class='before'>" +
                                            "<td><lable class='list'>기준<span>그레이딩</span></lable></td>" +
                                        "</tr>" +
                                    "</tbody>" +
                                "</table>"
                            );
                            tableLength++;
                        }

                        var tableName = ".grading_index" + (tableLength - 1);

                        $(tableName + " thead tr").append("<th scope='row'>" + sizeList[key] + "</th>");
                        $(tableName + " tbody tr.before").append(
                            "<td>" +
                                "<lable>" +
                                    "<input id='" + key + "' class='size_w size_value' placeholder='' type='text'>" +
                                    "<span><input  name='" + key + "_mobile' id='" + key + "_mobile' class='size_w size_value mobile' placeholder='' type='text'></span>" +
                                "</lable>" +
                            "</td>"
                        );

                        rowLength = (rowLength < 5) ? ++rowLength : 0;

                        $('#' + key).val(item);
                    });
                    $(".g-bt2").append("<input type='hidden' id='select_fit' value='" + fitNumber + "'>");
                }
            });
        });


        /**
         * @brief   원단 목록 조회
         * @author  김정근 
         * @date    2020-12-09
         */
        function getMaterial(e) {
            console.log($(e).attr("id"));
            var selectId = $(e).attr("id");
            var splitArray = selectId.split('_');
            var index = splitArray[2];

            $.ajax({
                url: './hendler/orderHendler.php',
                type: 'get',
                data:{
                    'type': $('#' + selectId + ' option:selected').val(),
                    'category': 'material'
                },
                success: function(result) {
                    $('.material_img').eq(index).html("");
                    $('.confirmation').eq(index).html("");
                    var data = JSON.parse(result);
                    $.each(data, function(key, item) {
                        $('.material_img').eq(index).append("<img class='img " + item['material_name'] + "_" + index + "'src='img/materialImg.php?no=" + item['material_number'] + "'>");

                        var name = $('.material_value').eq(index).data('name');
                        if($('.' + name + '_' + index) == $('.' + item['material_name'] + "_" + index)){
                            $('.' + name + '_' + index).trigger('click');
                        }

                        if($('.material_confirm_value').eq(index).val() != undefined) {
                            $('.confirmation').eq(index).html("<img class='confirm_img' src='img/materialDetailImg.php?no=" + $('.material_confirm_value').eq(index).val() + "'>");
                            insertData['material'][index] = Number($('.material_confirm_value').eq(index).val());
                        }
                    });
                }
            });
        }


        /** 
         * @brief   부자재 목록 조회
         * @author  김정근 
         * @date    2020-12-21
         */
        function getSubsidiary(e) {
            console.log($(e).attr("id"));
            var selectId = $(e).attr("id");
            var splitArray = selectId.split('_');
            var index = splitArray[2];
            var clothesNumber = insertData['clothes_box'];

            $.ajax({
                url: './hendler/orderHendler.php',
                type: 'get',
                data:{
                    type: $('#' + selectId + ' option:selected').val(),
                    clothes: clothesNumber,
                    category: 'subsidiary'
                },
                success: function(result) {
                    $('.subsidiary_img').eq(index).html("");
                    $('.subsidiary_img_confirm').eq(index).html("");
                    var data = JSON.parse(result);
                    $.each(data, function(key, item) {
                        $('.subsidiary_img').eq(index).append("<img class='img_sub " + index + "_" + item['subsidiary_number'] + "'src='img/subsidiaryImg.php?no=" + item['subsidiary_number'] + "' style='width:25px;'>");

                        if($('.subsidiary_value').eq(index).data('number') != undefined) {
                            $('.subsidiary_img_confirm').eq(index).html("<img class='confirm_img_sub' src='img/subsidiaryImg.php?no=" + $('.subsidiary_value').eq(index).data('number') + "'style='width:25px;'>");
                            insertData['subsidiary'][index] = Number($('.subsidiary_value').eq(index).data('number'));
                        }
                    });
                }
            });
        }

        /**
         * @brief   부자재 조회
         * @author  김정근 
         * @date    2020-12-23
         */
        $(document).on('click', '.img_sub', function() {
            var clickImg = $(this).attr('class');
            var splitArray = clickImg.split(' ');
            splitArray = splitArray[1].split('_');
            var index = splitArray[0];
            var no = splitArray[1];

            $('.subsidiary_img_confirm').eq(index).html("<img class='confirm_img_sub' src='img/subsidiaryImg.php?no=" + no + "'style='width:25px;'>");
            insertData['subsidiary'][index] = Number(no);
        });

        /**
         * @brief   확정 원단 조회
         * @author  김정근 
         * @date    2020-12-09
         */
        $(document).on('click', '.img', function() {
            var clickImg = $(this).attr('class');
            var splitArray = clickImg.split(' ');
            splitArray = splitArray[1].split('_');
            var imgName = splitArray[0];
            var index = splitArray[1];

            $.ajax({
                url: './hendler/orderHendler.php',
                type: 'get',
                data: {
                    'materialName': imgName,
                    'category': 'materialDetail'
                },
                success: function(result){
                    result = JSON.parse(result);
                    $('.confirmation').eq(index).html("<img class='confirm_img' src='img/materialDetailImg.php?no=" + result['material_number'] + "'>");
                    insertData['material'][index] = Number(result['material_number']);
                }
            });
        });


        /**
         * @brief   원단 테이블 복제
         * @author  김정근 
         * @date    2020-12-15
         */
        function addMaterial() {
            if($("table.material_table").length > 2) {
                return false;
            }
            var index = $("table.material_table").length - 1;

            var clone = $('#material_table').clone(true);
            clone.find("#material_type_0").attr("id", "material_type_" + (index + 1));
            $("#prosses5").append(clone);

            $(".material_table").eq(Number(index + 1)).before("<p class='material_del sub-title-2'><img src='images/minus.png'>삭제하기</p>");
            Initialization(index + 1);
        }


        /**
         * @brief   원단 테이블 삭제
         * @author  김정근 
         * @date    2020-12-17
         */
        $(document).on('click', '.material_del', function() {

            $(this).next().remove();
            $(this).remove();

            $('table.material_table').eq(1).find('.material_type').attr('id', 'material_type_1');
            
        });

        /**
         * @brief   부자재 테이블 복제
         * @author  김정근 
         * @date    2020-12-21
         */
        function addSubsidiary() {
            if($("table.subsidiary_table").length > 2) {
                return false;
            }
            var index = $("table.subsidiary_table").length - 1;

            var clone = $('#subsidiary_table').clone(true);
            clone.find("#subsidiary_type_0").attr("id", "subsidiary_type_" + (index + 1));
            $("#prosses7").append(clone);

            $(".subsidiary_table").eq(Number(index + 1)).before("<p class='subsidiary_del sub-title-2'><img src='images/minus.png'>삭제하기</p>");
            InitializationSub(index + 1);
        }

        /**
         * @brief   부자재 테이블 삭제
         * @author  김정근 
         * @date    2021-01-20
         */
        $(document).on('click', '.subsidiary_del', function() {

            $(this).next().remove();
            $(this).remove();

            $('table.subsidiary_table').eq(1).find('.subsidiary_choose').attr('id', 'subsidiary_type_1');

        });


        /**
         * @brief   복제 원단 테이블 초기화
         * @author  김정근 
         * @date    2020-12-15
         */
        function Initialization(index) {
            $('.material_img').eq(index).html('');
            $('.confirmation').eq(index).html('');
        }

        /**
         * @brief   복제 부자재 테이블 초기화
         * @author  김정근 
         * @date    2020-12-23
         */
        function InitializationSub(index) {
            $('.subsidiary_img').eq(index).html('');
            $('.subsidiary_img_confirm').eq(index).html('');
        }

        /**
         * @brief   그레이딩 
         * @author  김정근 
         * @date    2020-12-23
         */
        $(document).on("click", ".grading", function() {
            var splitArray = $(this).attr("id").split("_");
            var num = splitArray[0];
            var formula = splitArray[1];
            var index = 0;
            var sizeValueArray = [];
            var defaultSize = $('.input_size_value').parents('.after').data('size');
            defaultSize = sizeChange(defaultSize);

            var sizeValue;
            $('.input_size_value').each(function() {
                sizeValueArray.push($(this).val());
            })

            if(formula == "per") {
                $('.grading_w').each(function(id, item) {
                    $(this).find('.after').each(function() {        
                        sizeValue = defaultSize - sizeChange($(this).data('size'));
                        index = ($(this).parents('.grading_w').index() > 23) ? 6 : 0;

                        $(this).find('input.grading_value').each(function() {
                            if(sizeValue < 0) { //기준사이즈 보다 클때
                                $(this).val( Math.round(sizeValueArray[index] * (100 + (num * (-1 * sizeValue))) / 100) );
                                index++;
                            } else {   //기준 사이즈보다 작을때
                                $(this).val( Math.round(sizeValueArray[index] * (100 - (num * sizeValue)) / 100) );
                                index++;
                            }
                        });
                    });
                });
            } else if(formula == "cm") {
                $('.grading_w').each(function(id, item) {
                    $(this).find('.after').each(function() {    
                        sizeValue = defaultSize - sizeChange($(this).data('size'));
                        index = ($(this).parents('.grading_w').index() > 23) ? 6 : 0;

                        $(this).find('input.grading_value').each(function() {
                            if(sizeValue < 0) { //기준사이즈 보다 클때
                                $(this).val(  Number(sizeValueArray[index]) +  Number((num * (-1 * sizeValue))) );
                                index++;
                            } else {   //기준 사이즈보다 작을때
                                $(this).val( sizeValueArray[index] - Number((num * sizeValue)) );
                                index++;
                            }
                        });
                    });
                });
            }
        });

        function sizeChange(size) {
            var result;
            switch(size) {
                case 'XXS': result = 1;
                    break; 
                    case 'XS': result = 2;
                break; 
                case 'S': result = 3;
                    break; 
                case 'M': result = 4;
                    break; 
                case 'L': result = 5;
                    break; 
                case 'XL': result = 6;
                    break; 
                case 'XXL': result = 7;
                    break; 
                default:
                    break;
            }
            return result;
        }

        $(document).on('click', '#none', function() {
            if($('#none').prop('checked')) {
                $('.check-label').prop('checked', false);
                $("#label-main").hide();
                $("#label-care").hide();
            }
        });

        

        $(document).on('click', '.size_check', function() {
            $('input:checkbox[name=digital_brochure]').each(function() {
                var sizeId = $(this).val();
                if($(this).prop('checked')) {
                    $("#" + sizeId).attr('readonly', false);
                    $("#" + sizeId).attr('disabled', false);
                } else {
                    $("#" + sizeId).attr('readonly', true);
                    $("#" + sizeId).attr('disabled', true);
                    $("#" + sizeId).val('');
                }
            });
        });

        $(document).ready(function() {
            $('.size_val').keyup(function() {
                $(this).val($(this).val().replace(/[^0-9]/g,''));
            });
        });
    </script>
</body>
</html>

