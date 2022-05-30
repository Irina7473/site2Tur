<h3>Форма регистрации</h3>
<hr>

<?php
if (!isset($_POST['regbtn'])) {
?>

    <form action="index.php?page=3" method="post">

        <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control" name="login">
        </div>

        <div class="form-group">
            <label for="pass1">Пароль</label>
            <input type="password" class="form-control" name="pass1">
        </div>

        <div class="form-group">
            <label for="pass2">Повторите пароль</label>
            <input type="password" class="form-control" name="pass2">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email">
        </div>

        <button type="submit" class="btn btn-primary" name="regbtn">Регистрация</button>

    </form>
    <hr>

<?php
} else {

    if (register($_POST['login'], $_POST['pass1'], $_POST['email'], 2)) {

        echo '<h3><span style="color:green;">Новый пользователь добавлен!</h3>';

    }

}
