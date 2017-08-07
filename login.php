<?php
if(empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])){
    header( 'WWW-Authenticate: Basic realm="My Realm ');
    echo "<meta charset='UTF-8'><h1>Вы не смогли авторизоваться</h1>";
    echo "<meta charset='UTF-8'><form method='post'><input name='button' type='submit' value='Вернуться к списку тестов'></form>";

    if (isset($_POST['button'])){
        header("Location: http://university.netology.ru/u/smetanin/me8/list.php");
    }

    die();
}
$data = file_get_contents("data.json");
$file = json_decode($data,true);
if ($_SERVER['PHP_AUTH_USER'] == $file[0]['user'] && $_SERVER['PHP_AUTH_PW'] == $file[0]['password'] ){
    header("Location: http://university.netology.ru/u/smetanin/me8/admin.php");
}else{
    header( 'WWW-Authenticate: Basic realm="M Realm"');
    die();
}

