<?php


    /**
     * @brief   주소관련 db처리
     * @author  김정근
     * @date    2020-11-24
     */
    class HollerAddress{
 
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

        public function getUserNumber($userEmail) {
            $pdo = $this->connect();

            $userStmt = $pdo->prepare("SELECT user_number FROM HA_users WHERE user_email = :user_email");
            $userStmt->bindValue(':user_email', $userEmail);
            $userStmt->execute();

            $row = $userStmt->fetch();
            $userNumber = $row['user_number'];

            return $userNumber;
        }

        /**
         * @brief   유저 주소 정보 조회
         * @author  김정근
         * @param   Int $userNumber
         * @return  Array $result
         * @date    2020-11-24
         */
        public function getsAddress($userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_address WHERE address_user_number = :userNumber");
            $stmt->bindValue(':userNumber', $userNumber);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        /**
         * @brief   유저 주소 정보 조회
         * @author  김정근
         * @param   Int $addressNumber
         * @param   Int $userNumber
         * @return  Array $result
         * @date    2020-11-25
         */
        public function getAddress($addressNumber, $userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_address WHERE address_number = :addressNumber AND address_user_number = :userNumber");
            $stmt->bindValue(':addressNumber', $addressNumber);
            $stmt->bindValue(':userNumber', $userNumber);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        /**
         * @brief   주소 등록
         * @author  김정근
         * @param   Object $formData
         * @param   Int $userNumber
         * @return  Boolean 
         * @date    2020-11-25
         */
        public function register($formData, $userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("INSERT HA_address(address_code, address_address, address_detail, address_recipient, address_user_number)
                VALUES(:address_code, :address_address, :address_detail, :address_recipient, :address_user_number)");


            $stmt->bindValue(':address_code', $formData->post);
            $stmt->bindValue(':address_address', $formData->post_1);
            $stmt->bindValue(':address_detail', $formData->post_2);
            $stmt->bindValue(':address_recipient', $formData->recipient);
            $stmt->bindValue(':address_user_number', $userNumber);

            $pdo->beginTransaction();
            $queryResult = $stmt->execute();

            if($queryResult) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        /**
         * @brief   주소 수정
         * @author  김정근
         * @param   Object $formData
         * @return  Boolean 
         * @date    2020-11-25
         */
        public function update($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("UPDATE HA_address SET address_code = :address_code, address_address = :address_address, 
                address_detail = :address_detail, address_recipient = :address_recipient WHERE address_number = :address_number");

            $stmt->bindValue(':address_code', $formData->post);
            $stmt->bindValue(':address_address', $formData->post_1);
            $stmt->bindValue(':address_detail', $formData->post_2);
            $stmt->bindValue(':address_recipient', $formData->name);
            $stmt->bindValue(':address_number', $formData->no);

            $pdo->beginTransaction();
            $queryResult = $stmt->execute();

            if($queryResult) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
            return true;
        }

        /**
         * @brief   주소 삭제
         * @author  김정근
         * @param   Int $addressNumber
         * @return  Boolean 
         * @date    2020-11-25
         */
        public function delete($addressNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_address WHERE address_number = :address_number");

            $stmt->bindValue(':address_number', $addressNumber);

            $pdo->beginTransaction();
            $queryResult = $stmt->execute();
             
            if($queryResult) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }
    }
?>