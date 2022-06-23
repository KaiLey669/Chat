<!DOCTYPE HTML>
<html>

    <head>
        <meta charset = "UTF-8">
        <title>Chat</title>
    </head>
    <body>
        <form action = "/" method = "GET">
            <p><input name = "login" placeholder = "Enter login" value = ""></p>
            <p><input name = "password" placeholder = "Enter password" value = ""></p>
            <p><input name = "message" placeholder = "Enter message"></p>
            <button>Push</button>
        </form>
    </body>

</html>

<?php
    function addToHistory($login, $message){
        $messageJson = (object) ['user' => $login, 'message' => $message];
        $content = json_decode(file_get_contents("history.json"));
        $content->messages[] = $messageJson;
        file_put_contents("history.json", json_encode($content));
    }

    function printMessages(){
        $content = json_decode(file_get_contents("history.json"));
        foreach($content->messages as $message){
            echo "<p>";
            echo "$message->user: $message->message";
            echo "</p>";
        }
    }

    $adminLogin = "admin";
    $adminPassword = "12345";

    $login = $_GET["login"];
    $password = $_GET["password"];
    $message = $_GET["message"];


    if (($login === $adminLogin) && ($password === $adminPassword)){
        addToHistory($login, $message);
    }
    else{
        echo "Incorrect login or password";
    }

    printMessages();

?>

