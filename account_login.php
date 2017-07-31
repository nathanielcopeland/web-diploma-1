<?php
session_start();
include("includes/database.php");
include("index.php");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM accounts WHERE username='$username' LIMIT 1";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_array($query);
$id = $row['id'];
$db_password = $row['password'];

if(password_verify($password,$db_password)){
    echo 'password is valid';
    $_SESSION["id"] = $id;
    echo $_SESSION["id"];
} else{
    echo 'invalid password';
    
}

?>