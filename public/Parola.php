<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/Stylesheet.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../Javascript/scripts.js"></script>
</head>
<body>
<?php $param="Login";require("../header.php"); ?>
<br><br>
</body>
  </html>
  <?php
include("../dal.php");
if(!isset($_GET['ok'])){
$conn=DataConnect();
$firstTime=false;
$word=$_GET['search2'];
echo CercaParole($word);
if(!empty(RicercaNelSignificato($word)))
  echo RicercaNelSignificato($word);
}else{
  $word=Trim($_GET['search2']);
  $regex= "/([^A-z'])/";
  if(preg_match($regex, $word)||empty($word)){
   header("Location:errore.php?msg=impossibile cercare la parola ".$word." inserire solo caratteri dell'alfabeto");
   exit();
  }  else if(strlen($word)<2){
    header("Location:errore.php?msg=inserire una parola non una lettera");
    exit();}  
  else{
    header("Location:parola.php?search2=".$_GET['search2']);  
    exit();
  }
}


?>