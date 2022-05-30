<?php
session_start();
include_once('pages/functions.php');

$page = false;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тур оператор</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>


    <div>
        <a href=""></a>
    </div>


    <div class="container">
        <div class="row">
            <header class="col-sm-12 col-md-12 col-lg-12">
                <?php include_once("pages/login.php");?>
            </header>

            <!-- Навигация -->
            <nav class="col-12">

                <?php include_once('pages/menu.php'); ?>

            </nav>

            <!-- Контент страницы -->
            <section class="col-12">
                <?php

                if ($page) {
                    if ($page == 1) include_once('pages/tours.php');
                    if ($page == 2) include_once('pages/comments.php');
                    if ($page == 3) include_once('pages/registration.php');
                    if ($page == 4) if(isset($_SESSION['radmin']) || isset($_SESSION['rfill'])) include_once('pages/admin.php');
                    if ($page == 5) if(isset($_SESSION['radmin'])) include_once('pages/users.php');
                }

                ?>
            </section>




            <footer>Footer 2022</footer>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/option.js"></script>
</body>

</html>