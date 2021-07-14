<?php
require_once('../dbConnect/holler.php');


/**
 * @brief   기타 함수 클래스
 * @author  김정근
 * @date    2020-11-17
 */
class etcController{


    /**
     * @brief   기타 함수 클래스
     * @author  김정근
     * @param   String $email
     * @return  Array $result
     * @date    2020-11-17
     */
    public function emailDuplicateCheck($email) {

        $model = new holler();

        if(empty($model->emailDuplicateCheck($email, 'company'))) {
            $result = array(
                'msg' => '가입 가능한 이메일입니다.',
                'duplicate' => false
            );
        } else {
            $result = array(
                'msg' => '중복된 이메일입니다.',
                'duplicate' => true
            );
        }
        
        return $result;
    }
}

?>