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
</body>
  </html>
  <?php
include("../dal.php");
if(!isset($_GET['ok'])){
$conn=DataConnect();
$firstTime=false;
$word=$_GET['search2'];
$sql = "SELECT s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
inner join tipologie t on t.IdT=s.FK_Tipologia where nome='".$word."'";
echo CercaParole($sql);
$sql="SELECT s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
inner join tipologie t on t.IdT=s.FK_Tipologia where significato LIKE '%".$word."%'";
if(!empty(RicercaNelSignificato($sql,$word)))
{
  echo RicercaNelSignificato($sql,$word);
}}else{
  $word=Trim($_GET['search2']);
  $regex= "/([^A-z'])/";
  if(preg_match($regex, $word)||empty($word)){
   header("Location:errore.php?msg=la tua ricerca per ".$word." non ha prodotto risultati");
  }
  else{
    header("Location:parola.php?search2=".$_GET['search2']);  
    exit();
  }
}


?>