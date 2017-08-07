<?php

error_reporting(E_ERROR);

$address = explode(" ", trim(file_get_contents('addressFile')));
$Name = explode(" ", trim(file_get_contents('nameFile')));
array_unshift($address, null);
unset($address[0]);
array_unshift($Name, null);
unset($Name[0]);
$address = array_unique($address);


$number = $_POST['numberTest'];

if (count($Name) < $number) {
    header('HTTP/1.1 404 Not Found');

} elseif (isset($_POST['GOOD'])) {
    header("Location:  http://university.netology.ru/u/smetanin/me7/test.php?load=$address[$number]");
}if (isset($_POST['entry'])){
   echo "<script> var name = prompt('Введите свое имя?');</script>";
   // if (isset($_GET['u_name']))
   // {

   // }

    //else
   // {
        echo '<script type="text/javascript">';
        echo 'document.location.href="' . $_SERVER['REQUEST_URI'] . '?u_name=" + name';
        echo '</script>';
        echo "Значение JavaScript-переменной: ". $_GET['u_name'];
        
   // }
}
?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Список тестов</h1>
<form method="post" action="admin.php">
    <input type="submit" value="Войти">
</form>
<form method="post" action="login.php">
    <input type="submit"  value="Авторизоваться">
</form>
<form method="post">
    <input type="submit" name="entry" value="Войти как гость">
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