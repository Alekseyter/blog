<?php
require 'includes/config.php';

$autor = $_POST['autor'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$text = $_POST['text'];
$art_id = $_POST['art_id'];

if( isset($_POST['do_post']) ) {
    $sended = mysqli_query( $connection, "INSERT INTO `comments` (`autor`, `nickname`, `email`, `text`, `articles_id`) VALUES ('".$autor."', '".$nickname."', '".$email."', '".$text."', '".$art_id."')" );

    if( $sended ) {
        header('Content-Type: text/html; charset=utf-8');
        header( 'Refresh: 3; url=' . $_SERVER['HTTP_REFERER'] . '#comments-block');
        echo '<center>СПАСИБО, ВАШ ОТЗЫВ ПРИНЯТ</center>';
    } else {
        header('Content-Type: text/html; charset=utf-8');
        header( 'Refresh: 3; url=' . $_SERVER['HTTP_REFERER'] . '#comment-add-form');
        echo 'Произошла ошибка';
    }
}