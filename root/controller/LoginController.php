<?php
    require_once('../model/HollerAdmin.php');

    /**
     * @brief   관리자 로그인 관리
     * @author  김정근 
     * @date    2020-11-30
     */
    class LoginController{


        /**
         * @brief   관리자 로그인
         * @author  김정근
         * @param   Array $formData
         * @return  Boolean
         * @date    2020-11-30
         */
        public function login($formData){
            $model = new HollerAdmin();

            $formData = (object)$formData;
            
            $keyText = '7L2U7Lm07L2c652866eI7Iuc7KqZ';
            $key = substr(hash('sha256', $keyText, true), 0, 32);

            //비밀번호 암호화 
            $formData->password = base64_encode(
                openssl_encrypt(
                    $formData->password, 
                    'aes-256-cbc', 
                    $key, 
                    true, 
                    str_repeat(chr(0), 32)
                )
            );

            $result = $model->login($formData);

            if($result->admin_name) {
                session_start();
                $_SESSION['adminName'] = $result->admin_name;
                $_SESSION['adminNumber'] = $result->admin_name;

                if($formData->remember) {
                    $_SESSION['remember'] = true;
                }

                return true;
            } else {
                return false;
            }
        }

        /**
         * @brief   관리자 로그아웃
         * @author  김정근
         * @return  Boolean
         * @date    2020-11-30
         */
        public function logout(){
            session_start();
            unset($_SESSION['adminName']);
            unset($_SESSION['adminNumber']);

            setcookie('adminName', $_SESSION['adminName'], time() - 3600);
            $_COOKIE['adminName'] = null;

            setcookie('adminNumber', $_SESSION['adminNumber'], time() - 3600);
            $_COOKIE['adminNumber'] = null;

            return true;
        }
    }
?>