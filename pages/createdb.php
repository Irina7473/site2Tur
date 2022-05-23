<?php
include_once('functions.php');
$connection = connect();

$ct1 = 'create table countries(
    id int not null auto_increment primary key,
    country varchar(64) unique
) default charset="utf8"';

$ct2 = 'create table cities(
    id int not null auto_increment primary key,
    city varchar(64),
    country_id int,
    foreign key(country_id) references countries(id)
    on delete cascade,
    ucity varchar(128),
    unique index ucity(city, country_id)
) default charset="utf8"';

$ct3 = 'create table hotels(
    id int not null auto_increment primary key,
    hotel varchar(64),
    city_id int,
    foreign key(city_id) references cities(id) on delete cascade,
    country_id int,
    foreign key(country_id) references countries(id) on delete cascade,
    stars int,
    cost int,
    info varchar(1024)
) default charset="utf8"';

$ct4 = 'create table images(
	id int not null auto_increment primary key,
	imagepath varchar(255),
	hotel_id int,
	foreign key(hotel_id) references hotels(id) on delete cascade)
	default charset="utf8"';

$ct5 = 'create table roles(
	id int not null auto_increment primary key,
	role varchar(32)
) default charset="utf8"';

$ct6 = 'create table users(
	id int not null auto_increment primary key,
	login varchar(32) unique,
	pass varchar(128),
	email varchar(128),
	discount int,
	role_id int,
	foreign key(role_id) references roles(id) on delete cascade,
	avatar varchar(128)
) default charset="utf8"';

mysqli_query($connection, $ct1);
$err = mysqli_connect_error();
if ($err) {
    echo 'Error code 1:' . $err . '<br>';
    exit();
}
mysqli_query($connection, $ct2);
$err = mysqli_connect_error();
if ($err) {
    echo 'Error code 2:' . $err . '<br>';
    exit();
}
mysqli_query($connection, $ct3);
$err = mysqli_connect_error();
if ($err) {
    echo 'Error code 3:' . $err . '<br>';
    exit();
}
mysqli_query($connection, $ct4);
$err = mysqli_connect_error();
if ($err) {
    echo 'Error code 4:' . $err . '<br>';
    exit();
}
mysqli_query($connection, $ct5);
$err = mysqli_connect_error();
if ($err) {
    echo 'Error code 5:' . $err . '<br>';
    exit();
}
mysqli_query($connection, $ct6);
$err = mysqli_connect_error();
if ($err) {
    echo 'Error code 6:' . $err . '<br>';
    exit();
}