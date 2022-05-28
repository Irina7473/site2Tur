<?php
if (isset($_SESSION['ruser'])) {   ?>
    <form action="index.php"
    <?php  if (isset($_GET['page'])) echo '?page=' . $_GET['page'];  ?>
        class="form-inline pull-right" method="post">
        <h4>Hello, <span>  <?php $_SESSION['ruser'] ?>  </span>
    <input type="submit" value="Logout" id="ex" name="ex" class="btn btn-default btn-xs"></h4>
</form>

<?php
if (isset($_POST['ex'])) {
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
        echo '<form action="index.php';
        if (isset($_GET['page'])) echo '?page=' . $_GET['page'];
        echo '" class="input-group input-group-sm pull-right" method="post">';
        echo '<input type="text" name="login" size="10" class="" placeholder="login">
    <input type="password" name="pass" size="10" class="" placeholder="password">
    <input type="submit" id="press" value="Login" class="btn btn-default btn-xs" name="press">
</form>';
    }
}
