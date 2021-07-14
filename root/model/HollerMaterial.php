<?php

    /** 
     * @brief   원단 관리
     * @author  김정근
     * @date    2020-12-04
     */
    class HollerMaterial{

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
         * @brief   원단 등록
         * @author  김정근
         * @param   String $formData
         * @param   Object $file
         * @return  Boolean
         * @date    2020-12-04
         */
        public function register($formData, $file) {
            $pdo = $this->connect();

            $tmpName = $file->tmp_name;
            $fileInfo = fopen($tmpName, 'rb');
            $fileType = $file->type;

            $stmt = $pdo->prepare("INSERT HA_material(material_type, material_sortation, material_name, material_img, material_img_type, material_create)
                VALUES(:material_type, :material_sortation, :material_name, :material_img, :material_img_type, CURRENT_TIMESTAMP)");

            $stmt->bindValue(':material_type', $formData->type);
            $stmt->bindValue(':material_sortation', $formData->sortation);
            $stmt->bindValue(':material_name', $formData->name);
            $stmt->bindValue(':material_img', $fileInfo, PDO::PARAM_LOB);
            $stmt->bindValue(':material_img_type', $fileType);

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
         * @brief   원단 수정
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

                $stmt = $pdo->prepare("UPDATE HA_material SET
                    material_type = :material_type,
                    material_sortation = :material_sortation,
                    material_name = :material_name,
                    material_img = :material_img,
                    material_img_type = :material_img_type,
                    material_rate = :material_rate,
                    material_update = CURRENT_TIMESTAMP
                    WHERE material_number = :material_number
                ");

                $stmt->bindValue(':material_type', $formData->type);
                $stmt->bindValue(':material_sortation', $formData->sortation);
                $stmt->bindValue(':material_name', $formData->name);
                $stmt->bindValue(':material_img', $fileInfo, PDO::PARAM_LOB);
                $stmt->bindValue(':material_img_type', $fileType);
                $stmt->bindValue(':material_rate', $formData->rate);
                $stmt->bindValue(':material_number', $formData->no);
            } else {
                $stmt = $pdo->prepare("UPDATE HA_material SET
                    material_type = :material_type,
                    material_sortation = :material_sortation,
                    material_name = :material_name,
                    material_rate = :material_rate,
                    material_update = CURRENT_TIMESTAMP
                    WHERE material_number = :material_number
                ");

                $stmt->bindValue(':material_type', $formData->type);
                $stmt->bindValue(':material_sortation', $formData->sortation);
                $stmt->bindValue(':material_name', $formData->name);
                $stmt->bindValue(':material_rate', $formData->rate);
                $stmt->bindValue(':material_number', $formData->no);
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
         * @brief   원단 삭제
         * @author  김정근
         * @param   Int $materialNumber
         * @return  Boolean
         * @date    2020-12-04
         */
        public function delete($materialNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_material WHERE material_number = :material_number");

            $stmt->bindValue(':material_number', $materialNumber);

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
         * @brief   원단 목록
         * @author  김정근
         * @return  Array $rows
         * @date    2020-12-04
         */
        public function getsMaterial() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_material");
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
         * @param   INT $materialNumber
         * @return  Array $rows
         * @date    2020-12-04
         */
        public function getMaterial($materialNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_material WHERE material_number = :material_number");
            $stmt->bindValue(':material_number', $materialNumber);
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