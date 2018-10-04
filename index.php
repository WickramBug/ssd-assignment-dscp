<?php
    session_start();

    if(isset($_POST['login'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        if($username=='abc' && $password=='abc@123'){
            
            session_regenerate_id();
            setcookie("csrf_session",session_id());

            include("./Server/token.php");
            $token=randomTokenGenerator(session_id());

            setcookie("csrf_token",$token);
            header('location: ./Public/home.php');
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Double Submit Cookie Token - Home</title>

    <link rel="stylesheet" type="text/css" href="./css/style.css">
    
</head>

<body>
    <h1 class="form-title">Login</h1>
    <div class="form-class signin">
        <form class="form-signing" action="index.php" method="POST">
            <input type="text" name="username" id="username" value="abc">
            <input type="password" name="password" id="password" value="abc@123">
            <button type="submit" name="login">Submit</button>
        </form>
    </div>
</body>

</html>