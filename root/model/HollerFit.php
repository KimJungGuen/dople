<?php

    /** 
     * @brief   핏 관리
     * @author  김정근
     * @date    2020-12-03
     */
    class HollerFit{
        
        /**
         * @brief   db연결 인자 생성 PDO
         * @author  김정근
         * @return  mysqli
         * @date    2020-11-24
         */
        private function connect() {
            $host = 'localhost';
            $user = 'hollerinc';
            $password = 'hollerdb01!!';
            $dbName = 'hollerinc';
            $dbChar = 'utf8';

            $dsn = "mysql:host={$host};dbname={$dbName};charset={$dbChar}";
            $pdo = new PDO($dsn, $user, $password);

            return $pdo;
        }

        /**
         * @brief   핏 등록
         * @author  김정근
         * @param   Object $formData
         * @param   Object $file
         * @return  Boolean
         * @date    2020-12-01
         */
        public function register($formData, $file) {
            $pdo = $this->connect();

            $tmpName = $file->tmp_name;
            $fileInfo = fopen($tmpName, 'rb');
            $fileType = $file->type;

            $stmt = $pdo->prepare("INSERT HA_fit(fit_name, fit_img, fit_img_type, fit_create, fit_clothes_number)
                VALUES(:fit_name, :fit_img, :fit_img_type, CURRENT_TIMESTAMP, :fit_clothes_number)");

            $stmt->bindValue(':fit_name', $formData->name);
            $stmt->bindValue(':fit_img', $fileInfo, PDO::PARAM_LOB);
            $stmt->bindValue(':fit_img_type', $fileType);
            $stmt->bindValue(':fit_clothes_number', $formData->clothes);

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
         * @brief   핏 수정
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

                $stmt = $pdo->prepare("UPDATE HA_fit SET
                    fit_name = :fit_name,
                    fit_img = :fit_img,
                    fit_img_type = :fit_img_type,
                    fit_rate = :fit_rate,
                    fit_update = CURRENT_TIMESTAMP,
                    fit_clothes_number = :fit_clothes_number
                    WHERE fit_number = :fit_number
                ");

                $stmt->bindValue(':fit_name', $formData->name);
                $stmt->bindValue(':fit_img', $fileInfo, PDO::PARAM_LOB);
                $stmt->bindValue(':fit_img_type', $fileType);
                $stmt->bindValue(':fit_rate', $formData->rate);
                $stmt->bindValue(':fit_clothes_number', $formData->clothes);
                $stmt->bindValue(':fit_number', $formData->no);
            } else {
                $stmt = $pdo->prepare("UPDATE HA_fit SET
                    fit_name = :fit_name,
                    fit_rate = :fit_rate,
                    fit_update = CURRENT_TIMESTAMP,
                    fit_clothes_number = :fit_clothes_number
                    WHERE fit_number = :fit_number
                ");

                $stmt->bindValue(':fit_name', $formData->name);
                $stmt->bindValue(':fit_rate', $formData->rate);
                $stmt->bindValue(':fit_clothes_number', $formData->clothes);
                $stmt->bindValue(':fit_number', $formData->no);
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
         * @param   Int $fitNumber
         * @return  Boolean
         * @date    2020-12-04
         */
        public function delete($fitNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_fit WHERE fit_number = :fit_number");

            $stmt->bindValue(':fit_number', $fitNumber);

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
         * @brief   핏 목록
         * @author  김정근
         * @return  Array $rows
         * @date    2020-12-04
         */
        public function getsFit() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_fit");
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   핏 조회
         * @author  김정근
         * @param   INT $fitNumber
         * @return  Array $rows
         * @date    2020-12-03
         */
        public function getFit($fitNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_fit WHERE fit_number = :fit_number");
            $stmt->bindValue(':fit_number', $fitNumber);
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