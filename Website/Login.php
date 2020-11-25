<?php
$error="";
include_once("database.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username =$_POST['uname'];
$password =$_POST['psw'];
$query = "SELECT * FROM users WHERE username = '".$username."'";
$result = $conn->query($query);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    if(password_verify($password,$row['password'])){
            header("location:modify.php");
            exit();
    }
    else{
        $error="password sbagliata";
    }
}else{
    $error="username o password sbagliati";
    }
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/StyleLogin.css">
    <script src="Javascript/scripts.js"></script>
</head>

<body onload="EsciDallaPagina()">
    <div id="id01" class="modal">
        <form class="modal-content animate" action="" method="post">
            <div class="imgcontainer">
                <span onclick=" window.history.back()" class="close" title="Close Modal">&times;</span>
            </div>
            <div class="container">
                
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                <button type="submit" name="ok">Login</button>
                <div> <?php echo $error; ?></div>
            </div>
        </form>
    </div> 
</body>
</html>
