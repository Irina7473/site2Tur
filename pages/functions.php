<?php

function connect( 
    $host = 'localhost', 
    $user = 'root', 
    $pass = '', 
    $dbname = 'site2') 
{
    $link = new mysqli($host, $user, $pass, $dbname) or die('Ошибка подключения к БД');
    mysqli_select_db($link, $dbname) or die('Ошибка открытия БД');
    mysqli_query($link, "set names 'utf8'");

    return $link;
}


/**
 * Registration
 */
function register($name, $pass, $email, $role) {

    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));
    $role = trim(htmlspecialchars($role));

    if ($role == '') $role = 2;

    if ($name == '' || $pass == '' || $email == '') {
        echo '<h3><span style="color:red;">Заполните все поля!</h3>';
        return false;
    }

    if (strlen($name) < 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo '<h3><span style="color:red;">Должно быть от 3 до 30 символов!</h3>';
        return false;
    }

    $ins = "INSERT INTO users(login, pass, email, role_id) VALUES('".$name."', '".md5($pass)."', '".$email."', '".$role."')";

    $connect = connect();
    mysqli_query($connect, $ins);
    $err = mysqli_connect_error();

    if ($err) {

        if ($err == 1062) {
            echo '<h3><span style="color:red;">Токой логин уже существует!</h3>';
        } else {
            echo '<h3><span style="color:red;">Код ошибки: '.$err.'!</h3>';
        }
        return false;
    }
    return true;
}