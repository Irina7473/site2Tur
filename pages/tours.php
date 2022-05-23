<h2>Выбор тура</h2>
<hr>


<?php

$connect = connect();
?>

<form action="index.php?page=1" method="POST">

    <select name="countryid">

        <?php

        $res = mysqli_query($connect, "SELECT * FROM countries ORDER BY country");

        ?>

        <option value="0">Выберите страну...</option>

        <?php

        while ($row = mysqli_fetch_array($res)) {

        ?>

            <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>



        <?php

        }

        mysqli_free_result($res);

        ?>

        <input type="submit" name="selcountry" value="Выбрать страну" class="btn btn-sm btn-primary">

    </select>

    <?php

    if (isset($_POST['selcountry'])) {

        $countryid = $_POST['countryid'];

        if ($countryid == 0) exit();

        $result = mysqli_query($connect, "SELECT * FROM cities WHERE country_id=" . $countryid . " ORDER BY city");
    }
    ?>

    <select name="cityid">

        <option value="0">Выберите город...</option>

        <?php

        while ($row = mysqli_fetch_array($result)) {

        ?>
            <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
        <?php

        }

        mysqli_free_result($result);

        ?>

        <input type="submit" name="selcity" value="Выбрать город" class="btn btn-sm btn-primary">



    </select>

</form>