<h3>Форма управления пользователями</h3>
<div class="col-6">

<?php
$connect = connect();
$sel = "SELECT U.id, U.login, R.role FROM users AS U, roles AS R WHERE U.role_id = R.id";
$res = mysqli_query($connect, $sel);
?>

<form action="index.php?page=5" method="post" class="input-group" id="formusers">

    <table class="table table-striped">
        <tr>
            <th>Id пользователя</th>
            <th>Логин</th>
            <th>Роль</th>
            <th>Выбрать для изменения</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        ?>

            <tr>
                <td><?php echo $row[0] ?></td>
                <td><?php echo $row[1] ?></td>
                <td><?php echo $row[2] ?></td>
                <td><input type="checkbox" name="<?php echo 'us' . $row[0] ?>"></td>
            </tr>

        <?php } ?>

    </table>

    <?php mysqli_free_result($res) ?>

    <div class="divgroup">
        <input type="text" name="user" placeholder="Пользователь">
        <input type="text" name="pass" placeholder="Пароль">
        <input type="text" name="email" placeholder="Почта">

        <?php  $res = mysqli_query($connect, "SELECT * FROM roles"); ?>

        <select name="role" class="form-select" >
            <option selected>Выберите роль</option>

            <?php while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) { ?>

                <option value="<?php echo $row[0] ?>">
                    <?php echo $row[1] ?>
                </option>

            <?php  }  ?>

        </select>
    </div>
    <div class="divgroup">
        <input type="submit" name="adduser" value="Добавить" class="btn btn-primary">
        <input type="submit" name="changeuser" value="Изменить" class="btn btn-info">
        <input type="submit" name="deluser" value="Удалить" class="btn btn-danger">
    </div>
    <br>
</form>

<?php

if (isset($_POST['adduser'])) {

    if (register($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['role'])) {
        echo '<script>window.location=document.URL;</script>';
        echo '<h3><span style="color:green;">Новый пользователь добавлен!</h3>';   // Не выводится это сообщение
    }
    else {
        echo '<h3><span style="color:red;">ОШИБКА!</h3>';
    }
}

if (isset($_POST['changeuser'])) {

    foreach ($_POST as $k => $v) {
        if (substr($k, 0, 2) == 'us') {
            $idc = substr($k, 2);
            $user = trim(htmlspecialchars($_POST['user']));
            $pass = trim(htmlspecialchars($_POST['pass']));
            $email = trim(htmlspecialchars($_POST['email']));
            $role = trim(htmlspecialchars($_POST['role']));

            if ($user != '') {
                $change = "UPDATE users SET login='" . $user . "' WHERE id=" . $idc;
                mysqli_query($connect, $change);
            }
            if ($pass != '') {
                $change = "UPDATE users SET pass='" . md5($pass) . "' WHERE id=" . $idc;
                mysqli_query($connect, $change);
            }
            if ($email != '') {
                $change = "UPDATE users SET email='" . $email . "' WHERE id=" . $idc;
                mysqli_query($connect, $change);
            }
            if ($role != '') {
                $change = "UPDATE users SET role_id='" . $role . "' WHERE id=" . $idc;
                mysqli_query($connect, $change);
            }

        }
    }

    echo '<script>window.location=document.URL;</script>';
    echo '<h3><span style="color:green;">Изменения внесены!</h3>';  // Не выводится это сообщение
}

if (isset($_POST['deluser'])) {

    foreach ($_POST as $k => $v) {
        if (substr($k, 0, 2) == 'us') {
            $idc = substr($k, 2);
            $del = 'DELETE FROM users WHERE id=' . $idc;
            mysqli_query($connect, $del);
        }
    }
    echo '<script>window.location=document.URL;</script>';
}

?>

</div>


