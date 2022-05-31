<?php
include_once ('functions.php');

$connect = connect();
$cid = $_POST['cid'];

$sel= 'SELECT id, hotel, stars, cost FROM hotels WHERE city_id=' . $cid;
$res = mysqli_query($connect, $sel);
$number = mysqli_num_rows( $res);

if ($number > 0 ) {
    echo ' <h4><span style="color:blue;">Выберите отель</span></h4> ';
    echo ' <table class="table" >
                <tr>
                    <th>Отель</th>
                    <th>Звезды</th>
                    <th>Стоимость</th>
                    <th>Страница отеля</th>
                </tr> ' ;

    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo '<tr>
                    <td>' . $row[1] . '</td>
                    <td>' . $row[2] . '</td>
                    <td>' . $row[3] . '</td>
                    <td><a href="pages/hotelinfo.php?hotel=' . $row[0] . '" target=" _ blank">Больше информации</a>' . '</td>
                  </tr> ' ;
        }
        echo '</table>' ;
}

else {
    echo "<h4><span style='color:red;'>Нет отелей </span></h4>";
}

mysqli_free_result($res);
