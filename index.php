<?php
include_once("dal.php");
$DbRows=countRows();
$Random1= rand(0,$DbRows);
$Random2= rand(0,$DbRows);
if(isset($_GET['ok'])){
  $word=Trim($_GET['search2']);
  $regex= "/([^A-z '])/";
  if(preg_match($regex, $word)||empty($word)){
    echo "<script type='text/javascript'>alert('la tua ricerca per '+$word+' non ha prodotto risultati');</script>";
  }
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
  <link rel="stylesheet" href="css/Stylesheet.css">   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="Javascript/scripts.js"></script>
</head>
<body>
<h1 class="Titolo">
        If you are bored, you are in the right place😁
</h1>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
  <i class="Nome">My Dictionary</i>
  <ul class="navbar-nav ml-auto">
    <li class="active">
      <a class="nav-link" href="Private/Login">Login</a>
    </li>
  </ul>
</nav>
<br>
<form class="example"  method="GET" style="margin:auto;max-width:500px;">
        <input id="id1" type="text" placeholder="search" name="search2">
        <button  type="submit" name="ok"  ><i class="fa fa-search"></i></button>
    </form>
  <br><br>
  <h1 id="Paroloni"> DID YOU KNOW?</h1>  
  <br><br>
  <div class="container">
          <h2 ><?php echo CaricaRiga($Random1)['Nome'] ?></h2>
          <p class="paragrafi"><?php echo CaricaRiga($Random1)['Tipologia'] ?></p>
          <p><?php echo CaricaRiga($Random1)['significato'] ?></p>
      </div>
      <div class="container">
          <h2 ><?php echo CaricaRiga($Random2)['Nome'] ?></h2>
          <p class="paragrafi"><?php echo CaricaRiga($Random2)['Tipologia'] ?></p>
          <p><?php echo CaricaRiga($Random2)['significato'] ?></p>
      </div>
    </body>
  </html>
