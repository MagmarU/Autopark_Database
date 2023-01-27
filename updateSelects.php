<?php
    require_once 'connection.php';
    $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));

    $sql = mysqli_query($link, "SELECT `".$_GET['foreignKey']."` FROM `".$_GET['keyLink']."`");
    while ($result = mysqli_fetch_array($sql)) {
        echo "<option>{$result[$_GET['foreignKey']]}</option>";
    }
    mysqli_close($link);
?>