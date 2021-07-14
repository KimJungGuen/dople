<?php
    session_start();


    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'DELETE') {
        $url = 'https://kapi.kakao.com/v1/user/unlink';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        $headers = array();
        $headers[] = "Authorization: Bearer {$result->access_token}";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
        $response = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);
        unset($_SESSION['userEmail']);
        unset($_SESSION['kakaoToken']);

        header("Location: https://www.madclother.com/dev/index.php");
    }

    if($method == 'GET') {

        if($_GET['state'] == $_SESSION['state']){
            $url = 'https://kauth.kakao.com/oauth/token';

            $postData = array(
                'code' => $_GET['code'],
                'client_id' => '75111ed7e4065ed9710e3071ebf306c9',
                'redirect_uri' => 'https://www.madclother.com/dev/sns/kakao.php',
                'grant_type' => 'authorization_code'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($ch, CURLOPT_POSTFIELDSIZE, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
            $response = curl_exec ($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close ($ch);
            $_SESSION['kakaoToken'] = $result->access_token;

            $result = json_decode($response);

            if($statusCode == 200) {

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://kapi.kakao.com/v2/user/me');
                curl_setopt($ch, CURLOPT_POST, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $headers = array();
                $headers[] = "Authorization: Bearer {$result->access_token}";
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
                $userResponse = curl_exec ($ch);
                $userStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close ($ch);
                
                if($userStatusCode == 200) {
                    
                    $userResponse = json_decode($userResponse);

                    require_once('../controller/userController.php');

                    $user = new userController();

                    $userNumber = $user->getUserNumber($userResponse->kakao_account->email, 'kakao');


                    if($userNumber['user_number'] == 0) {
                        $userResult = $user->register($userResponse);

                        $_SESSION['userNumber'] = $userResult;
                        $_SESSION['userSnsType'] = 'kakao';
                    } else {
                        $_SESSION['userNumber'] = $userNumber['user_number'];
                        $_SESSION['userSnsType'] = 'kakao';
                    }
                   

                    echo("
                        <script>
                            opener.location.reload();
                            window.close();
                        </script>
                    ");
                } else {
                    header("Location: https://www.madclother.com/dev/login.php");
                }
            } else {
                header("Location: https://www.madclother.com/dev/login.php");
            }
        }
    }
    
?>