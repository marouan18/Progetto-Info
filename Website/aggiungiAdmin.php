<?php
include ("Website/database.php");
$username='Marco';
$password='Password100';
$hash=password_hash($password,PASSWORD_DEFAULT);
$query = "insert into users(username,password) values('$username','$hash')";
try{
$result = $conn->query($query);
}
catch(Exception $e){
    echo $e;
}
?>