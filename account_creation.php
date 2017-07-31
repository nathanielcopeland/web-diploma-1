<?php
include("database.php");

$username = $_POST['username'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$email = $_POST['email'];

$account_query = "INSERT INTO accounts (username,email,password,status,created) VALUES('$username','$email','$password','1',NOW())";
//run the query
$result = $connection->query($account_query);
if(!$result){
    echo "account creation failed";
}
?>