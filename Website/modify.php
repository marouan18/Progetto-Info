<?php
include("dal.php");
?>
<html lang="en">
<head>
<meta name="description" content="Bootstrap.">
<link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
   
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<body>
<h1 class="Titolo">
        If you are bored, you are in the right place😁
</h1>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
  <i class="Nome">My Dictionary</i>
  <ul class="navbar-nav ml-auto">
    <li class="active">
      <a class="nav-link" href="Login.php">Login</a>
    </li>
    <li class="active">
      <a class="nav-link" href="">Contact</a>
    </li>
    <li class="active">
      <a class="nav-link" href="">AboutUs</a>
    </li>
  </ul>
</nav>
<br><br><br>
<div class="container">
        <div class="row header">
        </div>
        <table id="myTable" class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Word</th>
      <th scope="col">Word Type</th>
      <th scope="col">Meaning</th>
    </tr>
  </thead>
  <tbody>
  <?php Caricaretabella()?>
  </tbody>
</table>    

</div>
</body>
<script>
$(document).ready(function() {
        $('#myTable').dataTable();
    });
</script>
</html>

