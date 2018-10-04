<?php

    session_start();

    function randomTokenGenerator($sessionId){
        $leng = 32;
        $char = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
        $charLeng = strlen($char);

        $randString = '';

        for ($i = 0; $i < $leng; $i++) {
            $randString .= $char[rand(0, $charLeng - 1)];
        }

        $randString .= $sessionId[rand(0, strlen($sessionId) - 5)];

        return $randString;
    }

    function logout() {
        unset($_COOKIE['csrf_session']);
        setcookie('csrf_session', null, -1, '/');
        unset($_COOKIE['csrf_token']);
        setcookie('csrf_token', null, -1, '/');
        unset($_SESSION);
        header("location: /");
    }

    if(isset($_POST['submitCsrf'])){

        if($_COOKIE["csrf_token"] == $_POST['token']){
            header("location: /success.php");
        }
        else{
            header("location: /error.php");
        }
    }

    if(isset($_POST['logout'])){
        logout();
    }

?>