<?php

    /** 
     * @brief   타입 관리
     * @author  김정근
     * @date    2020-12-15
     */
    class HollerType{

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
         * @brief   타입목록 조회
         * @author  김정근
         * @return  Array $result
         * @date    2020-12-15
         */
        public function getsType() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_type");
            $check = $stmt->execute();

            if($check) {    
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
         * @brief   타입 등록
         * @author  김정근
         * @param   String $formData
         * @return  Boolean
         * @date    2020-12-16
         */
        public function register($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("INSERT HA_type(type_sortation, type_name, type_value, type_create)
                VALUES(:type_sortation, :type_name, :type_value, CURRENT_TIMESTAMP)");

            $stmt->bindValue(':type_sortation', $formData->type);
            $stmt->bindValue(':type_name', $formData->name);
            $stmt->bindValue(':type_value', $formData->value);

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
         * @brief   타입 수정
         * @author  김정근
         * @param   String $formData
         * @return  Boolean
         * @date    2020-12-16
         */
        public function update($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("UPDATE HA_type SET
                type_sortation = :type_sortation,
                type_name = :type_name,
                type_value = :type_value,
                type_update = CURRENT_TIMESTAMP
                WHERE type_number = :type_number"
            );

            $stmt->bindValue(':type_sortation', $formData->type);
            $stmt->bindValue(':type_name', $formData->name);
            $stmt->bindValue(':type_value', $formData->value);
            $stmt->bindValue(':type_number', $formData->no);

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
         * @brief   타입 삭제
         * @author  김정근
         * @param   Int $typeNumber
         * @return  Boolean
         * @date    2020-12-16
         */
        public function delete($typeNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_type WHERE type_number = :type_number");

            $stmt->bindValue(':type_number', $typeNumber);

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
    }
?>