<?php

    /**
     * @brief   유저관련 db처리
     * @author  김정근
     * @date    2020-11-24
     */
    class holler {

        /**
         * @brief   db연결 인자 생성
         * @author  김정근
         * @return  mysqli
         * @date    2020-11-16
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
         * @brief   유저 등록
         * @author  김정근
         * @param   Object $formData
         * @return  Mixed
         * @date    2020-11-17
         */
        public function userRegister($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "INSERT HA_users(
                    user_email,
                    user_pw,
                    user_name,
                    user_sns_type,
                    user_password_status,
                    create_date
                ) VALUES(
                    :user_email,
                    :user_pw,
                    :user_name,
                    :user_sns_type,
                    :user_password_status,
                    CURRENT_TIMESTAMP
                )"
            );

            $stmt->bindValue(':user_email', $formData->email);
            $stmt->bindValue(':user_pw', $formData->password);
            $stmt->bindValue(':user_name', $formData->name);
            $stmt->bindValue(':user_sns_type', $formData->snsType);
            $stmt->bindValue(':user_password_status', $formData->password_statuss);

            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $userNumber = $pdo->lastInsertId();
                $pdo->commit();
                if(isset($formData->digital_brochure)) {
                    $pdoAddress = $this->connect();
                    $stmtAddress = $pdoAddress->prepare(
                        "INSERT HA_address(
                            address_code,
                            address_address,
                            address_detail,
                            address_user_number,
                            address_recipient
                        ) VALUES (
                            :address_code,
                            :address_address,
                            :address_detail,
                            :address_user_number,
                            :address_recipient
                        )"
                    );

                    $stmtAddress->bindValue(':address_code', $formData->post);
                    $stmtAddress->bindValue(':address_address', $formData->post_1);
                    $stmtAddress->bindValue(':address_detail', $formData->post_2);
                    $stmtAddress->bindValue(':address_user_number', $userNumber);
                    $stmtAddress->bindValue(':address_recipient', $formData->name);

                    $pdoAddress->beginTransaction();
                    $checkAddress = $stmtAddress->execute();

                    if($checkAddress) {
                        $pdoAddress->commit();
                    } else {
                        $pdo->rollback();
                        $pdoAddress->rollback();
                        return false;
                    }
                }
                return $userNumber;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        /**
         * @brief   유저 정보 수정
         * @author  김정근
         * @param   Object $formData
         * @param   Int $userNumber
         * @return  Boolean
         * @date    2020-11-24
         */
        public function userUpdate($formData, $userNumber) {
            $pdo = $this->connect();

            if($formData->password) {
                $stmt = $pdo->prepare(
                    "UPDATE HA_users SET
                        user_pw = :user_pw,
                        user_name = :user_name,
                        user_password_status = :user_password_status,
                        update_date = CURRENT_TIMESTAMP
                    WHERE user_number = :user_number"
                );

                $stmt->bindValue(':user_pw', $formData->password);
                $stmt->bindValue(':user_password_status', 'find');
            } else {
                $stmt = $pdo->prepare(
                    "UPDATE HA_users SET
                        user_name = :user_name,
                        update_date = CURRENT_TIMESTAMP
                        WHERE user_number = :user_number"
                );
            }
            
            $stmt->bindValue(':user_name', $formData->name);
            $stmt->bindValue(':user_number', $userNumber);
            
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
         * @brief   유저 번호 조회
         * @author  김정근
         * @param   String $userEmail
         * @param   String $snsType
         * @return  Int $row
         * @date    2020-01-11
         */
        public function getUserNumber($userEmail, $snsType){
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT user_number FROM HA_users WHERE user_email = :user_email AND user_sns_type = :user_sns_type");

            $stmt->bindValue(':user_email', $userEmail);
            $stmt->bindValue(':user_sns_type', $snsType);

            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetch();

                if($row['user_number'] > 0) {
                    return $row;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }

         /**
         * @brief   로그인 검증
         * @author  김정근
         * @param   String $userEmail
         * @param   String $userPassword
         * @return  array $row
         * @date    2020-11-16
         */
        public function login($userEmail, $userPassword) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT user_name, user_number, user_email, user_sns_type FROM HA_users WHERE
                user_email = :user_email and user_pw = :user_pw");

            $stmt->bindValue(':user_email', $userEmail);
            $stmt->bindValue(':user_pw', $userPassword);

            $check = $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        /**
         * @brief   이메일 중복 확인
         * @author  김정근
         * @param   String $userEmail
         * @return  int $rowCount
         * @date    2020-11-17
         */
        public function emailDuplicateCheck($email, $snsType){

            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT count(*) FROM HA_users WHERE user_email = :user_email AND user_sns_type = :user_sns_type");

            $stmt->bindValue(':user_email', $email);
            $stmt->bindValue(':user_sns_type', $snsType);

            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetch();

                if($row[0] > 0) {
                    return $row[0];
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }

        /**
         * @brief   유저 이름 조회
         * @author  김정근
         * @param   Int $userNumber
         * @return  String
         * @date    2020-11-23
         */
        public function getUserName($userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare('SELECT user_name FROM HA_users WHERE user_number = :user_number');
            $stmt->bindValue(':user_number', $userNumber);

            if($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['user_name'];
            } else {
                return '';
            }
        }

        /**
         * @brief   유저 조회
         * @author  김정근
         * @param   Int $userNumber
         * @return  String
         * @date    2020-11-23
         */
        public function getUser($userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare('SELECT * FROM HA_users WHERE user_number = :user_number');
            $stmt->bindValue(':user_number', $userNumber);

            if($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return '';
            }
        }

        /**
         * @brief   유저 비밀번호 상태 조회
         * @author  김정근
         * @param   Int $userNumber
         * @return  String
         * @date    2021-01-20
         */
        public function getUserPwStatus($userNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare('SELECT user_password_status FROM HA_users WHERE user_number = :user_number');
            $stmt->bindValue(':user_number', $userNumber);

            if($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['user_password_status'];
            } else {
                return '';
            }
        }


        /**
         * @brief   유저 가입 조회
         * @author  김정근
         * @param   String $userEmail
         * @param   String $snsType
         * @return  Boolean
         * @date    2020-01-06
         */
        public function checkUser($userEmail, $snsType) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT count(*) FROM HA_users WHERE user_email = :user_email AND user_sns_type = :user_sns_type");

            $stmt->bindValue(':user_email', $userEmail);
            $stmt->bindValue(':user_sns_type', $snsType);

            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetch();

                if($row[0] > 0) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }

        public function passwordChange($data) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "UPDATE HA_users SET
                    user_pw = :user_pw,
                    user_password_status = :user_password_status,
                    update_date = CURRENT_TIMESTAMP
                WHERE user_number = :user_number"
            );

            $stmt->bindValue(':user_pw', $data->password);
            $stmt->bindValue('user_password_status', "failed");
            $stmt->bindValue(':user_number', $data->userNumber);

            $pdo->beginTransaction();

            if($stmt->execute()) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }
    }

?>