<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Double Submit Cookie Token - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    


<h1 class="form-title">Double Submit Cookie Pattern Sample</h1>
<div class="form-class">
    <form action="token.php" method="POST">
        <input type="hidden" id="token" name="token" value="token">
        <input type="text" id="tokenEdit" name="editedToken" value="editedToken" onChange="tokenEditor();">
        <button type="button" id="assignToken" onClick="tokenEditor();">Change the Token</button>
        <button type="submit" name="submitCsrf">Submit</button>
        <?php
            if(isset($_COOKIE['csrf_session'])){
                echo 
                    '<button type="submit" value="Logout" name="logout">Logout</button>';
            }
        ?>
    </form> 
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
    function tokenExtractor() {
        
        var cookieName = "csrf_token=";
        var decodedCookies = decodeURIComponent(document.cookie);
        var cookies = decodedCookies.split(";");

        var token = null;

        for (var c in cookies) {

            var cookie = cookies[c];

            while (cookie.charAt(0) == ' ') {
                cookie = cookie.substring(1);
            }

            if (cookie.indexOf(cookieName) == 0) {
                token = cookie.substring(cookieName.length, cookie.length);
            }
        }

        return token;
    }
        
    function tokenAppendor() {
        document.getElementById("token").value = tokenExtractor();
        document.getElementById("tokenEdit").value = tokenExtractor();
    }

    function tokenEditor(){
        if(tokenExtractor()==document.getElementById("tokenEdit").value){
            alert("Please change the token by typing in the text field!");
        }
        else{
            document.getElementById("token").value = document.getElementById("tokenEdit").value;
            alert("Token changed successfully, now submit to see the results.");
        } 
    }

    $(document).ready(function () {
        tokenAppendor();
    });
</script>
    
</body>
</html>