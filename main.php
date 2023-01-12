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

</body>

</html>