<?php

include('includes/db_connect.php');

$login = $_POST['login'];
$password = $_POST['password'];

$user = mysqli_query( $connection, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'" );

if( mysqli_num_rows($user) == 0 )
{
    echo 'Вы не зарегистрированы!';
} else
{
    echo 'Привет ' . $login . '!';
}

