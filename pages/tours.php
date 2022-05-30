<h2>Выбор тура</h2>
<hr>

<?php  $connect = connect();  ?>

<form action="index.php?page=1" method="POST">
    <div >
        <select name="countryId" class="form-control" onchange="showCities(this.value)">
            <option value="0">Выберите страну</option>

            <?php
            $res = mysqli_query($connect, "SELECT * FROM countries ORDER BY country");
            while ($row = mysqli_fetch_array($res)) { ?>

                <option value=" <?php echo $row[0] ?> ">
                    <?php echo $row[1] ?>
                </option>

            <?php  }  ?>

        </select>

        <select id="cityList" name="cityId" class="form-control" onchange="showHotels(this.value)" >
        </select>
    </div>
    <div id="hotelsList"></div>
</form>
<br>
<br>
<br>
<hr>
