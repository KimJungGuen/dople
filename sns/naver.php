<?php
    session_start();
    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'DELETE') {
        $client_id = "1aCf8hMK4fRySy2xbdDC";
        $client_secret = "YYxDHtavA5";
        $redirectURI = urlencode("https://www.madclother.com/dev/index.php");
        $url = "https://nid.naver.com/oauth2.0/token?grant_type=delete&client_id=" . $client_id . "&client_secret=" . $client_secret . "&access_token=" . $_SESSION['token'] . "&service_provider=NAVER";
        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
        $headers = array();
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);
        unset($_SESSION['userEmail']);
        unset($_SESSION['naverToken']);
        unset($_SESSION['naverRfreshToken']);
        unset($_SESSION['state']);

        header("Location: https://www.madclother.com/dev/index.php");
    }
    
    if($method == 'GET') {
        if($_GET['state'] != $_SESSION['state']) {
            //header("Location: http://madclother.com/dev/login.php"); 
            echo var_dump($_SESSION['state']);
        } else {
            $client_id = "1aCf8hMK4fRySy2xbdDC";
            $client_secret = "YYxDHtavA5";
            $code = $_GET["code"];;
            $state = $_GET["state"];;
            $redirectURI = urlencode("https://www.madclother.com/dev/index.php");
            $url = "https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&redirect_uri=".$redirectURI."&code=".$code."&state=".$state;
            $is_post = false;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, $is_post); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
            $headers = array();
            $response = curl_exec ($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close ($ch);
            $response_decode = json_decode($response);
            $_SESSION['naverToken'] = $response_decode->access_token;
            $_SESSION['naverRfreshToken'] = $response_decode->refresh_token;

            if($status_code == 200) {
                $header = "Bearer ".$_SESSION['naverToken']; // Bearer 다음에 공백 추가
                $url = "https://openapi.naver.com/v1/nid/me";
                $is_post = false;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, $is_post);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
                $headers = array();
                $headers[] = "Authorization: ".$header;
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $response = curl_exec ($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close ($ch);
                if($status_code == 200) {
                    require_once('../controller/userController.php');

                    $user = new userController();

                    $result = json_decode($response);

                    $userNumber = $user->getUserNumber($result->response->email, 'naver');

                    if($userNumber['user_number'] == 0) {
                        $registerResult = $user->register($result);

                        $_SESSION['userNumber'] = $registerResult;
                        $_SESSION['userSnsType'] = 'naver';
                    } else {
                        $_SESSION['userNumber'] = $userNumber['user_number'];
                        $_SESSION['userSnsType'] = 'naver';
                    }
                    

                    echo("
                        <script>
                            opener.location.reload();
                            window.close();
                        </script>
                    ");
                } else {
                    header("Location: https://www.madclother.com/dev/login.php?error=". $response);
                    echo $response; 
                } 
            } else {
                header("Location: https://www.madclother.com/dev/login.php?error=". $response);
            }
        }
    }
    
?>