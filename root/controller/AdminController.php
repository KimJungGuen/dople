<?php
    require_once('../model/HollerAdmin.php');


    class AdminController{


        public function register($formData) {
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

            $result = $model->register($formData);

            return $formData;
        }
    }
?>