<?php
if(!isset($_SESSION['login'])){
    header('location:../HomePage');
    exit();
}else{
    include('../dal.php');
    $conn=DataConnect();
$user_check = $_SESSION['login'];

$ses_sql = $conn->query("SELECT username FROM users WHERE username = '$user_check'");

$row = $ses_sql->fetch_assoc();

$login_session = $row['username'];
$conn->close();
}
?>