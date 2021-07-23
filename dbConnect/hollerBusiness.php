<?php

    /**
     * @brief   사업자정보관리
     * @author  김정근
     * @data    2020-11-27
     */
    class HollerBusiness{

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
         * @brief   유저 번호
         * @author  김정근
         * @param   String $userEmail
         * @return  Int $userNumber
         * @date    2020-11-25
         */
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
         * @brief   사업자들 조회
         * @author  김정근
         * @param   Int $userNumber
         * @return  Array $row
         * @date    2020-11-27
         */
        public function getsBusiness($userNumber) {
            $pdo = $this->connect();
            
            $stmt = $pdo->prepare("SELECT * FROM HA_business WHERE business_user_number = :business_user_number");
            $stmt->bindValue(':business_user_number', $userNumber);
            $stmt->execute();

            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $row;
        }

        /**
         * @brief   사업자 조회
         * @author  김정근
         * @param   String $businessNumber
         * @return  Array $row
         * @date    2020-11-27
         */
        public function getBusiness($businessNumber) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT * FROM HA_business WHERE business_number = :business_number");
            $stmt->bindValue(':business_number', $businessNumber);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        /**
         * @brief   사업자 등록
         * @author  김정근
         * @param   Object $formData
         * @param   Int $userNumber
         * @return  Boolean
         * @date    2020-11-25
         */
        public function registerBusiness($formData, $userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("INSERT HA_business(
                business_ceo, 
                business_name, 
                business_mutual, 
                business_code,
                business_address,
                business_address_detail,
                business_email,
                business_phone,
                business_industry,
                business_condition,
                business_business,
                business_user_number) VALUES(
                    :business_ceo,
                    :business_name,
                    :business_mutual,
                    :business_code,
                    :business_address,
                    :business_address_detail,
                    :business_email,
                    :business_phone,
                    :business_industry,
                    :business_condition,
                    :business_business,
                    :business_user_number)"
            );
            $stmt->bindValue(':business_ceo', $formData->ceo);
            $stmt->bindValue(':business_name', $formData->name);
            $stmt->bindValue(':business_mutual', $formData->mutual);
            $stmt->bindValue(':business_code', $formData->post);
            $stmt->bindValue(':business_address', $formData->post_1);
            $stmt->bindValue(':business_address_detail', $formData->post_2);
            $stmt->bindValue(':business_email', $formData->email);
            $stmt->bindValue(':business_phone', $formData->phone);
            $stmt->bindValue(':business_industry', $formData->industry);
            $stmt->bindValue(':business_condition', $formData->condition);
            $stmt->bindValue(':business_business', $formData->business);
            $stmt->bindValue(':business_user_number', $userNumber);

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
         * @brief   사업자 수정
         * @author  김정근
         * @param   Object $formData
         * @return  Boolean
         * @date    2020-11-25
         */
        public function update($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("UPDATE HA_business SET
                business_ceo = :business_ceo,
                business_name = :business_name,
                business_mutual = :business_mutual,
                business_code = :business_code,
                business_address = :business_address,
                business_address_detail = :business_address_detail,
                business_email = :business_email,
                business_phone = :business_phone,
                business_industry = :business_industry,
                business_condition = :business_condition,
                business_business = :business_business");


            $stmt->bindValue(':business_ceo', $formData->ceo);
            $stmt->bindValue(':business_name', $formData->name);
            $stmt->bindValue(':business_mutual', $formData->mutual);
            $stmt->bindValue(':business_code', $formData->post);
            $stmt->bindValue(':business_address', $formData->post_1);
            $stmt->bindValue(':business_address_detail', $formData->post_2);
            $stmt->bindValue(':business_email', $formData->email);
            $stmt->bindValue(':business_phone', $formData->phone);
            $stmt->bindValue(':business_industry', $formData->industry);
            $stmt->bindValue(':business_condition', $formData->condition);
            $stmt->bindValue(':business_business', $formData->business);

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
         * @brief   사업자 삭제
         * @author  김정근
         * @param   Int $businessNumber
         * @return  Boolean 
         * @date    2020-11-25
         */
        public function delete($businessNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_business WHERE business_number = :business_number");

            $stmt->bindValue(':business_number', $businessNumber);

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