<?php
   /**
     * @brief   결제관련 db처리
     * @author  김정근
     * @date    2020-11-25
     */
    class HollerPay{

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
         * @brief   유저 카드 조회
         * @author  김정근
         * @param   Int $userNumber
         * @return  Array $result
         * @date    2020-11-26
         */
        public function getCard($userNumber){
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT * FROM HA_payCard WHERE card_user_number = :card_user_number");
            $stmt->bindValue(':card_user_number', $userNumber);
            $result = $stmt->execute();

            if($result) {
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $decode = array();

                $keyText = 'Pneumonoultramlcanoconiosis';
                $keyPw = substr(hash('sha256', $keyText, true), 0, 32);
                $regex = '/(card_number)|(card_name)|(card_bank)|(card_user_number)/';

                for($i = 0; $i < count($row); $i++) {
                    foreach($row[$i] as $key => $value) {
                        if(!preg_match($regex, $key)) {
                            $row[$i][$key] = openssl_decrypt(
                                base64_decode($value), 
                                'aes-256-cbc', 
                                $keyPw, 
                                true, 
                                str_repeat(chr(0), 32)
                            );
                        }
                    }
                }

                return $row;
            } else {
                return false;
            }

        }

        /**
         * @brief   유저 카드 등록
         * @author  김정근
         * @param   Object $formData
         * @param   Int $userNumber
         * @return  Array $result
         * @date    2020-11-26
         */
        public function registerCard($formData, $userNumber){
            $pdo = $this->connect();

            $stmt = $pdo->prepare("INSERT HA_payCard(card_name, card_cradit_number, card_validity_year, card_validity_month, card_pw, card_cvc, card_bank, card_user_number)
                VALUES(:card_name, :card_cradit_number, :card_validity_year, :card_validity_month, :card_pw, :card_cvc, :card_bank, :card_user_number)");

            $stmt->bindValue(':card_name', $formData->name);
            $stmt->bindValue(':card_cradit_number', $formData->card_number);
            $stmt->bindValue(':card_validity_year', $formData->card_year);
            $stmt->bindValue(':card_validity_month', $formData->card_month);
            $stmt->bindValue(':card_pw', $formData->card_pw);
            $stmt->bindValue(':card_cvc', $formData->cvc);
            $stmt->bindValue(':card_bank', $formData->bank);
            $stmt->bindValue(':card_user_number', $userNumber);

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
         * @brief   유저 카드 삭제
         * @author  김정근
         * @param   Int $cardNumber
         * @return  Boolean
         * @date    2020-11-27
         */
         public function deleteCard($cardNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_payCard WHERE card_number = :card_number");
            $stmt->bindValue(':card_number', $cardNumber);

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
         * @brief   유저 계좌 조회
         * @author  김정근
         * @param   Int $userNumber
         * @return  Array $result
         * @date    2020-11-26
         */
        public function getAccount($userNumber){
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_payAccount WHERE account_user_number = :account_user_number");
            $stmt->bindValue(':account_user_number', $userNumber);
            $result = $stmt->execute();

            if($result) {
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $decode = array();

                $keyText = 'Pneumonoullcanoconiosis';
                $keyPw = substr(hash('sha256', $keyText, true), 0, 32);

                for($i = 0; $i < count($row); $i++) {
                    foreach($row[$i] as $key => $value) {
                        if($key == 'account_cradit_number') {
                            $row[$i][$key] = openssl_decrypt(
                                base64_decode($value), 
                                'aes-256-cbc', 
                                $keyPw, 
                                true, 
                                str_repeat(chr(0), 32)
                            );
                        }
                    }
                }

                return $row;
            } else {
                return false;
            }

        }

         /**
         * @brief   유저 계좌 등록
         * @author  김정근
         * @param   Object $formData
         * @param   Int $userNumber
         * @return  Array $result
         * @date    2020-11-26
         */
        public function registerAccount($formData, $userNumber){
            $pdo = $this->connect();
            
            $stmt = $pdo->prepare("INSERT HA_payAccount(account_name, account_cradit_number, account_owner, account_bank, account_user_number) 
                VALUES(:account_name, :account_cradit_number, :account_owner, :account_bank, :account_user_number)");

            $stmt->bindValue(':account_name', $formData->name);
            $stmt->bindValue(':account_cradit_number', $formData->account);
            $stmt->bindValue(':account_owner', $formData->owner);
            $stmt->bindValue(':account_bank', $formData->bank);
            $stmt->bindValue(':account_user_number', $userNumber);

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
         * @brief   유저 계좌 삭제
         * @author  김정근
         * @param   Int $accountNumber
         * @return  Boolean
         * @date    2020-11-27
         */
        public function deleteAccount($accountNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_payAccount WHERE account_number = :account_number");
            $stmt->bindValue(':account_number', $accountNumber);

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