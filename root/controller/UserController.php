<?php
    require_once('../model/HollerUser.php');


    /**
     * @biref   유저관리 클래스
     * @author  김정근
     * @date    2020-12-17
     */
    class UserController{


        /**
         * @brief   유저 등록
         * @author  김정근
         * @param   Array $formData
         * @return  Boolean
         * @date    2020-12-17
         */
        public function register($formData) {
            $model = new HollerUser();
            $formData = (object)$formData;

            //암호화 키 값 생성
            $keyText = 'Pneumonoultramicroscopicsilicovolcanoconiosis';
            $key = substr(hash('sha256', $keyText, true), 0, 32);

            //비밀번호 암호화 
            $formData->pw = base64_encode(
                openssl_encrypt(
                    $formData->pw, 
                    'aes-256-cbc', 
                    $key, 
                    true, 
                    str_repeat(chr(0), 32)
                )
            );

            $result = $model->register($formData);

            return $result;
        }


        /**
         * @brief   유저 수정
         * @author  김정근
         * @param   Array $formData
         * @return  Boolaen
         * @date    2020-12-17
         */
        public function update($formData) {
            $model = new HollerUser();
            $formData = (object)$formData;

            //암호화 키 값 생성
            $keyText = 'Pneumonoultramicroscopicsilicovolcanoconiosis';
            $key = substr(hash('sha256', $keyText, true), 0, 32);

            //비밀번호 암호화 
            $formData->pw = base64_encode(
                openssl_encrypt(
                    $formData->pw, 
                    'aes-256-cbc', 
                    $key, 
                    true, 
                    str_repeat(chr(0), 32)
                )
            );

            $result = $model->update($formData);

            return $result;
        }

        /**
         * @brief   유저 삭제
         * @author  김정근
         * @param   Int $userNumber
         * @return  Boolean
         * @date    2020-12-17
         */
        public function delete($userNumber) {
            $model = new HollerUser();

            $result = $model->delete($userNumber);

            return $result;
        }
    }

?>