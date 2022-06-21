<?php
function Added(){
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
?>





<!--
    <div class="Путевой лист">
        <div class="menu">
            <form action="" method = "post">
                <p>ID:</p>
                <input type="text" name="ID">
                <p>Код автобуса</p>
                <div class="CodeBus_Col">
                    <select name="CodeBus_Key" id="">
                        <?php
                        // require_once 'connection.php';
                        // $link = mysqli_connect($host, $user, $password, $database)
                        //     or die("Ошибка " . mysqli_error($link));
                        // $sql = mysqli_query($link, 'SELECT `Код автобуса` FROM `Типы автобусов`');
                        // while ($result = mysqli_fetch_array($sql)) {
                        //     echo "<option>{$result['Код автобуса']}</option>";
                        // }
                        // mysqli_close($link);
                        ?>
                    </select>
                </div>
                <p>Таб.ном водителя</p>
                <div class="Rep_card_number_driver_Col">
                        <select name="Rep_card_number_driver_Col_Key" id="">
                            <?php
                            // require_once 'connection.php';
                            // $link = mysqli_connect($host, $user, $password, $database)
                            //     or die("Ошибка " . mysqli_error($link));
                            // $sql = mysqli_query($link, 'SELECT `Таб.номер водителя` FROM `Водители`');
                            // while ($result = mysqli_fetch_array($sql)) {
                            //     echo "<option>{$result['Таб.номер водителя']}</option>";
                            // }
                            // mysqli_close($link);
                            ?>
                        </select>
                    </div>
                <p>Номер маршрута:</p>
                <div class="Route_Number_Col">
                    <select name="Route_Number_Key" id="">
                        <?php
                        // require_once 'connection.php';
                        // $link = mysqli_connect($host, $user, $password, $database)
                        //     or die("Ошибка " . mysqli_error($link));                            
                        
                        // $sql = mysqli_query($link, 'SELECT `Номер маршрута` FROM `Маршрутный лист`');
                        // while ($result = mysqli_fetch_array($sql)) {
                        //     echo "<option>{$result['Номер маршрута']}</option>";
                        // }
                        // mysqli_close($link);
                        ?>
                    </select>
                </div>
                
                <p>Дата:</p>
                <input type="date" name="Date">
                <p>Время выхода автобуса на маршрут:</p>
                <input type="time" name="Derture_time">
                <p>Время прибытия автобуса с маршрута:</p>
                <input type="time" name="Arrival_time">
                <p>Топливо при выезде:</p>
                <input type="text" name="Fuel_departure">
                <p>Топливо при возврате:</p>
                <input type="text" name="Fuel_arrival">
                <p>Причина схода автобуса с маршрута:</p>
                <input type="text" name="Route_reason">
                <p>Количество проданных билетов:</p>
                <input type="text" name="Tickets_sold">
                <p>Выручка:</p>
                <input type="text" name="Revenue">


                <button name="SendInSixthTable" value="Добавить">Добавить</button>
                <button name="SendInSixthTable" value="Удалить">Удалить</button>

            </form>
        </div>
        <div class="handler_sixth_table_php">
            <?php
                // require_once 'connection.php';
                // $action2 = $_POST["SendInSixthTable"];
                // switch ($action2) {
                //         // Добавление данных в таблицу "Тех.талоны"
                //     case 'Добавить':
                //         if ( isset($_POST['ID']) && isset($_POST['CodeBus_Key']) && isset($_POST['Rep_card_number_driver_Col_Key']) && isset($_POST['Route_Number_Key']) && isset($_POST['Date']) && isset($_POST['Derture_time']) && isset($_POST['Arrival_time']) && isset($_POST['Fuel_departure']) && isset($_POST['Fuel_arrival']) && isset($_POST['Route_reason']) && isset($_POST['Tickets_sold']) && isset($_POST['Revenue']) ) {
                //             $link = mysqli_connect($host, $user, $password, $database)
                //                 or die("Ошибка" . mysqli_error($link));

                //             $ID = htmlentities(mysqli_real_escape_string($link, $_POST['ID']));
                //             $CodeBus_Key = htmlentities(mysqli_real_escape_string($link, $_POST['CodeBus_Key']));
                //             $Rep_Card_Number_Driver_Key = htmlentities(mysqli_real_escape_string($link, $_POST['Rep_Card_Number_Driver_Key']));
                //             $Route_Number_Key = htmlentities(mysqli_real_escape_string($link, $_POST['Route_Number_Key']));
                //             $Date = htmlentities(mysqli_real_escape_string($link, $_POST['Date']));
                //             $Derture_time = htmlentities(mysqli_real_escape_string($link, $_POST['Derture_time']));
                //             $Arrival_time = htmlentities(mysqli_real_escape_string($link, $_POST['Arrival_time']));
                //             $Fuel_departure = htmlentities(mysqli_real_escape_string($link, $_POST['Fuel_departure']));
                //             $Fuel_arrival = htmlentities(mysqli_real_escape_string($link, $_POST['Fuel_arrival']));
                //             $Route_reason = htmlentities(mysqli_real_escape_string($link, $_POST['Route_reason']));
                //             $Tickets_sold = htmlentities(mysqli_real_escape_string($link, $_POST['Tickets_sold']));
                //             $Revenue = htmlentities(mysqli_real_escape_string($link, $_POST['Revenue']));

                //             $query = "INSERT INTO `Путевой лист` (`ID`, `Код автобуса`, `Таб.номер водителя`, `Номер маршрута`, `Дата`, `Время выхода автобуса на маршрут`, `Время прибытия автобуса с маршрута`, `Топливо при выезде, л.`, `Топливо при возврате, л.`, `Причина схода автобуса с маршрута`, `Количество проданных билетов`, `Выручка, руб.`) VALUES('$ID', '$CodeBus_Key', '$Rep_Card_Number_Driver_Key', '$Route_Number_Key', '$Date' , '$Derture_time','$Arrival_time','$Fuel_departure', '$Fuel_arrival', '$Route_reason', '$Tickets_sold', '$Revenue')";

                //             $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
                //             if ($result) {
                //                 echo "Данные добавлены";
                //             }
                //             mysqli_close($link);
                //         }

                //         // ------------------------------------------------------------------------------------------
                //         break;
                //     case 'Удалить':
                //         // Удаление данных из таблицы по первичному ключу "Номер тех.талона"
                //         if (isset($_POST['ID'])) {
                //             $link = mysqli_connect($host, $user, $password, $database)
                //                 or die("Ошибка " . mysqli_error($link));
                //             $ID = htmlentities(mysqli_real_escape_string($link, $_POST['ID']));

                //             $delete = "DELETE FROM `Путевой лист` Where `ID` = '$ID'";

                //             $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
                //             if ($result) {
                //                 echo "<span style='color:blue;'>Были внесены изменения</span>";
                //             }
                //             // закрываем подключение
                //             mysqli_close($link);
                //         }
                //         // -------------------------------------------------------------------------------- 
                //         break;
                // }

                // // Вывод данных из таблицы при перезагрузке страницы
                // require_once 'connection.php';
                // $link = mysqli_connect($host, $user, $password, $database)
                //     or die("Ошибка" . mysqli_error($link));
                // $sql = mysqli_query($link, 'SELECT `ID`, `Код автобуса`, `Таб.номер водителя`, `Номер маршрута`, `Дата`, `Время выхода автобуса на маршрут`, `Время прибытия автобуса с маршрута`, `Топливо при выезде, л.`, `Топливо при возврате, л.`, `Причина схода автобуса с маршрута`, `Количество проданных билетов`, `Выручка, руб.` FROM `путевой лист`');
                // echo '<table>';
                // while ($result = mysqli_fetch_array($sql)) {
                //     //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
                //     echo "<tr><td>{$result['ID']}</td><td>{$result['Код автобуса']}</td><td>{$result['Таб.номер водителя']}</td><td>{$result['Номер маршрута']}</td><td>{$result['Дата']}</td>  <td>{$result['Время выхода автобуса на маршрут']}</td> <td>{$result['Время прибытия автобуса с маршрута']}</td>  <td>{$result['Топливо при выезде, л.']}</td>  <td>{$result['Топливо при возврате, л.']}</td>  <td>{$result['Причина схода автобуса с маршрута']}</td>  <td>{$result['Количество проданных билетов']}</td>  <td>{$result['Выручка, руб.']}</td> </tr>";
                // }
                // echo '</table>';
                // mysqli_close($link);
                // -------------------------------------------------------------------------------------------


            ?>
        </div>
    </div>


            -->