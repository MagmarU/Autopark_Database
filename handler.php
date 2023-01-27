<?php
    require_once 'connection.php';

    if( $_POST['action'] == 'add' ) {
        
        $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка" . mysqli_error($link));

        $sqlRequest = "INSERT INTO `".$_POST['name']."` (" .$_POST['fieldsName'] . ") VALUES(".$_POST['values']. ")";
        $result = mysqli_query($link, $sqlRequest) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            echo "Данные добавлены";
        }

        mysqli_close($link);
    } elseif( $_POST['action'] == 'delete' ) {
        $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка " . mysqli_error($link));


        $delete = "DELETE FROM `".$_POST['name']."` Where `".$_POST['primaryKey']."` = '".$_POST['valuePk']."'";
        $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
        if ($result) {
            echo "Данные обновлены";
        }
        mysqli_close($link);
    } elseif( $_GET['action'] == 'showTable' ) {
        $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка " . mysqli_error($link));

        $table = "SELECT * FROM `".$_GET['name']."`";
        $res = mysqli_query( $link, $table ) or die("Ошибка " . mysqli_error($link));

        while( $rows = mysqli_fetch_row($res) ) {
            echo "<tr>";
            foreach( $rows as $row ) {
                echo "<td>$row</td>";
            }
            echo "</tr>";
        }
    }
    
?>
