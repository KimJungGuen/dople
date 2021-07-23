<?php

    /** 
     * @brief   부자재 관리
     * @author  김정근
     * @date    2020-12-04
     */
    class HollerSubsidiary{

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
         * @brief   부자재 등록
         * @author  김정근
         * @param   Array $formData
         * @param   Object $file
         * @return  Boolean
         * @date    2020-12-04
         */
        public function register($formData, $file) {
            $pdo = $this->connect();

            $tmpName = $file->tmp_name;
            $fileInfo = fopen($tmpName, 'rb');
            $fileType = $file->type;

            $stmt = $pdo->prepare(
                "INSERT HA_subsidiary(
                    subsidiary_name, 
                    subsidiary_img, 
                    subsidiary_img_type, 
                    subsidiary_type,  
                    subsidiary_clothes_number,
                    subsidiary_create
                )
                VALUES(
                    :subsidiary_name, 
                    :subsidiary_img, 
                    :subsidiary_img_type, 
                    :subsidiary_type, 
                    :subsidiary_clothes_number,
                    CURRENT_TIMESTAMP
                )"
            );

            $stmt->bindValue(':subsidiary_name', $formData->name);
            $stmt->bindValue(':subsidiary_type', $formData->type);
            $stmt->bindValue(':subsidiary_clothes_number', $formData->clothes);
            $stmt->bindValue(':subsidiary_img', $fileInfo, PDO::PARAM_LOB);
            $stmt->bindValue(':subsidiary_img_type', $fileType);

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
         * @brief   부자재 수정
         * @author  김정근
         * @param   Object $formData
         * @param   Object $file
         * @return  Boolean
         * @date    2020-12-04
         */
        public function update($formData, $file) {
            $pdo = $this->connect();

            if($file->name != '') {
                $tmpName = $file->tmp_name;
                $fileInfo = fopen($tmpName, 'rb');
                $fileType = $file->type;

                $stmt = $pdo->prepare("UPDATE HA_subsidiary SET
                    subsidiary_type = :subsidiary_type,
                    subsidiary_clothes_number = :subsidiary_clothes_number,
                    subsidiary_name = :subsidiary_name,
                    subsidiary_img = :subsidiary_img,
                    subsidiary_img_type = :subsidiary_img_type,
                    subsidiary_rate = :subsidiary_rate,
                    subsidiary_update = CURRENT_TIMESTAMP
                    WHERE subsidiary_number = :subsidiary_number
                ");

                $stmt->bindValue(':subsidiary_type', $formData->type);
                $stmt->bindValue(':subsidiary_clothes_number', $formData->clothes);
                $stmt->bindValue(':subsidiary_name', $formData->name);
                $stmt->bindValue(':subsidiary_img', $fileInfo, PDO::PARAM_LOB);
                $stmt->bindValue(':subsidiary_img_type', $fileType);
                $stmt->bindValue(':subsidiary_rate', $formData->rate);
                $stmt->bindValue(':subsidiary_number', $formData->no);
            } else {
                $stmt = $pdo->prepare("UPDATE HA_subsidiary SET
                    subsidiary_name = :subsidiary_name,
                    subsidiary_rate = :subsidiary_rate,
                    subsidiary_update = CURRENT_TIMESTAMP
                    WHERE subsidiary_number = :subsidiary_number
                ");

                $stmt->bindValue(':subsidiary_name', $formData->name);
                $stmt->bindValue(':subsidiary_rate', $formData->rate);
                $stmt->bindValue(':subsidiary_number', $formData->no);
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
         * @brief   부자재 삭제
         * @author  김정근
         * @param   Int $subsidiaryNumber
         * @return  Boolean
         * @date    2020-12-04
         */
        public function delete($subsidiaryNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_subsidiary WHERE subsidiary_number = :subsidiary_number");

            $stmt->bindValue(':subsidiary_number', $subsidiaryNumber);

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
         * @brief   부자재 목록
         * @author  김정근
         * @return  Array $rows
         * @date    2020-12-04
         */
        public function getsSubsidiary() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_subsidiary");
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
         * @param   INT $subsidiaryNumber
         * @return  Array $rows
         * @date    2020-12-04
         */
        public function getSubsidiary($subsidiaryNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_subsidiary WHERE subsidiary_number = :subsidiary_number");
            $stmt->bindValue(':subsidiary_number', $subsidiaryNumber);
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