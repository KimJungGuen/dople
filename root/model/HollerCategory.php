<?php

    /** 
     * @brief   카테고리 관리
     * @author  김정근
     * @date    2020-12-01
     */
    class HollerCategory{

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
         * @brief   카테고리 등록
         * @author  김정근
         * @param   String $categoryName
         * @param   Object $file
         * @return  Boolean
         * @date    2020-12-01
         */
        public function register($categoryName, $file) {
            $pdo = $this->connect();

            $tmpName = $file->tmp_name;
            $fileInfo = fopen($tmpName, 'rb');
            $fileType = $file->type;

            $stmt = $pdo->prepare("INSERT HA_category(category_name, category_img, category_img_type, category_create)
                VALUES(:category_name, :category_img, :category_img_type, CURRENT_TIMESTAMP)");

            $stmt->bindValue(':category_name', $categoryName);
            $stmt->bindValue(':category_img', $fileInfo, PDO::PARAM_LOB);
            $stmt->bindValue(':category_img_type', $fileType);

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
         * @brief   카테고리 수정
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

                $stmt = $pdo->prepare("UPDATE HA_category SET
                    category_name = :category_name,
                    category_img = :category_img,
                    category_img_type = :category_img_type,
                    category_rate = :category_rate,
                    category_update = CURRENT_TIMESTAMP
                    WHERE category_number = :category_number
                ");

                $stmt->bindValue(':category_name', $formData->name);
                $stmt->bindValue(':category_img', $fileInfo, PDO::PARAM_LOB);
                $stmt->bindValue(':category_img_type', $fileType);
                $stmt->bindValue(':category_rate', $formData->rate);
                $stmt->bindValue(':category_number', $formData->no);
            } else {
                $stmt = $pdo->prepare("UPDATE HA_category SET
                    category_name = :category_name,
                    category_rate = :category_rate,
                    category_update = CURRENT_TIMESTAMP
                    WHERE category_number = :category_number
                ");

                $stmt->bindValue(':category_name', $formData->name);
                $stmt->bindValue(':category_rate', $formData->rate);
                $stmt->bindValue(':category_number', $formData->no);
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
         * @brief   카테고리 삭제
         * @author  김정근
         * @param   Int $categoryNumber
         * @return  Boolean
         * @date    2020-12-03
         */
        public function delete($categoryNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_category WHERE category_number = :category_number");

            $stmt->bindValue(':category_number', $categoryNumber);

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
         * @brief   카테고리 목록
         * @author  김정근
         * @return  Array $rows
         * @date    2020-12-02
         */
        public function getsCategory() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT category_number, category_name, category_rate, category_create, category_update FROM HA_category");

            if($stmt->execute()) {
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
    }

?>