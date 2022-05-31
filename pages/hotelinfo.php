<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Hotel Info</title>
    <link rel="stylesheet" href="../css/bootstrap. min.css">
    <link rel="stylesheet" href="../css/info.css">
</head>
<body>
    <?php
    include_once ("functions.php");
    $connect = connect();
    if(isset($_GET['hotel'])) {

        $hotel = $_GET['hotel'];
        $sel = 'SELECT ho.id, ho.hotel, ho.stars, ho.city_id, ho.country_id, ho.cost, ho.info, ci.id, ci.city, co.id, co.country 
                FROM hotels ho, cities ci,countries co 
                WHERE ho.city_id = ci.id AND ho.country_id = co.id AND ho.id=' . $hotel ;
        $res = mysqli_query($connect, $sel);

        $row = mysqli_fetch_array($res, MYSQLI_NUM);
        $hname = $row[1];
        $hstars = $row[2];
        $hcity = $row[8];
        $hcountry = $row[10];
        $hcost = $row[5];
        $hinfo = $row[6];
        mysqli_free_result($res);
        echo '<h2 class="text-uppercase text- center">' . $hname . ' ' . $hstars . '*</h2>';
        echo '<h4 class="text-uppercase text- center">' . $hcountry . ' ' . $hcity . '</h4>';
        echo '<div class="text-uppercase text- center">Стоимость - ' . $hcost . '</div><br>';
        echo '<div class="text-uppercase text- center">' . $hinfo . '</div><br>';

        echo '<div class="row"><div class="col-md-6 text- center">';
        $sel = 'SELECT imagepath FROM images WHERE  hotel_id=' . $hotel;
        $res = mysqli_query($connect, $sel);
        echo '<span class="label label-info">Наши фото</span>';
        echo '<ul id="gallery">';

        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo ' <li><img src="../' . $row[0] . '"></li>';
        }
        mysqli_free_result($res);
        echo '</ul>';
    }
?>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/option.js"></script>
</body>

</html>