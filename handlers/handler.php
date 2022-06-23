<?php
    include 'main.php';
    $action2 = $_POST["Send"];
    switch ($action2) {
    case 'Добавить':
        if (isset($_POST['CodeBus']) && isset($_POST['BrandBus']) && isset($_POST['ModelBus']) && isset($_POST['NumbSeats'])) {
            $link = mysqli_connect($host, $user, $password, $database)
                or die("Ошибка" . mysqli_error($link));

            $CodeBus = htmlentities(mysqli_real_escape_string($link, $_POST['CodeBus']));
            $BrandBus = htmlentities(mysqli_real_escape_string($link, $_POST['BrandBus']));
            $ModelBus = htmlentities(mysqli_real_escape_string($link, $_POST['ModelBus']));
            $NumbSeats = htmlentities(mysqli_real_escape_string($link, $_POST['NumbSeats']));

            $query = "INSERT INTO `Типы автобусов`(`Код автобуса`, `Марка автобуса`, `Модель автобуса`, `Количество мест`) VALUES('$CodeBus' , '$BrandBus','$ModelBus','$NumbSeats')";

            $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
            if ($result) {
                echo "Данные добавлены";
            }
            mysqli_close($link);
        }
        break;
    case 'Удалить':
        echo "УДАЛИТЬ";
        break;
    }
?>