<?php

    /** 
     * @brief   라벨 관리
     * @author  김정근
     * @date    2021-03-08
     */
    class HollerLabel{
        
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
         * @brief   라벨 등록
         * @author  김정근
         * @param   Object $formData
         * @param   Object $file
         * @return  Boolean
         * @date    2021-03-08
         */
        public function register($formData, $file) {
            $pdo = $this->connect();

            $tmpName = $file->tmp_name;
            $fileInfo = fopen($tmpName, 'rb');
            $fileType = $file->type;

            $stmt = $pdo->prepare("INSERT 
                HA_label(
                    label_name,
                    label_type,
                    label_img_type,
                    label_img,
                    label_price,
                    label_create
                ) VALUES (
                    :label_name,
                    :label_type,
                    :label_img_type,
                    :label_img,
                    :label_price,
                    CURRENT_TIMESTAMP
                )"
            );

            $stmt->bindValue(':label_name', $formData->name);
            $stmt->bindValue(':label_type', $formData->type);
            $stmt->bindValue(':label_img_type', $fileType);
            $stmt->bindValue(':label_img', $fileInfo, PDO::PARAM_LOB);
            $stmt->bindValue(':label_price', $formData->price);

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
         * @brief   라밸 수정
         * @author  김정근
         * @param   Object $formData
         * @param   Object $file
         * @return  Boolean
         * @date    2021-03-09
         */
        public function update($formData, $file) {
            $pdo = $this->connect();

            $fileQuery = ($file->name != "") ? "label_img_type = :label_img_type, label_img = :label_img," : "";

            $stmt = $pdo->prepare("UPDATE HA_label SET
                label_type = :label_type,
                label_name = :label_name,
                {$fileQuery}
                label_price = :label_price,
                label_rate = :label_rate,
                label_update = CURRENT_TIMESTAMP
                WHERE label_number = :label_number"
            );

            $stmt->bindValue(":label_type", $formData->type);
            $stmt->bindValue(":label_name", $formData->name);
            $stmt->bindValue(":label_price", $formData->price);
            $stmt->bindValue(":label_rate", $formData->rate);
            $stmt->bindValue(":label_number", $formData->no);

            if($file->name != "") {
                $tmpName = $file->tmp_name;
                $fileInfo = fopen($tmpName, 'rb');
                $fileType = $file->type;

                $stmt->bindValue(":label_img_type", $fileType);
                $stmt->bindValue(':label_img', $fileInfo, PDO::PARAM_LOB);
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
         * @brief   라벨 삭제
         * @author  김정근
         * @param   Int $labelNumber
         * @return  Boolean
         * @date    2021-03-09
         */
        public function delete($labelNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_label WHERE label_number = :label_number");

            $stmt->bindValue(":label_number", $labelNumber);

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
         * @brief   라벨 목록
         * @author  김정근
         * @return  Array $rows
         * @date    2021-03-08
         */
        public function getsLabel() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_label");

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
         * @return  Array $rows
         * @date    2021-03-08
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
    }

?>