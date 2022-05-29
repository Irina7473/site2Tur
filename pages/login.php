<?php
if (isset($_SESSION['ruser'])) {   ?>
    <form action="index.php"
    <?php  if (isset($_GET['page'])) echo '?page=' . $_GET['page'];  ?>
        class="form-inline pull-right" method="post">
        <h4>Привет, <span>  <?php echo $_SESSION['ruser'] ?>  </span>
        <input type="submit" value="Выйти" id="exit" name="exit" class="btn btn-default btn-xs"></h4>
    </form>

    <?php
    if (isset($_POST['exit'])) {
        unset($_SESSION['ruser']);
        unset($_SESSION['radmin']);
        unset($_SESSION['rfill']);
        echo '<script>window.location.reload()</script>';
    }
} else {
    if (isset($_POST['press'])) {
        if (login($_POST['login'], $_POST['pass'])) {
            echo '<script>window.location.reload()</script>';
        }
    } else {
        ?>
        <form action="index.php
        <?php
        if (isset($_GET['page'])) echo '?page=' . $_GET['page'];
        ?>
        " class="input-group input-group-sm pull-right" method="post">
        <input type="text" name="login" size="10" class="" placeholder="логин">
        <input type="password" name="pass" size="10" class="" placeholder="пароль">
        <input type="submit" id="press" value="Войти" class="btn btn-default btn-xs" name="press">
    </form>
   <?php }
}
