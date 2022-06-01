<?php
if ( !isset($_SESSION['ruser'])) exit();
else{

    echo '<h3>Ваш профиль</h3>';
    echo '<div class="col-sm-6 col-md-6 col-lg-6 right">';

    $userid = $_SESSION['rid'];
    $connect = connect();
    $sel = 'SELECT * FROM users WHERE id=' . $userid ;
    $res = mysqli_query($connect, $sel);

    while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {

          echo ' <img src="../' . $row[6] . '" class="img-fluid">';
        ?>
        <form action="index.php?page=2" method="POST" class="input-group" enctype="multipart/form-data">
            <h5>Загрузите аватар</h5>
            <input type="file" name="avatar">
            <br>
            <input type="submit" name="addavatar" value="Добавить" class="btn btn-sm btn-primary">
        </form>
        <?php
        }
        mysqli_free_result($res);

    echo '</div><br><hr>';
}

if (isset($_POST['addavatar'])) {

        if ($_FILES['avatar']['error'] != 0) {
            echo '<script>alert("Ошибка загрузки файла! Ошибка: ")</script>';
        }

        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $dest_path = 'images/' . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $ins = "UPDATE users SET avatar ='" . $dest_path . "' WHERE id=" . $userid . ")";
            mysqli_query($connect, $ins);
        }

}

