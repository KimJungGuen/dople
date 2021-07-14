<?php

    /**
     * @brief   관리자 관리
     * @author  김정근
     * @date    2020-11-30
     */
    class HollerAdmin{

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
         * @brief   관리자 로그인
         * @author  김정근
         * @param   Object  $formData
         * @return  Object  $row
         * @date    2020-11-30
         */
        public function login($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT admin_number, admin_name FROM HA_admin 
                WHERE admin_id = :admin_id AND admin_pw = :admin_pw");

            $stmt->bindValue(':admin_id', $formData->username);
            $stmt->bindValue(':admin_pw', $formData->password);

            $check = $stmt->execute();

            if($check) {
                $row = (object)$stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return false;
            }
        }

        /**
         * @brief   관리자 등록
         * @author  김정근
         * @param   Object  $formData
         * @return  Boolean
         * @date    2020-12-01
         */
        public function register($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("INSERT HA_admin(admin_name, admin_id, admin_pw, admin_create) 
                VALUES(:admin_name, :admin_id, :admin_pw, CURRENT_TIMESTAMP)");

            $stmt->bindValue(':admin_name', $formData->name);
            $stmt->bindValue(':admin_id', $formData->id);
            $stmt->bindValue(':admin_pw', $formData->password);

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