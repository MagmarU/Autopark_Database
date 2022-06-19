<?php

require_once 'connection.php';
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка" . mysqli_error($link));
    
$query = "Select * from `Типы автобусов`";
$result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));

if($result)
{
    echo "Выполнение запроса прошло успешно";
}

mysqli_close($link);
?>