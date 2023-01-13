<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
    <title>Autopark</title>
</head>

<body>


    <!-- Типы автобусов -->
    <section>
        <input type="checkbox" id="Type_Bus" class="hide"/>	
        <label for="Type_Bus">Типы автобусов</label>
        <div class="Type_Bus_Container">
            <div class="menu">
                <form action="" method="POST" name = 'Типы автобусов'>
                    <div class="style_input">
                        <input type="text" name="Код автобуса" placeholder="Код автобуса" required>
                        <input type="text" name=" " placeholder="Марка автобуса">
                        <input type="text" name=" " placeholder="Модель автобуса">
                        <input type="text" name=" " placeholder="Количество мест">
                    </div>
                    <button name="add" type="submit" value="Добавить">Добавить</button>
                    <button name="delete" type="submit" value="Удалить">Удалить</button>
                </form>
            </div>
            <div id = "table"><table></table></div>
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
                <form action="" method="POST" name = "Парк">
                    <div class="style_input">
                        <input type="text" name="Гаражный номер" placeholder="Гаражный номер">
                        <p>Код автобуса:</p>
                        <div class="CodeBus_Col">
                            <select class = "select-css" name=" ">
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
                        <input type="text" name=" " placeholder="Гос.номер">
                        <input type="text" name=" " placeholder="Год выпуска">
                    </div>
                    <button name="add" value="Добавить">Добавить</button>
                    <button name="delete" value="Удалить">Удалить</button>
                </form>
            </div>   
            <div id = "table"><table></table></div>
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
                <form action = "" method = "POST" name = "Маршрутный лист">
                    <div class="style_input">
                        <input type="text" name = "Номер маршрута" placeholder="Номер маршрута">
                        <p>Количество промежуточных остановок на маршруте:</p>
                        <input type="text" name = " ">
                        <p>Продолжительность простоя на одной остановке:</p>
                        <input type="text" name = " ">
                        <p>Время прохождения маршрута, мин:</p>
                        <input type="text" name = " ">
                        <input type="text" name=" " placeholder="Стоимость проезда">
                    </div>

                    <button name = "add" value="Добавить">Добавить</button>
                    <button name="delete" value="Удалить">Удалить</button>
                </form>
            </div>
            <div id = "table"><table></table></div>
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
                <form action="" method="POST" name = "Водители">
                    <div class="style_input">
                        <input type="text" name="Таб.ном водителя" placeholder="Таб.ном водителя">
                        <input type="text" name=" " placeholder="Ф.И.О">
                        <input type="date" name=" " placeholder="Дата рождения">
                        <input type="text" name=" " placeholder="Оклад">
                        <input type="text" name=" " placeholder="Стаж работы">
                        <p>Номер маршрута:</p>
                        <div class="Route_Number_Col">
                            <select class = "select-css" name=" " id="">
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
                    <button name="add" value="Добавить">Добавить</button>
                    <button name="delete" value="Удалить">Удалить</button>
                </form>
            </div>
            <div id = "table"><table></table></div>
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
                <form action="" method = "POST" name = "Тех.талоны">
                    <div class="style_input">
                        <input type="text" name = "Номер тех.талона" placeholder="Номер тех.талона">
                        <p>Код автобуса:</p>
                        <div class="CodeBus_Col">
                            <select class = "select-css" name=" " id="">
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
                        <input type="date" name=" ">
                        <p>Дата следующего ТО:</p>
                        <input type="date" name = " ">
                        <input type="text" name = " " placeholder="Ф.И.О тех.эксперта">
                    </div>

                    <button name = "add" value = "Добавить">Добавить</button>
                    <button name = "delete" value="Удалить">Удалить</button>
                </form>
            </div>
            <div id = "table"><table></table></div>
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
                <form action="" method = "POST" name = "Путевой лист"> 
                    <div class="style_input">
                        <input type="text" name="ID" placeholder="ID">
                        <p>Код автобуса:</p>
                        <div class="CodeBus2_Col">
                            <select class = "select-css" name=" " id="">
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
                            <select class = "select-css" name=" " id="">
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
                            <select class = "select-css" name=" " id="">
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
                        <input type="date" name=" ">
                        <p>Время выхода автобуса на маршрут</p>
                        <input type="time" name=" ">
                        <p>Время прибытия автобуса с маршрута</p>
                        <input type="time" name=" ">
                        <input type="text" name=" " placeholder="Топливо при выезде, л.">
                        <input type="text" name=" " placeholder="Топливо при возврате, л.">
                        <input type="text" name=" " placeholder="Причина схода автобуса">
                        <input type="text" name=" " placeholder="Кол-во проданных билетов">
                        <input type="text" name=" " placeholder="Выручка, руб.">
                    </div>
                    <button name="add" value="Добавить">Добавить</button>
                    <button name="delete" value="Удалить">Удалить</button>
                </form>
            </div>
            <div id = "table"><table></table></div>
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
                        <select class = "select-css" name="ID" id="">
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
                    <button name="delete" value="Удалить">Удалить</button>
                </form>
            </div>
            <div id = "table"><table></table></div>
            </div>
        </div>
    </section>




</body>

</html>