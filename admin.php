<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Панеь загрузки тестов</title>
</head>
<body>
<form method="post" action="list.php">
    <input type="submit" value="Выйти">
</form>
<form enctype="multipart/form-data" method="post">
    <input name="name">
    <input type="file" name="uploadFile">
    <input type="submit" name="submit" value="Отправить">
</form>
<!--<form method="post">
    <input type="button" name="delete" value="Удалить тест">
</form>-->
</body>
</html>


<?php
error_reporting(E_ERROR);
if(empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])){
    header( 'Location: http://university.netology.ru/u/smetanin/me8/login.php');
    die();
}
$list = file_get_contents("nameFile");
$list2 = explode(" ",$list);

array_pop($list2);

echo "<pre>";
print_r($list2);

$file = trim(file_get_contents('addressFile')); // получаем данные из файла addressName
$ex = array_unique(explode(" ", $file)); // преобразуем строику полученную из файла в массив
echo "<pre>";
print_r($ex);


if (empty($_FILES['uploadFile'])) {
    echo 'Добавьте новый тест на сайт';
    exit();
} elseif (is_null($_FILES['uploadFile'])) {
    echo 'Вы не добавили тест';
    exit();
}


$json = $_FILES['uploadFile'];      //получаем данные о загруженном файле
$filename = $json['name']; // сохраняем в переменную его имя
$nameVar = $_POST['name'];

$address = fopen('addressFile', 'a+'); //открываем файл "addressName", в котором будут храниться  именя файлов загруженных на сервер
trim(fwrite($address, $filename . " "));       //записываем имена в файл черех пробел и удаляем пробелы на кончах файла
fclose($address);       // закрываем файл

$Name = fopen('nameFile', 'a+'); //открываем файл "addressName", в котором будут храниться  именя файлов загруженных на сервер
trim(fwrite($Name, $nameVar. " "));       //записываем имена в файл черех пробел и удаляем пробелы на кончах файла
fclose($Name);       // закрываем файл




$upload = move_uploaded_file($json['tmp_name'], $filename); //загружаем файл на сервер


if (file_exists($filename)) {       //проверяем файл на наличие на сервере
    echo 'Тест успешно загружен';
} else {
    echo 'К сожалению, произошла ошибка, загрузите файл повторно';

}


if (isset($_POST['submit']) && empty($_FILES['uploadFile'])) {
    header("Location: http://university.netology.ru/u/smetanin/me7/list.php");
}

