<?php

    /** 
     * @brief   옷종류 상세 관리
     * @author  김정근
     * @date    2020-12-08
     */
    class HollerClothesDetail{
        
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
         * @brief   옷종류 상세 등록
         * @author  김정근
         * @param   Object $formData
         * @param   Object $file
         * @return  Boolean
         * @date    2020-12-08
         */
        public function register($formData, $file) {
            $pdo = $this->connect();

            $tmpName = $file->tmp_name;
            $fileInfo = fopen($tmpName, 'rb');
            $fileType = $file->type;

            $stmt = $pdo->prepare("INSERT HA_clothes_detail(clothes_detail_name, clothes_detail_img, clothes_detail_img_type, clothes_detail_create, clothes_detail_clothes_number)
                VALUES(:clothes_detail_name, :clothes_detail_img, :clothes_detail_img_type, CURRENT_TIMESTAMP, :clothes_detail_clothes_number)");

            $stmt->bindValue(':clothes_detail_name', $formData->name);
            $stmt->bindValue(':clothes_detail_img', $fileInfo, PDO::PARAM_LOB);
            $stmt->bindValue(':clothes_detail_img_type', $fileType);
            $stmt->bindValue(':clothes_detail_clothes_number', $formData->clothes);

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
         * @brief   옷종류 상세 수정
         * @author  김정근
         * @param   Object $formData
         * @param   Object $file
         * @return  Boolean
         * @date    2020-12-08
         */
        public function update($formData, $file) {
            $pdo = $this->connect();

            if($file->name != '') {
                $tmpName = $file->tmp_name;
                $fileInfo = fopen($tmpName, 'rb');
                $fileType = $file->type;

                $stmt = $pdo->prepare("UPDATE HA_clothes_detail SET
                    clothes_detail_name = :clothes_detail_name,
                    clothes_detail_img = :clothes_detail_img,
                    clothes_detail_img_type = :clothes_detail_img_type,
                    clothes_detail_rate = :clothes_detail_rate,
                    clothes_detail_update = CURRENT_TIMESTAMP,
                    clothes_detail_clothes_number = :clothes_detail_clothes_number
                    WHERE clothes_detail_number = :clothes_detail_number
                ");

                $stmt->bindValue(':clothes_detail_name', $formData->name);
                $stmt->bindValue(':clothes_detail_img', $fileInfo, PDO::PARAM_LOB);
                $stmt->bindValue(':clothes_detail_img_type', $fileType);
                $stmt->bindValue(':clothes_detail_rate', $formData->rate);
                $stmt->bindValue(':clothes_detail_clothes_number', $formData->clothes);
                $stmt->bindValue(':clothes_detail_number', $formData->no);
            } else {
                $stmt = $pdo->prepare("UPDATE HA_clothes_detail SET
                    clothes_detail_name = :clothes_detail_name,
                    clothes_detail_rate = :clothes_detail_rate,
                    clothes_detail_update = CURRENT_TIMESTAMP,
                    clothes_detail_clothes_number = :clothes_detail_clothes_number
                    WHERE clothes_detail_number = :clothes_detail_number
                ");

                $stmt->bindValue(':clothes_detail_name', $formData->name);
                $stmt->bindValue(':clothes_detail_rate', $formData->rate);
                $stmt->bindValue(':clothes_detail_clothes_number', $formData->clothes);
                $stmt->bindValue(':clothes_detail_number', $formData->no);
            }

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
         * @brief   옷종류 삭제
         * @author  김정근
         * @param   Int $clothesDetailNumber
         * @return  Boolean
         * @date    2020-12-08
         */
        public function delete($clothesDetailNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_clothes_detail WHERE clothes_detail_number = :clothes_detail_number");

            $stmt->bindValue(':clothes_detail_number', $clothesDetailNumber);

            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }


        /**
         * @brief   옷종류 상세 목록
         * @author  김정근
         * @return  Array $rows
         * @date    2020-12-08
         */
        public function getsClothesDetail() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_clothes_detail");
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   옷종류 상세 조회
         * @author  김정근
         * @param   INT $clothesDetailNumber
         * @return  Array $rows
         * @date    2020-12-08
         */
        public function getClothesDetail($clothesDetailNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_clothes_detail WHERE clothes_detail_number = :clothes_detail_number");
            $stmt->bindValue(':clothes_detail_number', $clothesDetailNumber);
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }
    }

?>