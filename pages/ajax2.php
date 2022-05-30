<?php
include_once ('functions.php');

$connect = connect();
$cid = $_POST['cid'];

$sel= 'SELECT id, hotel, stars FROM hotels WHERE city_id=' . $cid;
$res = mysqli_query($connect, $sel);
$number = mysqli_num_rows( $res);

if ($number > 0 ) {
    echo "<h4><span style='color:blue;'>Выберите отель</span></h4>";
    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        echo '<div>' . $row[1] . ' ' . $row[2] . '*</div>';
    }
}
else {
    echo "<h4><span style='color:red;'>Нет отелей </span></h4>";
}
mysqli_free_result($res);
