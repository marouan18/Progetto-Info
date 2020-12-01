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
<h1 class="Titolo">
        If you are bored, you are in the right place😁
</h1>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
  <i class="Nome">My Dictionary</i>
  <ul class="navbar-nav ml-auto">
    <li class="active">
      <a class="nav-link" href="../Private/Login">Login</a>
    </li>
  </ul>
</nav>
<br>
<form class="example"  method="GET" style="margin:auto;max-width:500px;">
        <input id="id1" type="text" placeholder="search" name="search2">
        <button  type="submit" name="ok"  ><i class="fa fa-search"></i></button>
    </form>

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
    echo "<script type='text/javascript'>alert('la tua ricerca per '+$word+' non ha prodotto risultati');</script>";
  }
  else{
    header("Location:parola.php?search2=".$_GET['search2']);  
    exit();
  }
}


?>