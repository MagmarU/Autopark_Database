<?php
require_once 'connection.php';
$action = $_POST['send'];
if(isset($_POST['CodeBus']) && isset($_POST['BrandBus']) && isset($_POST['ModelBus']) && isset($_POST['NumbSeats'])){
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка" . mysqli_error($link));

$CodeBus = htmlentities(mysqli_real_escape_string($link, $_POST['CodeBus']));
$BrandBus = htmlentities(mysqli_real_escape_string($link, $_POST['BrandBus']));
$ModelBus = htmlentities(mysqli_real_escape_string($link, $_POST['ModelBus']));
$NumbSeats = htmlentities(mysqli_real_escape_string($link, $_POST['NumbSeats']));

$query = "INSERT INTO `Типы автобусов`(`Код автобуса`, `Марка автобуса`, `Модель автобуса`, `Количество мест`) VALUES('$CodeBus' , '$BrandBus','$ModelBus','$NumbSeats')";

$result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
if($result)
{
    echo "Данные добавлены";
}
mysqli_close($link);
}



// require_once 'connection.php';
// 		$link = mysqli_connect($host, $user, $password, $database)
// 			or die("Ошибка" . mysqli_error($link));
// $sql = mysqli_query($link, 'SELECT `Код автобуса`, `Марка автобуса`, `Модель автобуса`, `Количество мест` FROM `Типы автобусов`');
//     echo '<table>';
//     while($result = mysqli_fetch_array($sql)){
//         //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
//         echo "<tr><td>{$result['Код автобуса']}</td><td>{$result['Марка автобуса']}</td><td>{$result['Модель автобуса']}</td><td>{$result['Количество мест']}</td></tr>";
//     }
//     echo '</table>';
// mysqli_close($link);