<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Autopark</title>
</head>
<body>
    <div class="menu">
        <form action="handler.php" method = "POST" target = "_blank">
            Пока
            <p>Введите код автобуса:</p>
            <input type="text" name = "CodeBus">

            <p>Марка автобуса:</p>
            <input type="text" name = "BrandBus">

            <p>Модель автобуса</p>
            <input type="text" name = "ModelBus">

            <p>Количество мест</p>
            <input type="text" name = "NumbSeats">

            <button name = "send" target="_blank">Добавить</button>
            <button>Удалить</button>
        </form>
    </div>
    <?php
        require_once 'connection.php';
		$link = mysqli_connect($host, $user, $password, $database)
			or die("Ошибка" . mysqli_error($link));
$sql = mysqli_query($link, 'SELECT `Код автобуса`, `Марка автобуса`, `Модель автобуса`, `Количество мест` FROM `Типы автобусов`');
    echo '<table>';
    while($result = mysqli_fetch_array($sql)){
        //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
        echo "<tr><td>{$result['Код автобуса']}</td><td>{$result['Марка автобуса']}</td><td>{$result['Модель автобуса']}</td><td>{$result['Количество мест']}</td></tr>";
    }
    echo '</table>';
mysqli_close($link);
    ?>
</body>
</html>