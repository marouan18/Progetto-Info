
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="CSS/Stylesheet.css"> 
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
<form class="example" action="/action_page.php" style="margin:auto;max-width:500px;">

        <input type="text" placeholder="search" name="search2">
        <button type="submit" ><i class="fa fa-search"></i></button>
    </form>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dictionary";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM parole where nome='Aam' ";
$result = $conn->query($sql);
if($result->num_rows > 0 ){
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "significato: " . $row["significato"]. " - Name: " . $row["Nome"]. " " . $row["Abbreviazione"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<br><br>
<h1 style=" font-size:30px;color: rgb(11, 103, 223);"> THE WORDS OF THE DAY</h1>  
<div class="container">
        <h2 style="text-align:left; color: rgb(11, 103, 223);">Abacus</h2>
        <p style="color: rgb(11, 103, 223);">noun</p>
        <p>A tablet, panel, or compartment in ornamented or mosaic work.</p>
    </div>
    <div class="container">
        <h2 style="text-align:left;color: rgb(11, 103, 223);">Abacus</h2>
        <p style="text-align:left;color: rgb(11, 103, 223);">noun</p>
        <p style="text-align:left;">A tablet, panel, or compartment in ornamented or mosaic work.</p>
    </div>

  </body>
</html>
