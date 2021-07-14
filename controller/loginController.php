<?php
    setcookie('test' , 'sadasd', time() + 3600);
    require_once('../dbConnect/holler.php');
    /**
     * @brief   로그인 관련 클래스
     * @author  김정근
     * @date    2020-11-16
     */
    class loginController {
        
         /**
         * @brief   로그인 검증
         * @author  김정근
         * @param   String $userEmail
         * @param   String $userPassword
         * @param   String $autoLogin
         * @return  array $row
         * @date    2020-11-16
         */
        public function login($userEmail, $userPassword, $autoLogin) {
            $model = new holler();

            $keyText = 'Pneumonoultramicroscopicsilicovolcanoconiosis';
            $key = substr(hash('sha256', $keyText, true), 0, 32);

            //비밀번호 암호화 
            $userPassword = base64_encode(
                openssl_encrypt(
                    $userPassword, 
                    'aes-256-cbc', 
                    $key, 
                    true, 
                    str_repeat(chr(0), 32)
                )
            );

            $result = $model->login($userEmail, $userPassword);

            if($result['user_number']) {

                session_start();
                $_SESSION['userNumber'] = $result['user_number'];
                $_SESSION['userSnsType'] = $result['user_sns_type'];
                
                if($autoLogin == 'true') {
                    $_SESSION['autoLogin'] = true;
                }
                
                $result['data'] = true;
            } else {
                $result = array(
                    'data' => false
                );
            }
            
            return $result;
        }

        /**
         * @brief   로그인 검증
         * @author  김정근
         * @return  boolean true
         * @date    2020-11-16
         */
        public function logout() {
            session_start();
            
            foreach($_SESSION as $key=>$value) {
                if($key != 'adminNumber') {
                    unset($_SESSION[$key]);
                } 
            }

            if(isset($_SESSION['autoLogin'])) {
                unset($_SESSION['autoLogin']);
                unset($_COOKIE['userNumber']);
            }

            return true;
        }
    }
?>