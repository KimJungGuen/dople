<?php
    require_once('../controller/loginController.php');
    require_once('../controller/userController.php');

    $method = $_SERVER['REQUEST_METHOD'];

    //로그인 클래스 객체 생성
    $login = new loginController();
    $user = new userController();

    if($method == 'POST' && $_POST['type'] == "faceBook") {
        $userNumber = $user->getUserNumber($_POST['id'], 'faceBook');

        $userData = array(
            "email" => $_POST['id'],
            "name" => $_POST['name'],
            "snsType" => "faceBook"
        );

        session_start();

        if($userNumber == 0) {
            $result = $user->register($userData);

            $_SESSION['userNumber'] = $result['user_number'];
            $_SESSION['userSnsType'] = 'faceBook';
        } else {
            $_SESSION['userNumber'] = $userNumber['user_number'];
            $_SESSION['userSnsType'] = 'faceBook';
        }
    }

    if($method == 'POST' && $_POST['type'] != "faceBook") {
        //로그인 정보로 유저 정보 호출 및 세션, 쿠키 set
        $result = $login->login($_POST['user_email'], $_POST['user_password'], $_POST['auto_login']);

        //json 타입으로 유저 이메일, 이름
        echo json_encode($result);
    } 
    
    if($method == 'DELETE') {
        $login->logout();
        echo json_encode(array('logout' => true));
    }
?>