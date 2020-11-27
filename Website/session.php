<?php
include('database.php');

$user_check = $_SESSION['login'];

$ses_sql = $conn->query("SELECT username FROM users WHERE username = '$user_check'");

$row = $ses_sql->fetch_assoc();

$login_session = $row['username'];

if(!isset($_SESSION['login'])){
    header('location:HomePage.php');
    exit();
}
?>