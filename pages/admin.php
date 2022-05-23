<h3>Форма добавления информации на сайт</h3>
<div class="row">

    <!-- Форма добавления/удаления страны -->
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <h4>Добавление/удаление страны</h4>

        <?php
        $connect = connect();
        $sel = "SELECT * FROM countries";
        $res = mysqli_query($connect, $sel);
        ?>

        <form action="index.php?page=4" method="post" class="input-group" id="formcountry">

            <table class="table table-striped">
                <tr>
                    <th>Id страны</th>
                    <th>Страна</th>
                    <th>Выбрать для изменения</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                ?>

                    <tr>
                        <td><?php echo $row[0] ?></td>
                        <td><?php echo $row[1] ?></td>
                        <td><input type="checkbox" name="<?php echo 'cb' . $row[0] ?>"></td>
                    </tr>

                <?php  }  ?>

            </table>

            <?php mysqli_free_result($res) ?>

            <input type="text" name="country" placeholder="Страна">
            <br>
            <div class="divgroup">
                <input type="submit" name="addcountry" value="Добавить" class="btn btn-sm btn-primary">
                <input type="submit" name="changecountry" value="Изменить" class="btn btn-sm btn-info">
                <input type="submit" name="delcountry" value="Удалить" class="btn btn-sm btn-danger">
            </div>
        </form>

        <?php

        if (isset($_POST['addcountry'])) {
            $country = trim(htmlspecialchars($_POST['country']));
            if ($country == '') exit();

            $ins = "INSERT INTO countries(country) VALUES('" . $country . "')";
            mysqli_query($connect, $ins);

            echo '<script>window.location=document.URL;</script>';
        }

        if (isset($_POST['changecountry'])) {
            $country = trim(htmlspecialchars($_POST['country']));
            if ($country == '') exit();

            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2) == 'cb') {
                    $idc = substr($k, 2);
                    $change = "UPDATE countries SET country='" . $country . "' WHERE id=" . $idc;
                    mysqli_query($connect, $change );
                }
            }
            echo '<script>window.location=document.URL;</script>';
        }

        if (isset($_POST['delcountry'])) {

            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2) == 'cb') {
                    $idc = substr($k, 2);
                    $del = 'DELETE FROM countries WHERE id=' . $idc;
                    mysqli_query($connect, $del);
                }
            }
            echo '<script>window.location=document.URL;</script>';
        }

        ?>

    </div>


    <!-- Форма добавления/удаления городов -->
    <div class="col-sm-6 col-md-6 col-lg-6 right">
        <h4>Добавление/удаление городов</h4>
        <form action="index.php?page=4" method="post" class="input-group" id="formcity">

            <?php
            $sel = "SELECT CI.id, CI.city, CO.country FROM countries AS CO, cities AS CI WHERE CI.country_id = CO.id ORDER BY CO.country, CI.city";
            $res = mysqli_query($connect, $sel);
            ?>

            <table class="table table-striped">
                <tr>
                    <th>Id города</th>
                    <th>Город</th>
                    <th>Страна</th>
                    <th>Выбрать для изменения</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                ?>

                    <tr>
                        <td><?php echo $row[0] ?></td>
                        <td><?php echo $row[1] ?></td>
                        <td><?php echo $row[2] ?></td>
                        <td><input type="checkbox" name="<?php echo 'ci' . $row[0] ?>"></td>
                    </tr>

                <?php  }  ?>

            </table>

            <?php
            mysqli_free_result($res);
            $res = mysqli_query($connect, "SELECT * FROM countries");
            ?>

            <div class="divgroup">
            <select name="countryname" class="form-select">
                <option selected>Выберите страну</option>

                <?php
                while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) { ?>

                    <option value="<?php echo $row[0] ?>">
                        <?php echo $row[1] ?>
                    </option>

                <?php } ?>

            </select>

            <input type="text" name="city" placeholder="Город">
            </div>
            <div class="divgroup">
                <input type="submit" name="addcity" value="Добавить" class="btn btn-sm btn-primary">
                <input type="submit" name="changecity" value="Изменить" class="btn btn-sm btn-info">
                <input type="submit" name="delcity" value="Удалить" class="btn btn-sm btn-danger">
            </div>
        </form>

        <?php

        if (isset($_POST['addcity'])) {

            $city = trim(htmlspecialchars($_POST['city']));
            if ($city == '') exit();

            $countryid = $_POST['countryname'];

            $ins = "INSERT INTO cities(city, country_id) VALUES('" . $city . "', '" . $countryid . "')";
            mysqli_query($connect, $ins);
            $err = mysqli_connect_error();

            if ($err) {
                echo 'Код ошибки: ' . $err . '<br>';
                exit();
            }

            echo '<script>window.location=document.URL;</script>';
        }

        if (isset($_POST['changecity'])) {
            $city = trim(htmlspecialchars($_POST['city']));
            if ($city == '') exit();

            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2) == 'ci') {
                    $idc = substr($k, 2);
                    $change = "UPDATE cities SET city='" . $city . "' WHERE id=" . $idc;
                    mysqli_query($connect, $change );
                }
            }
            echo '<script>window.location=document.URL;</script>';
        }

        if (isset($_POST['delcity'])) {
            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2) == 'ci') {
                    $idc = substr($k, 2);
                    $del = 'DELETE FROM cities WHERE id=' . $idc;
                    mysqli_query($connect, $del);
                }
                echo '<script>window.location=document.URL;</script>';
            }
        }

        ?>
    </div>
    <br>


    <!-- Форма добавления/удаления отелей -->
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <h4>Добавление/удаление отелей</h4>
        <form action="index.php?page=4" method="post" class="input-group" id="formhotel">

            <?php
            $sel = "SELECT ho.id, ho.hotel, ho.stars, ho.city_id, ho.country_id, ho.info, ci.id, ci.city, co.id, co.country
            from hotels ho, cities ci,countries co
            WHERE ho.city_id=ci.id and ho.country_id=co.id";
            $res = mysqli_query($connect, $sel);
            $err = mysqli_connect_error();
            ?>

            <table class="table" width="100%">
                <tr>
                    <th>Id отеля</th>
                    <th>Отель</th>
                    <th>Звезды</th>
                    <th>Город</th>
                    <th>Страна</th>
                    <th>Выбрать для изменения</th>
                </tr>

                <?php

                while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) { ?>

                    <tr>
                        <td><?php echo $row[0] ?></td>
                        <td><?php echo $row[1] ?></td>
                        <td><?php echo $row[2] ?></td>
                        <td><?php echo $row[7] ?></td>
                        <td><?php echo $row[9] ?></td>
                        <td><input type="checkbox" name="<?php echo 'ht' . $row[0] ?>"></td>
                    </tr>

                <?php } ?>

            </table>

            <?php
            mysqli_free_result($res);
            ?>

            <div class="divgroup">
            <select name="countryid" class="form-select">

                <?php
                $res = mysqli_query($connect, "SELECT * FROM countries ORDER BY country");
                ?>

                <option value="0">Выберите страну...</option>

                <?php
                while ($row = mysqli_fetch_array($res)) {  ?>

                    <option value="<?php echo $row[0] ?>"
                    <?php if (isset($_POST['countryid']) && $row[0] == $_POST['countryid']) echo 'selected="selected"'; ?> >
                        <?php echo $row[1]  ?>
                    </option>

                <?php
                    }
                mysqli_free_result($res);
                ?>

            </select>
            <input type="submit" name="selcountry" value="Выбрать страну" class="btn btn-sm btn-info">

            <?php
            if (isset($_POST['countryid'])) {
                $countryid = $_POST['countryid'];
                if ($countryid == 0) exit();
                $result = mysqli_query($connect, "SELECT * FROM cities WHERE country_id=" . $countryid . " ORDER BY city");
                $csel = array();
            }

            // Как после выбора страны, когда обновится страница оказаться на том же месте, а не в начале страницы?
            ?>

            <select name="cityid">
                <option value="0">Выберите город...</option>

                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>

                <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>

                <?php
                    $csel[$row[0]] = $row[2];
                }
                //mysqli_free_result($res);
                ?>

            </select>
            </div>

            <div class="input-group">
            <input type="text" name="hotel" class="form-input" placeholder="Отель">
                <span class="input-group-text">   Количество звезд    </span>
                <input type="number" name="stars" class="form-input" min="1" max="5">
            </div>
            <br>
            <input type="text" name="cost" class="form-input" placeholder="Стоимость">
            <br>
            <textarea name="info" placeholder="Описание отеля" class="form-control"></textarea>
            <br>
            <br>
            <div class="divgroup">
                <input type="submit" name="addhotel" value="Добавить" class="btn btn-sm btn-primary">
                <input type="submit" name="changehotel" value="Изменить" class="btn btn-sm btn-info">
                <input type="submit" name="delhotel" value="Удалить" class="btn btn-sm btn-danger">
            </div>
        </form>

        <?php
        // mysqli_free_result($res);

        if (isset($_POST['addhotel'])) {

            $hotel = trim(htmlspecialchars($_POST['hotel']));
            $cityid = $_POST['cityid'];
            //$countryid = $_POST['countryid'];    //так тоже работает
            $countryid = $csel[$cityid];
            $stars = intval($_POST['stars']);
            $cost = intval(trim(htmlspecialchars($_POST['cost'])));
            $info = trim(htmlspecialchars($_POST['info']));

            if ($hotel == "" || $cost == "" || $stars == "") exit();

            //$countryid = $csel[$cityid];

            $ins = 'insert into hotels (hotel, city_id, country_id, stars, cost, info) values("' . $hotel . '",' . $cityid;
            $ins .= "," . $countryid . ',' . $stars . ',' . $cost . ',"' . $info;
            $ins .= '")';

            mysqli_query($connect, $ins);
            echo "<script>window.location=document.URL;</script>";
        }


        //Изменение не работает без выбора страны и города
        if (isset($_POST['changehotel'])) {

            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2) == "ht") {
                    $idc = substr($k, 2);

                    $hotel = trim(htmlspecialchars($_POST['hotel']));
                    $stars = intval($_POST['stars']);
                    $cost = intval(trim(htmlspecialchars($_POST['cost'])));
                    $info = trim(htmlspecialchars($_POST['info']));

                    if ($hotel != '') {
                        $change = "UPDATE hotels SET hotel='" . $hotel . "' WHERE id=" . $idc;
                        mysqli_query($connect, $change);
                    }
                    if ($stars != '') {
                        $change = "UPDATE hotels SET stars='" . $stars . "' WHERE id=" . $idc;
                        mysqli_query($connect, $change);
                    }
                    if ($cost != '') {
                        $change = "UPDATE hotels SET cost='" . $cost . "' WHERE id=" . $idc;
                        mysqli_query($connect, $change);
                    }
                    if ($info != '') {
                        $change = "UPDATE hotels SET info='" . $info . "' WHERE id=" . $idc;
                        mysqli_query($connect, $change);
                    }

                }
            }
            echo "<script>window.location=document.URL;</script>";
        }


// НЕ РАБОТАЕТ УДАЛЕНИЕ без выбора страны и города
        if (isset($_POST['delhotel'])) {

            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2) == "ht") {
                    $idc = substr($k, 2);
                    $del = 'DELETE FROM hotels WHERE id=' . $idc;
                    mysqli_query($connect, $del);
                    if ($err) {
                        echo 'Error code:' . $err . '<br>';
                        exit();
                    }
                }
            }
            echo "<script>window.location=document.URL;</script>";
        }
        ?>

    </div>
    <br>


    <!-- Загрузка фотографий -->
    <div class="col-sm-6 col-md-6 col-lg-6 right">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h4>Загрузка фотографий</h4>
        <form action="index.php?page=4" method="POST" class="input-group" enctype="multipart/form-data">
            <select name="hotelid">

                <?php
                $sel = "select ho.id, co.country,ci.city,ho.hotel from countries co,cities ci, hotels ho where co.id=ho.country_id and ci.id=ho.city_id order by co.country";
                $res = mysqli_query($connect, $sel);
                while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                    ?>

                    <option value="<?php echo $row[0] ?>">
                        <?php echo $row[1] . '  ' . $row[2] . '  ' . $row[3]; ?>
                    </option>

                <?php  }  ?>

            </select>
            <br>
            <br>

            <?php mysqli_free_result($res); ?>

            <input type="file" name="file[]" multiple accept="image/*">
            <br>
            <input type="submit" name="addimage" value="Добавить" class="btn btn-sm btn-primary">

        </form>
        <br>
        <br>
        <br>

        <?php

        if (isset($_POST['addimage'])) {
            foreach ($_FILES['file']['name'] as $k => $v) {
                if ($_FILES['file']['error'][$k] != 0) {
                    echo '<script>alert("Ошибка занрузки файлов! Ошибка: ' . $v . '")</script>';
                    continue;
                }

                if (move_uploaded_file($_FILES['file']['tmp_name'][$k], 'images/' . $v)) {
                    $ins = "INSERT INTO images (hotel_id, imagepath) VALUES(" . $_REQUEST['hotelid'] . ", 'images/" . $v . "')";
                    mysqli_query($connect, $ins);
                }
            }
        }
        ?>

    </div>
    <br>
    <br>
    <br>
</div>