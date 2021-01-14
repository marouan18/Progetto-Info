<?php
session_start();
include("session.php");
include_once("../dal.php");
$ok=true;
$_SESSION['nome']="nome";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['add'])){
    header("location:Aggiungi");
    exit();
  }
  $word=Trim($_POST['search2']);
  $regex= "/([^0-9'])/";
  if(preg_match($regex, $word)||empty($word)){
    header("Location:erroreprivato?msg=inserire Id corretto");
    exit();}
    else{
  if(isset($_POST['modify']))
  {
    $_SESSION['id']=$word;
    header("location:modifica");
    exit();
  }
  else{
    $messaggio=EliminaRiga($_POST['search2']);
    header("Location:erroreprivato?msg=".$messaggio);
  }}
  }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/styleAdmin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
</head>
<body>
<?php $param="Logout"; require("../header.php"); ?>
<label id="RicercaChiave">Ricerca Per Parola</label>
<br><br><br>
<div class="container">
  <div class="row header">
  </div>
  <table class="table" id="myTable" >
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Word</th>
      <th scope="col">Word Type</th>
      <th scope="col">Meaning</th>
    </tr>
  </thead>
  <tbody>
  <?php 
 if(isset($_GET['ok'])){
    $_SESSION['nome']=Trim($_GET['search2']);
    $regex= "/([^A-z'])/";
    if(preg_match($regex, $_SESSION['nome'])||empty($_SESSION['nome'])){
      header("Location:erroreprivato?msg=sono accettate solo lettere");
      exit();}
      else{
        $ok=true;
        $_SESSION['nome']= $_SESSION['nome'].'%';
  }}     
   if($ok){
    Caricaretabella($_SESSION['nome']);
    $ok=false;}
?>
  </tbody>
</table>    
</div>
<br>
<form class="example"method="POST" style="margin:auto;max-width:500px;">
<label >Inserire Id della parola da eliminare o modificare</label>
<input style="width:100%;" id="id1" type="text" placeholder="search" name="search2"><br>
<button style="width:33%;" class="btn btn-primary" type="submit" name="modify">Modifica</button>
<button style="width:33%;" class="btn btn-primary" type="submit" name="delete">Elimina</button>
<button style="width:33%;" class="btn btn-primary" type="submit" name="add">Aggiungi</button>
</form>
</body>
</html>

