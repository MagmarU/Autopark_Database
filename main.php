<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Autopark</title>
</head>

<body>


    <!-- Типы автобусов -->
    <section>
        <input type="checkbox" id="Type_Bus" class="hide"/>	
        <label for="Type_Bus">Типы автобусов</label>
        <div class="Type_Bus_Container">
                <div class="menu">
                    <form action="" method="POST">
                        <div class="style_input">
                            <input type="text" name="CodeBus" placeholder="Код автобуса">
                            <input type="text" name="BrandBus" placeholder="Марка автобуса">
                            <input type="text" name="ModelBus" placeholder="Модель автобуса">
                            <input type="text" name="NumbSeats" placeholder="Количество мест">
                        </div>
                        <button name="send" value="Добавить">Добавить</button>
                        <button name="send" value="Удалить">Удалить</button>
                    </form>
                </div>
                <div class="Handler_php">

                    <?php
                    // Добавление данных в таблицу "Типы автобусов"
                    require_once 'connection.php';
                    if(isset($_POST["send"])){
                        $action = $_POST['send'];
                        switch ($action) {
                            case 'Добавить':
                                if (isset($_POST['CodeBus']) && isset($_POST['BrandBus']) && isset($_POST['ModelBus']) && isset($_POST['NumbSeats'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка" . mysqli_error($link));

                                    $CodeBus = htmlentities(mysqli_real_escape_string($link, $_POST['CodeBus']));
                                    $BrandBus = htmlentities(mysqli_real_escape_string($link, $_POST['BrandBus']));
                                    $ModelBus = htmlentities(mysqli_real_escape_string($link, $_POST['ModelBus']));
                                    $NumbSeats = htmlentities(mysqli_real_escape_string($link, $_POST['NumbSeats']));

                                    $query = "INSERT INTO `Типы автобусов`(`Код автобуса`, `Марка автобуса`, `Модель автобуса`, `Количество мест`) VALUES('$CodeBus' , '$BrandBus','$ModelBus','$NumbSeats')";

                                    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                                    if ($result) {
                                        echo "Данные добавлены";
                                    }
                                    mysqli_close($link);
                                }
                                else {
                                    die();
                                }
                                break;
                                //------------------------------------------------------------------------

                            case 'Удалить':
                                // Удаление данных из таблицы "Типы автобусов" по первичному ключу
                                if (isset($_POST['CodeBus'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка " . mysqli_error($link));


                                    $CodeBus = htmlentities(mysqli_real_escape_string($link, $_POST['CodeBus']));

                                    $delete = "DELETE FROM `Типы автобусов` Where `Код автобуса` = '$CodeBus'";

                                    $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
                                    if ($result) {
                                        echo "<span style='color:blue;'>Были внесены изменения</span>";
                                    }
                                    // закрываем подключение
                                    mysqli_close($link);
                                }
                                break;
                        }
                    }
                    //-----------------------------------------------------------------------

                    // Вывод данных из таблицы при обновлении страницы
                    require_once 'connection.php';
                    $link = mysqli_connect($host, $user, $password, $database)
                        or die();
                    $sql = mysqli_query($link, 'SELECT `Код автобуса`, `Марка автобуса`, `Модель автобуса`, `Количество мест` FROM `Типы автобусов`');
                    echo '<table>';
                    echo '<tr>  <td>Код автобуса</td> <td>Марка автобуса</td> <td>Модель автобуса</td> <td>Количество мест</td> </tr>';
                    while ($result = mysqli_fetch_array($sql)) {
                        //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
                        echo "<tr><td>{$result['Код автобуса']}</td><td>{$result['Марка автобуса']}</td><td>{$result['Модель автобуса']}</td><td>{$result['Количество мест']}</td></tr>";
                    }
                    echo '</table>';
                    mysqli_close($link);
                    //---------------------------------------------------------------------------

                    ?>

                </div>
        </div>
    </section>
    <!-- ------------------- -->

    <!-- Парк -->
    <section>
        <input type="checkbox" id="Park" class="hide">
        <label for="Park">Парк</label>
        <div class="Park_Container">
            <div class="menu"> 
                <form action="" method="Post">
                    <div class="style_input">
                        <input type="text" name="GarageNumber" placeholder="Гаражный номер">
                        <p>Код автобуса:</p>
                        <div class="CodeBus_Col">
                            <select class = "select-css" name="CodeBus_Key" id="">
                                <?php
                                require_once 'connection.php';
                                $link = mysqli_connect($host, $user, $password, $database)
                                    or die("Ошибка " . mysqli_error($link));
                                $sql = mysqli_query($link, 'SELECT `Код автобуса` FROM `Типы автобусов`');
                                while ($result = mysqli_fetch_array($sql)) {
                                    echo "<option>{$result['Код автобуса']}</option>";
                                }
                                mysqli_close($link);
                                ?>
                            </select>
                        </div>
                        <input type="text" name="StateNumber" placeholder="Гос.номер">
                        <input type="text" name="YearRelease" placeholder="Год выпуска">
                    </div>
                    <button name="SendInSecondTable" value="Добавить">Добавить</button>
                    <button name="SendInSecondTable" value="Удалить">Удалить</button>
                </form>
            </div>   
            <div class="Handler_Second_Table_php">
                    <!-- Добавление данных в таблицу "Парк" -->
                    <?php
                    require_once 'connection.php';
                    if(isset($_POST["SendInSecondTable"])){
                        $action = $_POST["SendInSecondTable"];
                        switch ($action) {
                            case 'Добавить':
                                if (isset($_POST['GarageNumber']) && isset($_POST['CodeBus_Key']) && isset($_POST['StateNumber']) && isset($_POST['YearRelease'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка" . mysqli_error($link));

                                    $GarageNumber = htmlentities(mysqli_real_escape_string($link, $_POST['GarageNumber']));
                                    $CodeBus_Key = htmlentities(mysqli_real_escape_string($link, $_POST['CodeBus_Key']));
                                    $StateNumber = htmlentities(mysqli_real_escape_string($link, $_POST['StateNumber']));
                                    $YearRelease = htmlentities(mysqli_real_escape_string($link, $_POST['YearRelease']));

                                    $query = "INSERT INTO `Парк` (`Гаражный номер`, `Код автобуса`, `Гос.Номер`, `Год выпуска`) VALUES('$GarageNumber' , '$CodeBus_Key','$StateNumber','$YearRelease')";

                                    $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
                                    if ($result) {
                                        echo "Данные добавлены";
                                    }
                                    mysqli_close($link);
                                }
                                break;
                                //------------------------------------------------------------------------

                                // Удаление данных из "Парк" по первичному ключу "Гаражный номер"
                            case 'Удалить':
                                if (isset($_POST['GarageNumber'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка " . mysqli_error($link));
                                    $GarageNumber = htmlentities(mysqli_real_escape_string($link, $_POST['GarageNumber']));

                                    $delete = "DELETE FROM `Парк` Where `Гаражный номер` = '$GarageNumber'";

                                    $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
                                    if ($result) {
                                        echo "<span style='color:blue;'>Были внесены изменения</span>";
                                    }
                                    // закрываем подключение
                                    mysqli_close($link);
                                }
                                break;
                                // -------------------------------------------------------------------------------------
                        }
                    }


                    // Вывод данных из таблицы при перезагрузке страницы
                    require_once 'connection.php';
                    $link = mysqli_connect($host, $user, $password, $database)
                        or die("Ошибка" . mysqli_error($link));
                    $sql = mysqli_query($link, 'SELECT `Гаражный номер`, `Код автобуса`, `Гос.номер`, `Год выпуска` FROM `Парк`');
                    echo '<table>';
                    echo '<tr> <td>Гаражный номер</td> <td>Код автобуса</td> <td>Гос.номер</td> <td>Год выпуска</td></tr>';
                    while ($result = mysqli_fetch_array($sql)) {
                        //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
                        echo "<tr><td>{$result['Гаражный номер']}</td><td>{$result['Код автобуса']}</td><td>{$result['Гос.номер']}</td><td>{$result['Год выпуска']}</td></tr>";
                    }
                    echo '</table>';
                    mysqli_close($link);
                    // -------------------------------------------------------------------------------------------
                    ?>
            </div>
        </div>
    </section>
    <!-- ---------------- -->

    <!-- Маршрутный лист -->
    <section>
        <input type="checkbox" id="Маршрутный_лист" class="hide">
        <label for="Маршрутный_лист">Маршрутный лист</label>
        <div class="Маршрутный_лист">
            <div class="menu">
                <form action = "" method = "post">
                    <div class="style_input">
                        <input type="text" name = "Route_Number" placeholder="Номер маршрута">
                        <p>Количество промежуточных остановок на маршруте:</p>
                        <input type="text" name = "Intermediate_Stops">
                        <p>Продолжительность простоя на одной остановке:</p>
                        <input type="text" name = "Downtime_duration">
                        <p>Время прохождения маршрута, мин:</p>
                        <input type="text" name = "Time_of_route">
                        <input type="text" name="Fare" placeholder="Стоимость проезда">
                    </div>

                    <button name = "SendInFifthTable" value="Добавить">Добавить</button>
                    <button name="SendInFifthTable" value="Удалить">Удалить</button>
                </form>
            </div>
            <div class="handler_fifth_table_php">
                <?php
                    require_once 'connection.php';
                    if(isset($_POST["SendInFifthTable"])){
                        $action = $_POST["SendInFifthTable"];
                        switch ($action) {
                                // Добавление данных в таблицу "Тех.талоны"
                            case 'Добавить':
                                if (isset($_POST['Route_Number']) && isset($_POST['Intermediate_Stops']) && isset($_POST['Downtime_duration']) && isset($_POST['Time_of_route']) && isset($_POST['Fare'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка" . mysqli_error($link));

                                    $Route_Number = htmlentities(mysqli_real_escape_string($link, $_POST['Route_Number']));
                                    $Intermediate_Stops = htmlentities(mysqli_real_escape_string($link, $_POST['Intermediate_Stops']));
                                    $Downtime_duration = htmlentities(mysqli_real_escape_string($link, $_POST['Downtime_duration']));
                                    $Time_of_route = htmlentities(mysqli_real_escape_string($link, $_POST['Time_of_route']));
                                    $Fare = htmlentities(mysqli_real_escape_string($link, $_POST['Fare']));

                                    $query = "INSERT INTO `Маршрутный лист` (`Номер маршрута`, `Количество промежуточных остановок на маршруте`, `Продолжительсноть простоя на одной остановке, мин.`, `Время прохождения маршрута, мин.`, `Стоимость проезда, руб.`) VALUES('$Route_Number' , '$Intermediate_Stops','$Downtime_duration','$Time_of_route', '$Fare')";

                                    $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
                                    if ($result) {
                                        echo "Данные добавлены";
                                    }
                                    mysqli_close($link);
                                }

                                // ------------------------------------------------------------------------------------------
                                break;
                            case 'Удалить':
                                // Удаление данных из таблицы по первичному ключу "Номер тех.талона"
                                if (isset($_POST['Route_Number'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка " . mysqli_error($link));
                                    $Route_Number = htmlentities(mysqli_real_escape_string($link, $_POST['Route_Number']));

                                    $delete = "DELETE FROM `Маршрутный лист` Where `Номер маршрута` = '$Route_Number'";

                                    $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
                                    if ($result) {
                                        echo "<span style='color:blue;'>Были внесены изменения</span>";
                                    }
                                    // закрываем подключение
                                    mysqli_close($link);
                                }
                                // -------------------------------------------------------------------------------- 
                                break;
                        }
                    }
                    // Вывод данных из таблицы при перезагрузке страницы
                    require_once 'connection.php';
                    $link = mysqli_connect($host, $user, $password, $database)
                        or die("Ошибка" . mysqli_error($link));
                    $sql = mysqli_query($link, 'SELECT `Номер маршрута`, `Количество промежуточных остановок на маршруте`, `Продолжительсноть простоя на одной остановке, мин.`, `Время прохождения маршрута, мин.`, `Стоимость проезда, руб.` FROM `Маршрутный лист`');
                    echo '<table>';
                    echo '<tr> <td>Номер маршрута</td> <td>Количество промежуточных остановок</td> <td>Продолжительсноть простоя на остановке</td> <td>Время прохождения маршрута, мин.</td> <td>Стоимость проезда, руб.</td> </tr>';
                    while ($result = mysqli_fetch_array($sql)) {
                        //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
                        echo "<tr><td>{$result['Номер маршрута']}</td><td>{$result['Количество промежуточных остановок на маршруте']}</td><td>{$result['Продолжительсноть простоя на одной остановке, мин.']}</td><td>{$result['Время прохождения маршрута, мин.']}</td><td>{$result['Стоимость проезда, руб.']}</td></tr>";
                    }
                    echo '</table>';
                    mysqli_close($link);
                    // -------------------------------------------------------------------------------------------


                ?>
            </div>
        </div>
    
    </section>
    <!-- ------------- -->

    <!-- Водители -->
    <section>
        <input type="checkbox" id="Водители" class="hide">
        <label for="Водители">Водители</label>
        <div class="Водители">
            <div class="menu">
                <form action="" method="post">
                    <div class="style_input">
                        <input type="text" name="Rep_Card_Number_Driver" placeholder="Таб.ном водителя">
                        <input type="text" name="FIO" placeholder="Ф.И.О">
                        <input type="date" name="Date_Birth" placeholder="Дата рождения">
                        <input type="text" name="Salary" placeholder="Оклад">
                        <input type="text" name="Work_Exp" placeholder="Стаж работы">
                        <p>Номер маршрута:</p>
                        <div class="Route_Number_Col">
                            <select class = "select-css" name="Route_Number_Key" id="">
                                <?php
                                require_once 'connection.php';
                                $link = mysqli_connect($host, $user, $password, $database)
                                    or die("Ошибка " . mysqli_error($link));
                                $sql = mysqli_query($link, 'SELECT `Номер маршрута` FROM `Маршрутный лист`');
                                while ($result = mysqli_fetch_array($sql)) {
                                    echo "<option>{$result['Номер маршрута']}</option>";
                                }
                                mysqli_close($link);
                                ?>
                            </select>
                        </div>
                    </div>
                    <button name="SendInThirtyTable" value="Добавить">Добавить</button>
                    <button name="SendInThirtyTable" value="Удалить">Удалить</button>
                </form>
            </div>
            <div class="handler_thirty_table_php">
                <?php
                require_once 'connection.php';
                if(isset($_POST["SendInThirtyTable"])){
                    $action = $_POST["SendInThirtyTable"];
                    switch ($action) {
                            // Добавление данных в таблицу "Водители"
                        case 'Добавить':
                            if (isset($_POST['Rep_Card_Number_Driver']) && isset($_POST['FIO']) && isset($_POST['Date_Birth']) && isset($_POST['Salary']) && isset($_POST['Work_Exp']) && isset($_POST['Route_Number_Key'])) {
                                $link = mysqli_connect($host, $user, $password, $database)
                                    or die("Ошибка" . mysqli_error($link));

                                $Rep_Card_Number_Driver = htmlentities(mysqli_real_escape_string($link, $_POST['Rep_Card_Number_Driver']));
                                $FIO = htmlentities(mysqli_real_escape_string($link, $_POST['FIO']));
                                $Date_Birth = htmlentities(mysqli_real_escape_string($link, $_POST['Date_Birth']));
                                $Salary = htmlentities(mysqli_real_escape_string($link, $_POST['Salary']));
                                $Work_Exp = htmlentities(mysqli_real_escape_string($link, $_POST['Work_Exp']));
                                $Route_Number_Key = htmlentities(mysqli_real_escape_string($link, $_POST['Route_Number_Key']));

                                $query = "INSERT INTO `Водители` (`Табельный номер водителя`, `Ф.И.О`, `Дата рождения`, `Оклад, руб.`, `Стаж работы, лет.`, `Номер маршрута`) VALUES('$Rep_Card_Number_Driver' , '$FIO','$Date_Birth','$Salary', '$Work_Exp', '$Route_Number_Key')";

                                $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
                                if ($result) {
                                    echo "Данные добавлены";
                                }
                                mysqli_close($link);
                            }

                            // ------------------------------------------------------------------------------------------
                            break;
                        case 'Удалить':
                            // Удаление данных из таблицы по первичному ключу "Таб.ном водителя"
                            if (isset($_POST['Rep_Card_Number_Driver'])) {
                                $link = mysqli_connect($host, $user, $password, $database)
                                    or die("Ошибка " . mysqli_error($link));
                                $Rep_Card_Number_Driver = htmlentities(mysqli_real_escape_string($link, $_POST['Rep_Card_Number_Driver']));

                                $delete = "DELETE FROM `Водители` Where `Табельный номер водителя` = '$Rep_Card_Number_Driver'";

                                $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
                                if ($result) {
                                    echo "<span style='color:blue;'>Были внесены изменения</span>";
                                }
                                // закрываем подключение
                                mysqli_close($link);
                            }
                            // -------------------------------------------------------------------------------- 
                            break;
                    }
                }
                // Вывод данных из таблицы при перезагрузке страницы
                require_once 'connection.php';
                $link = mysqli_connect($host, $user, $password, $database)
                    or die("Ошибка" . mysqli_error($link));
                $sql = mysqli_query($link, 'SELECT `Табельный номер водителя`, `Ф.И.О`, `Дата рождения`, `Оклад, руб.`, `Стаж работы, лет.`, `Номер маршрута` FROM `Водители`');
                echo '<table>';
                echo '<tr> <td>Табельный номер водителя</td> <td>Ф.И.О</td> <td>Дата рождения</td> <td>Оклад, руб.</td> <td>Стаж работы, лет.</td> <td>Номер маршрута</td>     </tr>';
                while ($result = mysqli_fetch_array($sql)) {
                    //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
                    echo "<tr><td>{$result['Табельный номер водителя']}</td><td>{$result['Ф.И.О']}</td><td>{$result['Дата рождения']}</td><td>{$result['Оклад, руб.']}</td><td>{$result['Стаж работы, лет.']}</td><td>{$result['Номер маршрута']}</td> </tr>";
                }
                echo '</table>';
                mysqli_close($link);
                // -------------------------------------------------------------------------------------------


                ?>
            </div>
        </div>
    </section>
    <!-- ----------- -->
    
    <!-- Тех.талоны -->
    <section>
        <input type="checkbox" id="Тех.талоны" class="hide">
        <label for="Тех.талоны">Тех.талоны</label>
        <div class="Тех.талоны">
            <div class="menu">
                <form action="" method = "Post">
                    <div class="style_input">
                        <input type="text" name = "Number_tech_coupon" placeholder="Номер тех.талона">
                        <p>Код автобуса:</p>
                        <div class="CodeBus_Col">
                            <select class = "select-css" name="CodeBus_Key" id="">
                                <?php
                                require_once 'connection.php';
                                $link = mysqli_connect($host, $user, $password, $database)
                                    or die("Ошибка " . mysqli_error($link));
                                $sql = mysqli_query($link, 'SELECT `Код автобуса` FROM `Типы автобусов`');
                                while ($result = mysqli_fetch_array($sql)) {
                                    echo "<option>{$result['Код автобуса']}</option>";
                                }
                                mysqli_close($link);
                                ?>
                            </select>
                        </div>
                        <p>Дата прохождения ТО:</p>
                        <input type="date" name="Date_completion_tech_inspection">
                        <p>Дата следующего ТО:</p>
                        <input type="date" name = "Date_next_tech_inspection">
                        <input type="text" name = "FIO_tech_specialist" placeholder="Ф.И.О тех.эксперта">
                    </div>

                    <button name = "SendInFourthTable" value = "Добавить">Добавить</button>
                    <button name = "SendInFourthTable" value="Удалить">Удалить</button>
                </form>
            </div>
            <div class="handler_fourth_table_php">
                <?php
                    require_once 'connection.php';
                    if(isset($_POST["SendInFourthTable"])){
                        $action = $_POST["SendInFourthTable"];
                        switch ($action) {
                                // Добавление данных в таблицу "Тех.талоны"
                            case 'Добавить':
                                if (isset($_POST['Number_tech_coupon']) && isset($_POST['CodeBus_Key']) && isset($_POST['Date_completion_tech_inspection']) && isset($_POST['Date_next_tech_inspection']) && isset($_POST['FIO_tech_specialist'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка" . mysqli_error($link));

                                    $Number_tech_coupon = htmlentities(mysqli_real_escape_string($link, $_POST['Number_tech_coupon']));
                                    $CodeBus_Key = htmlentities(mysqli_real_escape_string($link, $_POST['CodeBus_Key']));
                                    $Date_completion_tech_inspection = htmlentities(mysqli_real_escape_string($link, $_POST['Date_completion_tech_inspection']));
                                    $Date_next_tech_inspection = htmlentities(mysqli_real_escape_string($link, $_POST['Date_next_tech_inspection']));
                                    $FIO_tech_specialist = htmlentities(mysqli_real_escape_string($link, $_POST['FIO_tech_specialist']));

                                    $query = "INSERT INTO `Тех.талоны` (`Номер тех.талона`, `Код автобуса`, `Дата прохождения ТО`, `Дата следующего ТО`, `Ф.И.О Тех.эксперта`) VALUES('$Number_tech_coupon' , '$CodeBus_Key','$Date_completion_tech_inspection','$Date_next_tech_inspection', '$FIO_tech_specialist')";

                                    $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
                                    if ($result) {
                                        echo "Данные добавлены";
                                    }
                                    mysqli_close($link);
                                }

                                // ------------------------------------------------------------------------------------------
                                break;
                            case 'Удалить':
                                // Удаление данных из таблицы по первичному ключу "Номер тех.талона"
                                if (isset($_POST['Number_tech_coupon'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка " . mysqli_error($link));
                                    $Number_tech_coupon = htmlentities(mysqli_real_escape_string($link, $_POST['Number_tech_coupon']));

                                    $delete = "DELETE FROM `Тех.талоны` Where `Номер тех.талона` = '$Number_tech_coupon'";

                                    $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
                                    if ($result) {
                                        echo "<span style='color:blue;'>Были внесены изменения</span>";
                                    }
                                    // закрываем подключение
                                    mysqli_close($link);
                                }
                                // -------------------------------------------------------------------------------- 
                                break;
                        }
                    }
                    // Вывод данных из таблицы при перезагрузке страницы
                    require_once 'connection.php';
                    $link = mysqli_connect($host, $user, $password, $database)
                        or die("Ошибка" . mysqli_error($link));
                    $sql = mysqli_query($link, 'SELECT `Номер тех.талона`, `Код автобуса`, `Дата прохождения ТО`, `Дата следующего ТО`, `Ф.И.О Тех.эксперта` FROM `Тех.талоны`');
                    echo '<table>';
                    echo '<tr> <td>Номер тех.талона</td>  <td>Код автобуса</td> <td>Дата прохождения ТО</td> <td>Дата следующего ТО</td> <td>Ф.И.О Тех.эксперта</td></tr>';
                    while ($result = mysqli_fetch_array($sql)) {
                        //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
                        echo "<tr><td>{$result['Номер тех.талона']}</td><td>{$result['Код автобуса']}</td><td>{$result['Дата прохождения ТО']}</td><td>{$result['Дата следующего ТО']}</td><td>{$result['Ф.И.О Тех.эксперта']}</td></tr>";
                    }
                    echo '</table>';
                    mysqli_close($link);
                    // -------------------------------------------------------------------------------------------


                ?>
            </div>
        </div>
    </section>
    <!-- ------------------ -->

    

    <!-- Путевой лист -->
    <section>
        <input type="checkbox" id="Путевой_лист" class="hide">
        <label for="Путевой_лист">Путевой лист</label>
        <div class="Путевой_лист">
            <div class="menu">
                <form action="" method = "POST"> 
                    <div class="style_input">
                        <input type="text" name="ID" placeholder="ID">
                        <p>Код автобуса:</p>
                        <div class="CodeBus2_Col">
                            <select class = "select-css" name="CodeBus2_Key" id="">
                                <?php
                                require_once 'connection.php';
                                $link = mysqli_connect($host, $user, $password, $database)
                                    or die("Ошибка " . mysqli_error($link));
                                $sql = mysqli_query($link, 'SELECT `Код автобуса` FROM `Типы автобусов`');
                                while ($result = mysqli_fetch_array($sql)) {
                                    echo "<option>{$result['Код автобуса']}</option>";
                                }
                                mysqli_close($link);
                                ?>
                            </select>
                        </div>
                        <p>Табельный номер водителя</p>
                        <div class="Tab_numb_Col">
                            <select class = "select-css" name="Tab_numb_Key" id="">
                                <?php
                                require_once 'connection.php';
                                $link = mysqli_connect($host, $user, $password, $database)
                                    or die("Ошибка " . mysqli_error($link));
                                $sql = mysqli_query($link, 'SELECT `Табельный номер водителя` FROM `Водители`');
                                while ($result = mysqli_fetch_array($sql)) {
                                    echo "<option>{$result['Табельный номер водителя']}</option>";
                                }
                                mysqli_close($link);
                                ?>
                            </select>
                        </div>
                        <p>Номер маршрута:</p>
                        <div class="Route_numb_Col">
                            <select class = "select-css" name="Route_numb_Key" id="">
                                <?php
                                require_once 'connection.php';
                                $link = mysqli_connect($host, $user, $password, $database)
                                    or die("Ошибка " . mysqli_error($link));
                                $sql = mysqli_query($link, 'SELECT `Номер маршрута` FROM `Маршрутный лист`');
                                while ($result = mysqli_fetch_array($sql)) {
                                    echo "<option>{$result['Номер маршрута']}</option>";
                                }
                                mysqli_close($link);
                                ?>
                            </select>
                        </div>
                        <p>Дата</p>
                        <input type="date" name="Date_1">
                        <p>Время выхода автобуса на маршрут</p>
                        <input type="time" name="Date_2">
                        <p>Время прибытия автобуса с маршрута</p>
                        <input type="time" name="Date_3">
                        <input type="text" name="fuel" placeholder="Топливо при выезде, л.">
                        <input type="text" name="fuel_1" placeholder="Топливо при возврате, л.">
                        <input type="text" name="reason_desc" placeholder="Причина схода автобуса">
                        <input type="text" name="tickets_sold" placeholder="Кол-во проданных билетов">
                        <input type="text" name="revenue" placeholder="Выручка, руб.">
                    </div>
                    <button name="sendSixth" value="Добавить">Добавить</button>
                    <button name="sendSixth" value="Удалить">Удалить</button>
                </form>
            </div>
            <div class="handler_sixth">
                <?php
                    require_once 'connection.php';
                    // 
                    if(isset($_POST["sendSixth"])){
                        $action = $_POST["sendSixth"];
                        switch ($action) {
                                // Добавление данных в таблицу "Тех.талоны"
                            case 'Добавить':
                                if (isset($_POST['ID']) && isset($_POST['CodeBus2_Key']) && isset($_POST['Tab_numb_Key']) && isset($_POST['Route_numb_Key']) && isset($_POST['Date_1']) && isset($_POST['Date_2']) && isset($_POST['Date_3']) && isset($_POST['fuel']) && isset($_POST['fuel_1']) && isset($_POST['reason_desc']) && isset($_POST['tickets_sold']) && isset($_POST['revenue'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка" . mysqli_error($link));

                                    $ID = htmlentities(mysqli_real_escape_string($link, $_POST['ID']));
                                    $CodeBus2_Key = htmlentities(mysqli_real_escape_string($link, $_POST['CodeBus2_Key']));
                                    $Tab_numb_Key = htmlentities(mysqli_real_escape_string($link, $_POST['Tab_numb_Key']));
                                    $Route_numb_Key = htmlentities(mysqli_real_escape_string($link, $_POST['Route_numb_Key']));
                                    $Date_1 = htmlentities(mysqli_real_escape_string($link, $_POST['Date_1']));
                                    $Date_2 = htmlentities(mysqli_real_escape_string($link, $_POST['Date_2']));
                                    $Date_3 = htmlentities(mysqli_real_escape_string($link, $_POST['Date_3']));
                                    $fuel = htmlentities(mysqli_real_escape_string($link, $_POST['fuel']));
                                    $fuel_1 = htmlentities(mysqli_real_escape_string($link, $_POST['fuel_1']));
                                    $reason_desc = htmlentities(mysqli_real_escape_string($link, $_POST['reason_desc']));
                                    $tickets_sold = htmlentities(mysqli_real_escape_string($link, $_POST['tickets_sold']));
                                    $revenue = htmlentities(mysqli_real_escape_string($link, $_POST['revenue']));

                                    $query = "INSERT INTO `Путевой лист` (`ID`, `Код автобуса`, `Табельный номер водителя`, `Номер маршрута`, `Дата`, `Время выхода автобуса на маршрут`, `Время прибытия автобуса с маршрута`, `Топливо при выезде, л.`, `Топливо при возврате, л.`, `Причина схода автобуса с маршрута`, `Количество проданных билетов`, `Выручка, руб.`) VALUES('$ID' , '$CodeBus2_Key','$Tab_numb_Key','$Route_numb_Key', '$Date_1', '$Date_2', '$Date_3', '$fuel', '$fuel_1', '$reason_desc', '$tickets_sold', '$revenue')";

                                    $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
                                    if ($result) {
                                        echo "Данные добавлены";
                                    }
                                    mysqli_close($link);
                                }

                                // ------------------------------------------------------------------------------------------
                                break;
                            case 'Удалить':
                                // Удаление данных из таблицы по первичному ключу "Номер тех.талона"
                                if (isset($_POST['ID'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка " . mysqli_error($link));
                                    $ID = htmlentities(mysqli_real_escape_string($link, $_POST['ID']));

                                    $delete = "DELETE FROM `Путевой лист` Where `ID` = '$ID'";

                                    $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
                                    if ($result) {
                                        echo "<span style='color:blue;'>Были внесены изменения</span>";
                                    }
                                    // закрываем подключение
                                    mysqli_close($link);
                                }
                                // -------------------------------------------------------------------------------- 
                                break;
                        }
                    }
                    // Вывод данных из таблицы при перезагрузке страницы
                    require_once 'connection.php';
                    $link = mysqli_connect($host, $user, $password, $database)
                        or die("Ошибка" . mysqli_error($link));
                    $sql = mysqli_query($link, 'SELECT `ID`, `Код автобуса`, `Табельный номер водителя`, `Номер маршрута`, `Дата`, `Время выхода автобуса на маршрут`, `Время прибытия автобуса с маршрута`, `Топливо при выезде, л.`, `Топливо при возврате, л.`, `Причина схода автобуса с маршрута`, `Количество проданных билетов`, `Выручка, руб.` FROM `Путевой лист`');
                    echo '<table>';
                    echo '<tr> <td>ID</td> <td>Код автобуса</td> <td>Табельный номер водителя</td> <td>Номер маршрута</td> <td>Дата</td> <td>Время выхода автобуса на маршрут</td> <td>Время прибытия автобуса</td> <td>Топливо при выезде</td> <td>Топливо при возврате</td> <td>Причина схода автобуса</td> <td>Кол-во проданных билетов</td> <td>Выручка, руб.</td>   </tr>';
                    while ($result = mysqli_fetch_array($sql)) {
                        //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
                        echo "<tr><td>{$result['ID']}</td><td>{$result['Код автобуса']}</td><td>{$result['Табельный номер водителя']}</td><td>{$result['Номер маршрута']}</td><td>{$result['Дата']}</td>  <td>{$result['Время выхода автобуса на маршрут']}</td> <td>{$result['Время прибытия автобуса с маршрута']}</td> <td>{$result['Топливо при выезде, л.']}</td> <td>{$result['Топливо при возврате, л.']}</td> <td>{$result['Причина схода автобуса с маршрута']}</td> <td>{$result['Количество проданных билетов']}</td> <td>{$result['Выручка, руб.']}</td> </tr>";
                    }
                    echo '</table>';
                    mysqli_close($link);
                    // -------------------------------------------------------------------------------------------


                ?>
            </div>
        </div>
    </section>
    <!-- --------------- -->

    <!-- Статистика -->
    <section>
        <input type="checkbox" id="Статистика" class="hide">
        <label for="Статистика">Статус автобусов</label>
        <div class="Статистика">
            <div class="menu">
                <form action="" method="POST">
                    <div class="style_input">
                    <p>ID:</p>
                    <div class="ID_Col">
                        <select class = "select-css" name="ID_Key" id="">
                            <?php
                            require_once 'connection.php';
                            $link = mysqli_connect($host, $user, $password, $database)
                                or die("Ошибка " . mysqli_error($link));
                            $sql = mysqli_query($link, 'SELECT `ID` FROM `Статистика`');
                            while ($result = mysqli_fetch_array($sql)) {
                                echo "<option>{$result['ID']}</option>";
                            }
                            mysqli_close($link);
                            ?>
                        </select>
                    </div>
                    </div>
                    <button name="sendSeventh" value="Удалить">Удалить</button>
                </form>
            </div>
            <div class="handler_status">

                <?php
                    if(isset($_POST["sendSeventh"])){
                        $action = $_POST["sendSeventh"];
                        switch ($action) {
                            case 'Удалить':
                                if (isset($_POST['ID_key'])) {
                                    $link = mysqli_connect($host, $user, $password, $database)
                                        or die("Ошибка " . mysqli_error($link));
                                    $ID_key = htmlentities(mysqli_real_escape_string($link, $_POST['ID_key']));

                                    $delete = "DELETE FROM `Статистика` Where `ID` = '$ID_key'";

                                    $result = mysqli_query($link, $delete) or die("Ошибка " . mysqli_error($link));
                                    if ($result) {
                                        echo "<span style='color:blue;'>Были внесены изменения</span>";
                                    }
                                    // закрываем подключение
                                    mysqli_close($link);
                                }
                            break;
                        }
                    
                    }
                    // Вывод данных из таблицы при перезагрузке страницы
                    require_once 'connection.php';
                    $link = mysqli_connect($host, $user, $password, $database)
                        or die("Ошибка" . mysqli_error($link));
                    $sql = mysqli_query($link, 'SELECT `ID`, `Код автобуса`, `Табельный номер водителя`, `Статус` FROM `Статистика`');
                    echo '<table>';
                    echo '<tr> <td>ID</td> <td>Код автобуса</td> <td>Табельный номер водителя</td> <td>Статус</td></tr>';
                    while ($result = mysqli_fetch_array($sql)) {
                        //echo "{$result['Код автобуса']}, {$result['Марка автобуса']}, {$result['Модель автобуса']}, {$result['Количество мест']}<br>";
                        echo "<tr><td>{$result['ID']}</td><td>{$result['Код автобуса']}</td><td>{$result['Табельный номер водителя']}</td><td>{$result['Статус']}</td></tr>";
                    }
                    echo '</table>';
                    mysqli_close($link);
                    // -------------------------------------------------------------------------------------------
                ?>
            </div>
        </div>
    </section>
</body>

</html>