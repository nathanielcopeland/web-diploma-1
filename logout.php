<?php
session_start();
//unset($_SESSION);
unset($_SESSION["username"]);
unset($_SESSION["email"]);
unset($_SESSION["rank"]);
//session_destroy();
//session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
//header('Location:index.php');
die;
?>