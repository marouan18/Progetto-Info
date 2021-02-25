<?php
session_start();
$error="";
include_once("../dal.php");
$conn=DataConnect();
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username =$_POST['uname'];
$password =$_POST['psw'];
$error=Login($username,$password);

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/Style.css">
    <script src="../Javascript/scripts.js"></script>
</head>
<?php require("PrivateTemplate.php")?>                
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
