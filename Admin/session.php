<?php
if(!isset($_SESSION['login'])){
    header('location:../HomePage');
    exit();
}else{
    include('../dal.php');
    $conn=DataConnect();
    $user_check = $_SESSION['login'];
    $ses_sql ="SELECT username FROM users WHERE username = ?";
    $stmt = $conn->prepare($ses_sql);
    $stmt->bind_param('s',$user_check); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $login_session = $row['username'];
    $conn->close();
}
?>