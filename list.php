<?php
error_reporting(E_ERROR);
setcookie('guestName',$_GET['u_name'],time()+3600*3600,"/");

if (isset($_POST['logout'])){
    setcookie('guestName',$_GET['u_name'],time()-100,"/");
    header("Location: http://university.netology.ru/u/smetanin/me8/list.php");
}

$address = explode(" ", trim(file_get_contents('addressFile')));
$Name = explode(" ", trim(file_get_contents('nameFile')));
array_unshift($address, null);
unset($address[0]);
array_unshift($Name, null);
unset($Name[0]);
$address = array_unique($address);

$Name47 = $_COOKIE['guestName'];
$number = $_POST['numberTest'];

if (count($Name) < $number) {
    header('HTTP/1.1 404 Not Found');

} elseif (isset($_POST['GOOD'])) {
    header("Location:  http://university.netology.ru/u/smetanin/me8/test.php?load=$address[$number]");
}if (isset($_POST['entry']) || (isset($_POST['GOOD'])) && !isset($_POST['entry'])){
   echo "<script> var name = prompt('Введите свое имя:');</script>";

        echo '<script type="text/javascript">';
        echo 'document.location.href="' . $_SERVER['REQUEST_URI'] . '?u_name=" + name';
        echo '</script>';
}


?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Список тестов</h1>
<form method="post" action="login.php">
    <input type="submit"  value="Авторизоваться">
</form>
<form method="post">
    <input type="submit" name="entry" value="Войти как гость">
    <input type="submit" name="logout" value="Выйти из гостевой учетной записи">
</form>
<form method="post">
    <h2>Выберите номер понравившегося вам теста</h2>
    <input type="number" name="numberTest">
    <input type="submit" name="GOOD" value="Перейти к тесту">
</form>
<?php for ($i = 1, $size = count($Name); $i <= $size; $i++) :
    echo "Тест № $i : $Name[$i]<br>";
endfor;
?>
</body>
</html>