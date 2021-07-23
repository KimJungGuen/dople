<?php


    /**
     * @brief   생산의뢰 관리
     * @author  김정근
     * @date    2020-12-07
     */
    class hollerOrder{
        /**
         * @brief   db연결 인자 생성 PDO
         * @author  김정근
         * @return  mysqli
         * @date    2020-11-24
         */
        private function connect() {
            $host = '';
            $user = '';
            $password = '';
            $dbName = '';
            $dbChar = '';

            $dsn = "mysql:host={$host};dbname={$dbName};charset={$dbChar}";
            $pdo = new PDO($dsn, $user, $password);

            return $pdo;
        }

        /**
         * @brief   카테고리 목록
         * @author  김정근
         * @return  Array $rows
         * @date    2020-12-02
         */
        public function getsCategory() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_category");
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   카테고리 조회
         * @author  김정근
         * @param   INT $categoryNumber
         * @return  Array $rows
         * @date    2020-12-02
         */
        public function getCategory($categoryNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_category WHERE category_number = :category_number");
            $stmt->bindValue(':category_number', $categoryNumber);
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   옷종류 목록
         * @author  김정근
         * @return  Array $rows
         * @date    2020-12-03
         */
        public function getsClothes() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_clothes");
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   옷종류 조회
         * @author  김정근
         * @param   INT $clothesNumber
         * @return  Array $rows
         * @date    2020-12-03
         */
        public function getClothes($clothesNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_clothes WHERE clothes_number = :clothes_number");
            $stmt->bindValue(':clothes_number', $clothesNumber);
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   옷종류 핏 목록
         * @author  김정근
         * @param   Int $clothesNumber
         * @return  Array $rows
         * @date    2020-12-08
         */
        public function getsFit($clothesNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT fit_number, fit_name FROM HA_fit WHERE fit_clothes_number = :fit_clothes_number");
            $stmt->bindValue(':fit_clothes_number', $clothesNumber);
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   옷종류 핏 조회
         * @author  김정근
         * @param   $fitNumber
         * @return  Array $rows
         * @date    2020-12-08
         */
        public function getFit($fitNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT fit_img, fit_img_type FROM HA_fit WHERE fit_number = :fit_number");
            $stmt->bindValue(':fit_number', $fitNumber);
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   옷상세 목록
         * @author  김정근
         * @param   Int $clothesNumber
         * @return  Array $rows
         * @date    2020-12-08
         */
        public function getsClothesDetail($clothesNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT clothes_detail_number, clothes_detail_name FROM HA_clothes_detail 
                WHERE clothes_detail_clothes_number = :clothes_detail_clothes_number");
            $stmt->bindValue(':clothes_detail_clothes_number', $clothesNumber);
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   옷상세 조회
         * @author  김정근
         * @param   Int $clothesNumber
         * @return  Array $rows
         * @date    2020-12-08
         */
        public function getClothesDetail($clothesNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT clothes_detail_img, clothes_detail_img_type FROM HA_clothes_detail 
                WHERE clothes_detail_number = :clothes_detail_number");
            $stmt->bindValue(':clothes_detail_number', $clothesNumber);
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   원단 목록
         * @author  김정근
         * @param   String $materialType
         * @return  Array $rows
         * @date    2020-12-09
         */
        public function getsMaterial($materialType) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT material_number, material_name FROM HA_material 
                WHERE material_type = :material_type AND material_sortation = :material_sortation");

            $stmt->bindValue(':material_type', $materialType);
            $stmt->bindValue(':material_sortation', 'choice');

            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   원단 조회
         * @author  김정근
         * @param   String $materialNumber
         * @return  Array $rows
         * @date    2020-12-09
         */
        public function getMaterial($materialNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_material 
                WHERE material_number = :material_number");

            $stmt->bindValue(':material_number', $materialNumber);

            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   원단 조회
         * @author  김정근
         * @param   name $name
         * @return  Array $rows
         * @date    2020-12-14
         */
        public function getMaterialConfirmation($name) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT material_number, material_name FROM HA_material 
                WHERE material_name = :material_name
                AND material_sortation = :material_sortation");

            $stmt->bindValue(':material_name', $name);
            $stmt->bindValue(':material_sortation', 'confirmation');

            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }


        /**
         * @brief   사이즈 조회
         * @author  김정근
         * @param   Int $sizeNumber
         * @date    2020-12-10
         */
        public function getSize($sizeNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_size 
                WHERE size_fit_number = :size_fit_number");

            $stmt->bindValue(':size_fit_number', $sizeNumber);

            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   타입 조회
         * @author  김정근
         * @param   String $sortation
         * @date    2020-12-18
         */
        public function getType($sortation) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_type
                WHERE type_sortation = :type_sortation"
            );

            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   부자재 목록 조회
         * @author  김정근
         * @param   Object $formData
         * @date    2020-12-21
         */
        public function getsSubsidinary($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT subsidiary_name, subsidiary_number FROM HA_subsidiary
                WHERE subsidiary_type = :subsidiary_type AND subsidiary_clothes_number = :subsidiary_clothes_number"
            );

            $stmt->bindValue(':subsidiary_type', $formData->type);
            $stmt->bindValue(':subsidiary_clothes_number', $formData->clothes);
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   부자재 조회
         * @author  김정근
         * @param   Int $subsidiaryNo
         * @date    2020-12-21
         */
        public function getSubsidinary($subsidiaryNo) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_subsidiary
                WHERE subsidiary_number = :subsidiary_number"
            );

            $stmt->bindValue(':subsidiary_number', $subsidiaryNo);
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   타입목록 조회
         * @author  김정근
         * @param   String $sortation
         * @return  Array $result
         * @date    2020-12-21
         */
        public function getsTypeSelect($sortation) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_type WHERE type_sortation = :type_sortation ");
            $stmt->bindValue(':type_sortation', $sortation);
            $check = $stmt->execute();

            if($check) {    
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   생산의뢰 등록
         * @author  김정근
         * @param   Object $formData
         * @param   Array $fileInfo
         * @param   Array $fileType
         * @return  Boolean 
         * @date    2020-01-05
         */
        public function insert($formData, $fileInfo, $fileType) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "INSERT HA_order(
                    order_sortation,
                    order_process,
                    order_category_number,
                    order_clothes_number,
                    order_clothes_detail,
                    order_fit_number,
                    order_material_number,
                    order_size_quantity,
                    order_sewing,
                    order_size_grading,
                    order_size_number,
                    order_subsidiary_number,
                    order_label,
                    order_detail_location,
                    order_delivery,
                    order_price,
                    order_ml_type,
                    order_cl_type,
                    order_process_type,
                    order_ml_img_type,
                    order_ml_img,
                    order_cl_img_type,
                    order_cl_img,
                    order_ml_number,
                    order_cl_number,
                    order_kl_number,
                    order_pd_fi_type,
                    order_pd_fi,
                    order_pd_bi_type,
                    order_pd_bi,
                    order_pd_li_type,
                    order_pd_li,
                    order_pd_ri_type,
                    order_pd_ri,
                    order_pd_top,
                    order_pd_left,
                    order_pd_sx,
                    order_pd_sy,
                    order_pd_angle,
                    order_user_number,
                    order_model,
                    order_create
                ) VALUES (
                    :order_sortation,
                    :order_process,
                    :order_category_number,
                    :order_clothes_number,
                    :order_clothes_detail,
                    :order_fit_number,
                    :order_material_number,
                    :order_size_quantity,
                    :order_sewing,
                    :order_size_grading,
                    :order_size_number,
                    :order_subsidiary_number,
                    :order_label,
                    :order_detail_location,
                    :order_delivery,
                    :order_price,
                    :order_ml_type,
                    :order_cl_type,
                    :order_process_type,
                    :order_ml_img_type,
                    :order_ml_img,
                    :order_cl_img_type,
                    :order_cl_img,
                    :order_ml_number,
                    :order_cl_number,
                    :order_kl_number,
                    :order_pd_fi_type,
                    :order_pd_fi,
                    :order_pd_bi_type,
                    :order_pd_bi,
                    :order_pd_li_type,
                    :order_pd_li,
                    :order_pd_ri_type,
                    :order_pd_ri,
                    :order_pd_top,
                    :order_pd_left,
                    :order_pd_sx,
                    :order_pd_sy,
                    :order_pd_angle,
                    :order_user_number,
                    :order_model,
                    CURRENT_TIMESTAMP
                )"
            );

            $stmt->bindValue(':order_sortation', $formData->sortation);
            $stmt->bindValue(':order_process', $formData->process);
            $stmt->bindValue(':order_category_number', $formData->category);
            $stmt->bindValue(':order_clothes_number', $formData->clothes);
            $stmt->bindValue(':order_clothes_detail', $formData->clothesDetail);
            $stmt->bindValue(':order_fit_number', $formData->fit);
            $stmt->bindValue(':order_material_number', $formData->material);
            $stmt->bindValue(':order_size_quantity', $formData->size);
            $stmt->bindValue(':order_sewing', $formData->sewing);
            $stmt->bindValue(':order_size_grading', $formData->grading);
            $stmt->bindValue(':order_size_number', $formData->sizeNumber);
            $stmt->bindValue(':order_subsidiary_number', $formData->subsidiary);
            $stmt->bindValue(':order_label', $formData->label);
            $stmt->bindValue(':order_detail_location', $formData->detailLocation);
            $stmt->bindValue(':order_delivery', $formData->delivery);
            $stmt->bindValue(':order_price', $formData->price ?: 0);
            $stmt->bindValue(':order_ml_type', $formData->labelMainType);
            $stmt->bindValue(':order_cl_type', $formData->labelCareType);
            $stmt->bindValue(':order_ml_number', $formData->labelMainNumber);
            $stmt->bindValue(':order_cl_number', $formData->labelCareNumber);
            $stmt->bindValue(':order_kl_number', $formData->labelKomaNumber);
            $stmt->bindValue(':order_process_type', $formData->manufacturingType);
            $stmt->bindValue(':order_ml_img_type', $fileType->{'image-main'});
            $stmt->bindValue(':order_ml_img', $fileInfo->{'image-main'}, PDO::PARAM_LOB);
            $stmt->bindValue(':order_cl_img_type', $fileType->{'image-care'});
            $stmt->bindValue(':order_cl_img', $fileInfo->{'image-care'}, PDO::PARAM_LOB);
            $stmt->bindValue(':order_pd_fi_type', $fileType->{'front-upload'});
            $stmt->bindValue(':order_pd_fi', $fileInfo->{'front-upload'}, PDO::PARAM_LOB);
            $stmt->bindValue(':order_pd_bi_type', $fileType->{'back-upload'});
            $stmt->bindValue(':order_pd_bi', $fileInfo->{'back-upload'}, PDO::PARAM_LOB);
            $stmt->bindValue(':order_pd_li_type', $fileType->{'left-upload'});
            $stmt->bindValue(':order_pd_li', $fileInfo->{'left-upload'}, PDO::PARAM_LOB);
            $stmt->bindValue(':order_pd_ri_type', $fileType->{'right-upload'});
            $stmt->bindValue(':order_pd_ri', $fileInfo->{'right-upload'}, PDO::PARAM_LOB);
            $stmt->bindValue(':order_pd_top', $formData->top);
            $stmt->bindValue(':order_pd_left', $formData->left);
            $stmt->bindValue(':order_pd_sx', $formData->scaleX);
            $stmt->bindValue(':order_pd_sy', $formData->scaleY);
            $stmt->bindValue(':order_pd_angle', $formData->angle);
            $stmt->bindValue(':order_user_number', $formData->userNumber);
            $stmt->bindValue(':order_model', $formData->fitName);

            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                fclose($fileInfo);
                return true;
            } else {
                $pdo->rollback();
                fclose($fileInfo);
                return false;
            }
        }
        

        /**
         * @brief   생산의뢰 수정
         * @author  김정근
         * @param   Object $formData
         * @param   Array $fileInfo
         * @param   Array $fileType
         * @return  Boolean 
         * @date    2020-02-16
         */
        public function update($formData, $fileInfo, $fileType) {
            $mlImg = ($fileInfo->{'image-main'}) ? "order_ml_img = :order_ml_img, order_ml_img_type = :order_ml_img_type," : "";
            $clImg = ($fileInfo->{'image-care'}) ? "order_cl_img = :order_cl_img, order_cl_img_type = :order_cl_img_type," : "";
            $mlType = ($formData->labelMainType) ? "order_ml_type = :order_ml_type," : "";
            $clType = ($formData->labelCareType) ? "order_cl_type = :order_cl_type," : "";
            $labelType = ($formData->label) ? "order_label = :order_label," : "";
            $pdFront = ($fileInfo->{'front-upload'}) ? "order_pd_fi = :order_pd_fi, order_pd_fi_type = :order_pd_fi_type," : "";
            $pdBack = ($fileInfo->{'back-upload'}) ? "order_pd_bi = :order_pd_bi, order_pd_bi_type = :order_pd_bi_type," : "";
            $pdLeft = ($fileInfo->{'left-upload'}) ? "order_pd_li = :order_pd_li, order_pd_li_type = :order_pd_li_type," : "";
            $pdRight = ($fileInfo->{'right-upload'}) ? "order_pd_ri = :order_pd_ri, order_pd_ri_type = :order_pd_ri_type," : "";
            $grading = ($formData->grading) ? "order_size_grading = :order_size_grading," : "";

            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "UPDATE HA_order SET
                    order_sortation = :order_sortation,
                    order_process = :order_process,
                    order_category_number = :order_category_number,
                    order_clothes_number = :order_clothes_number,
                    order_clothes_detail = :order_clothes_detail,
                    order_fit_number = :order_fit_number,
                    order_material_number = :order_material_number,
                    order_subsidiary_number = :order_subsidiary_number,
                    order_size_quantity = :order_size_quantity,
                    order_sewing = :order_sewing,
                    {$grading}
                    order_size_number = :order_size_number,
                    {$labelType}
                    {$mlType}
                    {$clType}
                    order_process_type = :order_process_type,
                    order_detail_location = :order_detail_location,
                    order_delivery = :order_delivery,
                    order_user_number = :order_user_number,
                    order_model = :order_model,
                    {$mlImg}
                    {$clImg}
                    order_ml_number = :order_ml_number,
                    order_cl_number = :order_cl_number,
                    order_kl_number = :order_kl_number,
                    {$pdFront}
                    {$pdBack}
                    {$pdLeft}
                    {$pdRight}
                    order_pd_top = :order_pd_top,
                    order_pd_left = :order_pd_left,
                    order_pd_sx = :order_pd_sx, 
                    order_pd_sy = :order_pd_sy,
                    order_pd_angle = :order_pd_angle,
                    order_price = :order_price,
                    order_status = :order_status,
                    order_update = CURRENT_TIMESTAMP
                WHERE order_number = :order_number"
            );

            $stmt->bindValue(':order_number', $formData->no);
            $stmt->bindValue(':order_sortation', $formData->sortation);
            $stmt->bindValue(':order_process', $formData->process);
            $stmt->bindValue(':order_category_number', $formData->category);
            $stmt->bindValue(':order_clothes_number', $formData->clothes);
            $stmt->bindValue(':order_clothes_detail', $formData->clothesDetail);
            $stmt->bindValue(':order_fit_number', $formData->fit);
            $stmt->bindValue(':order_material_number', $formData->material);
            $stmt->bindValue(':order_subsidiary_number', $formData->subsidiary);
            $stmt->bindValue(':order_size_quantity', $formData->size);
            $stmt->bindValue(':order_sewing', $formData->sewing);

            if($formData->grading) {
                $stmt->bindValue(':order_size_grading', $formData->grading);
            }

            $stmt->bindValue(':order_size_number', $formData->sizeNumber);

            if($formData->label) {
                $stmt->bindValue(':order_label', $formData->label);
            }

            if($formData->labelMainType) {
                $stmt->bindValue(':order_ml_type', $formData->labelMainType);
            }
            
            if($formData->labelCareType) {
                $stmt->bindValue(':order_cl_type', $formData->labelCareType);
            }
            
            $stmt->bindValue(':order_ml_number', $formData->labelMainNumber);
            $stmt->bindValue(':order_cl_number', $formData->labelCareNumber);
            $stmt->bindValue(':order_kl_number', $formData->labelKomaNumber);
            $stmt->bindValue(':order_process_type', $formData->manufacturingType);
            $stmt->bindValue(':order_detail_location', $formData->detailLocation);
            $stmt->bindValue(':order_delivery', $formData->delivery);
            $stmt->bindValue(':order_model', $formData->fitName);
            $stmt->bindValue(':order_user_number', $formData->userNumber);
            $stmt->bindValue(':order_pd_top', $formData->top);
            $stmt->bindValue(':order_pd_left', $formData->left);
            $stmt->bindValue(':order_pd_sx', $formData->scale_x);
            $stmt->bindValue(':order_pd_sy', $formData->scale_y);
            $stmt->bindValue(':order_pd_angle', $formData->angle);
            $stmt->bindValue(':order_price', $formData->price ?: 0);
            $stmt->bindValue(':order_status', '제작대기중');

            if($fileInfo->{'image-main'}) {
                $stmt->bindValue(':order_ml_img_type', $fileType->{'image-main'});
                $stmt->bindValue(':order_ml_img', $fileInfo->{'image-main'}, PDO::PARAM_LOB);
            }
            if($fileInfo->{'image-care'}) {
                $stmt->bindValue(':order_cl_img_type', $fileType->{'image-care'});
                $stmt->bindValue(':order_cl_img', $fileInfo->{'image-care'}, PDO::PARAM_LOB);
            }
            if($fileInfo->{'front-upload'}) {
                $stmt->bindValue(':order_pd_fi_type', $fileType->{'front-upload'});
                $stmt->bindValue(':order_pd_fi', $fileInfo->{'front-upload'}, PDO::PARAM_LOB);
            }
            if($fileInfo->{'back-upload'}) {
                $stmt->bindValue(':order_pd_bi_type', $fileType->{'back-upload'});
                $stmt->bindValue(':order_pd_bi', $fileInfo->{'back-upload'}, PDO::PARAM_LOB);
            }
            if($fileInfo->{'left-upload'}) {
                $stmt->bindValue(':order_pd_li_type', $fileType->{'left-upload'});
                $stmt->bindValue(':order_pd_li', $fileInfo->{'left-upload'}, PDO::PARAM_LOB);
            }
            if($fileInfo->{'right-upload'}) {
                $stmt->bindValue(':order_pd_ri_type', $fileType->{'right-upload'});
                $stmt->bindValue(':order_pd_ri', $fileInfo->{'right-upload'}, PDO::PARAM_LOB);
            }

            $pdo->beginTransaction();

            if($stmt->execute()) {
                $pdo->commit();
                fclose($fileInfo);
                return true;
            } else {
                $pdo->rollback();
                fclose($fileInfo);
                return false;
            }
        }


        /**
         * @brief   샘플 목록 검색
         * @author  김정근
         * @param   Int $userNumber
         * @param   Object  $formData
         * @return  Array $row
         * @data    2021-01-22
         */
        public function getsOrder($userNumber, $formData) {
            
            $clothesQuery =  ($formData->clothesNumber != null) ? 'AND order_clothes_number = :order_clothes_number' : '';
            $categoryQuery = ($formData->categoryNumber != null) ? 'AND order_category_number = :order_category_number' : '';
            $modelQuery = ($formData->model != null) ? 'AND order_model LIKE :order_model' : '';
            $statusQuery = ($formData->status != null) ? 'AND order_status = :order_status' : '';
            
            $startDay = date("Y-m-d", strtotime($formData->startDay." -1 day"));
            $endDay = date("Y-m-d", strtotime($formData->endDay." +1 day"));

            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "SELECT
                    HA_order.order_number,
                    HA_order.order_process,
                    HA_order.order_model,
                    HA_order.order_status,
                    HA_order.order_create,
                    HA_order.order_consent,
                    HA_category.category_name,
                    HA_clothes.clothes_name
                FROM HA_order
                LEFT OUTER JOIN HA_category ON HA_order.order_category_number = HA_category.category_number
                LEFT OUTER JOIN HA_clothes ON HA_order.order_clothes_number = HA_clothes.clothes_number
                WHERE order_user_number = :order_user_number
                AND order_produce = :order_produce
                AND order_create BETWEEN :startDay AND :endDay
                {$clothesQuery}
                {$categoryQuery}
                {$modelQuery}
                {$statusQuery}"
            );

            $stmt->bindValue(':order_user_number', $userNumber);
            $stmt->bindValue(':startDay', $startDay);
            $stmt->bindValue(':endDay', $endDay);
            $stmt->bindValue(':order_produce', $formData->produce);

            if($formData->clothesNumber != null) {
               $stmt->bindValue(':order_clothes_number', $formData->clothesNumber);
            }
            if($formData->categoryNumber != null) {
                $stmt->bindValue(':order_category_number', $formData->categoryNumber);
            }
            if($formData->model != null) {
                $model = "%{$formData->model}%";
                $stmt->bindValue(':order_model', $model);
            }
            if($formData->status != null) {
                $stmt->bindValue(':order_status', $formData->status);
            }

            if($stmt->execute()) {    
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return $result;
            } else {
                return false;
            }
        }

        /**
         * @biref   상세이미지 조회
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Array $rows
         * @date    2021-02-04
         */
        public function getPD($orderNumber, $img, $type) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "SELECT
                    {$type},
                    {$img}
                FROM HA_order
                WHERE order_number = :order_number"
            );

            $stmt->bindValue(':order_number', $orderNumber);

            if($stmt->execute()) {
                return $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            } else {
                return false;
            }
        }

        /**
         * @brief   샘플 검색
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Array $row
         * @data    2021-02-02
         */
        public function getOrder($orderNumber) {

            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "SELECT
                    order_number,
                    order_sortation,
                    order_process,
                    order_category_number,
                    order_clothes_number,
                    order_clothes_detail,
                    order_fit_number,
                    order_material_number,
                    order_subsidiary_number,
                    order_size_quantity,
                    order_sewing,
                    order_size_grading,
                    order_label,
                    order_ml_type,
                    order_cl_type,
                    order_ml_number,
                    order_cl_number,
                    order_kl_number,
                    order_process_type,
                    order_pd_top,
                    order_pd_left,
                    order_pd_sx,
                    order_pd_sy,
                    order_pd_angle,
                    order_detail_location,
                    order_delivery,
                    order_model,
                    order_status,
                    order_create
                FROM HA_order
                WHERE order_number = :order_number"
            );

            $stmt->bindValue(':order_number', $orderNumber);

            if($stmt->execute()) {    
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                return $result;
            } else {
                return false;
            }
        }

        /**
         * @biref   유저 메인라벨 조회
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Array $rows
         * @date    2021-02-04
         */
        public function getMainLabel($orderNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT order_ml_img_type, order_ml_img FROM HA_order WHERE order_number = :order_number");

            $stmt->bindValue(':order_number', $orderNumber);

            if($stmt->execute()) {
                return $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            } else {
                return false;
            }
        }

        /**
         * @biref   유저 케어라벨 조회
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Array $rows
         * @date    2021-02-04
         */
        public function getCareLabel($orderNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "SELECT
                    order_cl_img_type,
                    order_cl_img
                FROM HA_order
                WHERE order_number = :order_number"
            );

            $stmt->bindValue(':order_number', $orderNumber);

            if($stmt->execute()) {
                return $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            } else {
                return false;
            }
        }

        /**
         * @biref   유저 가공이미지 조회
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Array $rows
         * @date    2021-02-16
         */
        public function getProcessDetail($orderNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT order_process_img_type, order_process_img FROM HA_order WHERE order_number = :order_number");

            $stmt->bindValue(':order_number', $orderNumber);

            if($stmt->execute()) {
                return $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            } else {
                return false;
            }
        }

        /**
         * @brief   샘플 주문 확정
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Boolean
         * @date    2021-01-29
         */
        public function statusUpdate($orderNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "UPDATE HA_order SET
                    order_status = :order_status,
                    order_produce = 1
                WHERE order_number = :order_number"
            );

            $stmt->bindValue(':order_status', '제작대기중');
            $stmt->bindValue(':order_number', $orderNumber);

            $pdo->beginTransaction();
            if($stmt->execute()) {
                $pdo->commit();
                return true;

            } else {
                $pdo->rollback();
                return false;
            }
        }

        /**
         * @brief   해당 타입 라벨 목록
         * @author  김정근
         * @param   String $labelType
         * @return  Array $result
         * @date    2021-03-10
         */
        public function getsLabel($labelType) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT label_number, label_name FROM HA_label WHERE label_type = :label_type");

            $stmt->bindValue(':label_type', $labelType);

            if($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   라벨 이미지 조회
         * @author  김정근
         * @param   Int $labelNumber
         * @return  Array $result
         * @date    2021-03-10
         */
        public function getLabel($labelNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT label_img_type, label_img FROM HA_label WHERE label_number = :label_number");

            $stmt->bindValue(':label_number', $labelNumber);

            if($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }


        public function updateOrderConsent($userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("UPDATE HA_order SET order_consent = :order_consent WHERE order_user_number = :order_user_number");

            $stmt->bindValue('order_consent', 1);
            $stmt->bindValue('order_user_number', $userNumber);

            $pdo->beginTransaction();
            if($stmt->execute()) {
                $pdo->commit();
                return true;

            } else {
                $pdo->rollback();
                return false;
            }
        }
    }


?>