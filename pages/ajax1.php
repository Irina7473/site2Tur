<?php
include_once ('functions.php');

$connect = connect();
$cid = $_POST['cid'];

$sel= 'SELECT * FROM cities WHERE country_id=' . $cid;
$res = mysqli_query($connect, $sel);

echo '<option value="0">Выберите город</option>';
while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
}

mysqli_free_result($res);
