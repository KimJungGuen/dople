<?php

    /** 
     * @brief   옷종류 관리
     * @author  김정근
     * @date    2020-12-03
     */
    class HollerClothes{

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
         * @brief   옷종류 등록
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

            $stmt = $pdo->prepare("INSERT HA_clothes(clothes_name, clothes_img, clothes_img_type, clothes_create, clothes_material)
                VALUES(:clothes_name, :clothes_img, :clothes_img_type, CURRENT_TIMESTAMP, :clothes_material)");

            $stmt->bindValue(':clothes_name', $formData->name);
            $stmt->bindValue(':clothes_material', $formData->material);
            $stmt->bindValue(':clothes_img', $fileInfo, PDO::PARAM_LOB);
            $stmt->bindValue(':clothes_img_type', $fileType);

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
         * @brief   옷종류 수정
         * @author  김정근
         * @param   Object $formData
         * @param   Object $file
         * @return  Boolean
         * @date    2020-12-03
         */
        public function update($formData, $file) {
            $pdo = $this->connect();

            if($file->name != '') {
                $tmpName = $file->tmp_name;
                $fileInfo = fopen($tmpName, 'rb');
                $fileType = $file->type;

                $stmt = $pdo->prepare("UPDATE HA_clothes SET
                    clothes_name = :clothes_name,
                    clothes_img = :clothes_img,
                    clothes_img_type = :clothes_img_type,
                    clothes_material = :clothes_material,
                    clothes_rate = :clothes_rate,
                    clothes_update = CURRENT_TIMESTAMP
                    WHERE clothes_number = :clothes_number
                ");

                $stmt->bindValue(':clothes_name', $formData->name);
                $stmt->bindValue(':clothes_img', $fileInfo, PDO::PARAM_LOB);
                $stmt->bindValue(':clothes_img_type', $fileType);
                $stmt->bindValue(':clothes_material', $formData->material);
                $stmt->bindValue(':clothes_rate', $formData->rate);
                $stmt->bindValue(':clothes_number', $formData->no);
            } else {
                $stmt = $pdo->prepare("UPDATE HA_clothes SET
                    clothes_name = :clothes_name,
                    clothes_material = :clothes_material,
                    clothes_rate = :clothes_rate,
                    clothes_update = CURRENT_TIMESTAMP
                    WHERE clothes_number = :clothes_number
                ");

                $stmt->bindValue(':clothes_name', $formData->name);
                $stmt->bindValue(':clothes_material', $formData->material);
                $stmt->bindValue(':clothes_rate', $formData->rate);
                $stmt->bindValue(':clothes_number', $formData->no);
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
         * @param   Int $clothesNumber
         * @return  Boolean
         * @date    2020-12-03
         */
        public function delete($clothesNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_clothes WHERE clothes_number = :clothes_number");

            $stmt->bindValue(':clothes_number', $clothesNumber);

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

    }
?>