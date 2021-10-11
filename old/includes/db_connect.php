<?php

$connection = mysqli_connect('127.0.0.1', 'root', 'root', 'lesson');

if( $connection == false) {
    echo 'Не удалось подключиться к базе данных: ';
    echo mysqli_connect_error();
    die();
}