<?php
include_once("dal.php");
$DbRows=countRows();
$Random1= rand(0,$DbRows);
$Random2= rand(0,$DbRows);
$Riga1=CaricaRiga($Random1);
$Riga2=CaricaRiga($Random2);
if(isset($_GET['ok'])){
  $word=Trim($_GET['search2']);
  $regex= "/([^A-z '])/";
  if(preg_match($regex, $word)||empty($word)){
    header("Location:errore.php?msg=la tua ricerca per ".$word." non ha prodotto risultati");
    exit();}
  else{
    header("Location:public/parola.php?search2=".$_GET['search2']);  
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="CSS/Stylesheet.css">   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="Javascript/scripts.js"></script>
</head>
<body>
  
  <?php $param="Login"; require("header.php"); ?>
  <br><br>
  <h1 id="Paroloni"> DID YOU KNOW?</h1>  
  <br><br>
  <div class="container">
          <h2 ><?php echo $Riga1['Nome'] ?></h2>
          <p class="paragrafi"><?php echo $Riga1['Tipologia'] ?></p>
          <p><?php echo $Riga1['significato'] ?></p>
      </div>
      <div class="container">
          <h2 ><?php echo $Riga2['Nome'] ?></h2>
          <p class="paragrafi"><?php echo $Riga2['Tipologia'] ?></p>
          <p><?php echo $Riga2['significato'] ?></p>
      </div>
    </body>
  </html>
