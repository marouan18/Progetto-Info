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
<br>
<form class="example"  method="GET" style="margin:auto;max-width:500px;">

        <input id="id1" type="text" placeholder="search" name="search2">
        <button  type="submit" name="ok"  ><i class="fa fa-search"></i></button>
    </form>

</body>
  </html>
  <?php
include("database.php");
if(!isset($_GET['ok'])){
$firstTime=false;
$word=$_GET['search2'];
$sql = "SELECT * FROM parole where nome='".$word."'";
$result = $conn->query($sql);
if($result->num_rows > 0 ){
$row = $result->fetch_assoc();
echo "<h3>".$row['Nome']." ".$row['Abbreviazione']."</h3>";
echo "<div>";
$splitted=explode(";",$row['significato']);
for($i=0;$i<count($splitted);$i++)
{
    echo "<p>".$i." : ".$splitted[$i]. "</p>";  
}
echo "</div><br><hr>";
if($row = $result->fetch_assoc()){
  echo "<h3> more definitions for ".$row['Nome']."</h3><br><br> ";
// output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<h3>".$row['Nome']." ".$row['Abbreviazione']."</h3><div>";
    $splitted=explode(";",$row['significato']);
for($i=0;$i<count($splitted);$i++)
{
    echo "<p>".$i." : ".$splitted[$i]. "</p>";  
}
echo "</div><br><hr>";
  }

}
} else {
  echo "0 results";
}
}else{

}


?>