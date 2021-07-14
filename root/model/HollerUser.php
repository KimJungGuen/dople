<?php

    /** 
     * @brief   유저 관리
     * @author  김정근
     * @date    2020-12-16
     */
    class HollerUser{

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
         * @brief   유저목록 조회
         * @author  김정근
         * @return  Array $result
         * @date    2020-12-16
         */
        public function getsUser() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_users");
            $check = $stmt->execute();

            if($check) {    
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   유저목록 조회
         * @author  김정근
         * @param   Int $userNumber
         * @return  Array $result
         * @date    2021-01-29
         */
        public function getUser($userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_users WHERE user_number = :user_number");
            $stmt->bindValue(':user_number', $userNumber);
            $check = $stmt->execute();

            if($check) {    
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                return $result;
            } else {
                return false;
            }
        }

        /**
         * @brief   유저 등록
         * @author  김정근
         * @param   Object $formData
         * @return  Boolean
         * @date    2020-12-17
         */
        public function register($formData){
            $pdo = $this->connect();

            $stmt = $pdo->prepare("INSERT HA_users(user_email, user_pw, user_name, create_date)
                VALUES(:user_email, :user_pw, :user_name, CURRENT_TIMESTAMP)"
            );

            $stmt->bindValue(':user_email', $formData->email);
            $stmt->bindValue(':user_pw', $formData->pw);
            $stmt->bindValue(':user_name', $formData->name);

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
         * @brief   유저 수정
         * @author  김정근
         * @param   Object $formData
         * @return  Boolean
         * @date    2020-12-17
         */
        public function update($formData){
            $pdo = $this->connect();

            $stmt = $pdo->prepare("UPDATE HA_users SET 
                user_email = :user_email,
                user_pw = :user_pw,
                user_name = :user_name,
                update_date = CURRENT_TIMESTAMP
                WHERE user_number = :user_number"
            );

            $stmt->bindValue(':user_email', $formData->email);
            $stmt->bindValue(':user_pw', $formData->pw);
            $stmt->bindValue(':user_name', $formData->name);
            $stmt->bindValue(':user_number', $formData->no);

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
         * @brief   유저 삭제
         * @author  김정근
         * @param   Int $userNumber
         * @return  Boolean
         * @date    2020-12-17
         */
        public function delete($userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_users WHERE user_number = :user_number ");

            $stmt->bindValue(':user_number', $userNumber);

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