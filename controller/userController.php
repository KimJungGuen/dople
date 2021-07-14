<?php 
require_once('../dbConnect/holler.php');

/**
 * @brief   유저 관련 클래스
 * @author  김정근
 * @date    2020-11-17
 */
class userController {

    /**
     * @brief   유저 등록
     * @author  김정근
     * @param   Aarray $formData
     * @return  boolean $result
     * @date    2020-11-17
     */
    public function register($formData){
        $model = new holler();
        $formData = (object)$formData;

        //유저 등록을 위해 데이터 폼 일치화 
        if($formData->response) {
            //naver
            $formData->email = $formData->response->email;
            $formData->name = $formData->response->name;
            $formData->snsType = "naver";
        } else if($formData->properties) {
            //kakao
            $formData->email = $formData->kakao_account->email 
                ?: $userResponse->properties->nickname;
            $formData->name = $formData->properties->nickname;
            $formData->snsType = "kakao";
        } else if(empty($formData->snsType)) {
            $formData->snsType = "company";
        }

        //암호화 키 값 생성
        $keyText = 'Pneumonoultramicroscopicsilicovolcanoconiosis';
        $key = substr(hash('sha256', $keyText, true), 0, 32);

        if($formData->password) {
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
        }
        
        //복호화
        // $formData->password = openssl_decrypt(
        //     base64_decode($formData->password), 
        //     'aes-256-cbc', 
        //     $key, 
        //     true, 
        //     str_repeat(chr(0), 32)
        // );

        $check = $model->checkUser($formData->email, $formData->snsType);

        if($check) {
            $result = $model->userRegister($formData);
        } else {
            $result = false;
        }
    
        return $check;
    }

    /**
     * @brief   유저 정보 수정
     * @author  김정근
     * @param   Array $formData
     * @param   Sting $userNumber
     * @return  Array $result
     * @date    2020-11-23
     */
    public function update($formData, $userNumber) {
        $model = new holler();
        $formData = (object)$formData;

        if($formData->old_password && $formData->new_password && $formData->new_password_confirm) {
            $keyText = 'Pneumonoultramicroscopicsilicovolcanoconiosis';
            $key = substr(hash('sha256', $keyText, true), 0, 32);

            //비밀번호 암호화 
            $formData->password = base64_encode(
                openssl_encrypt(
                    $formData->new_password, 
                    'aes-256-cbc', 
                    $key, 
                    true, 
                    str_repeat(chr(0), 32)
                )
            );
        }

        $result = $model->userUpdate($formData, $userNumber);

        return $result;
    }

    /**
     * @brief   유저 정보 조회(단일)
     * @author  김정근
     * @param   String $userEmail
     * @return  Array $result
     * @date    2020-11-23
     */
    public static function getUser($userEmail) {
        $model = new holler();

        $result = $model->getUser($userEmail);

        return $result;
    }

    public function getUserNumber($userEmail, $snsType) {
        $model = new holler();

        $userNumber = $model->getUserNumber($userEmail, $snsType);

        return $userNumber;
    }
}
?>