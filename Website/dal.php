<?php
function DataConnect(){
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dictionary";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
return $conn;
}

function Caricaretabella(){
$conn=DataConnect();
$query = "SELECT * FROM parole";
$result = $conn->query($query);
while($row = $result->fetch_assoc()){
echo " <tr> <th scope='row'>".$row['Id']."</th>";
echo "<td>".$row['Nome']."</td>";
echo "<td>".$row['Abbreviazione']."</td>";
echo "<td>".$row['significato']."</td> </tr>";
}}

function aggiungiAdmin($usr,$pass){
$conn=DataConnect();
$username=$usr;
$password=$pass;
$hash=password_hash($password,PASSWORD_DEFAULT);
$query = "insert into users(username,password) values('$username','$hash')";
try{
$result = $conn->query($query);
}
catch(Exception $e){
    echo $e;
}}

function EliminaRiga($id){
$conn=DataConnect();
$query= "DELETE FROM parole where Id=$id";
$result=$conn->query($query);
if ($conn->affected_rows==1) {
    echo "<script type='text/javascript'>alert('riga eliminata con successo');</script>";
    } else {
    echo "<script type='text/javascript'>alert('Id non trovato');</script>"; 
    } 
  $conn->close();
}

function OperazioneRiga($query){
$conn=DataConnect();
$return="";
if($conn->query($query)===true){
 $return="Operazione eseguita con successo";
}
else{
    $return="operazione non eseguita";
}
$conn->close();
return $return;
}
function CaricaRiga($id){
    $conn=DataConnect();
    $query= "SELECT * FROM parole where id=$id";
    $result=$conn->query($query);
    $row=$result->fetch_assoc();
    return $row;  
}

function CercaParole($query){
 
  $conn=DataConnect();
  $result = $conn->query($query);
  $html="";
  if($result->num_rows > 0 )
  {
  $row = $result->fetch_assoc();
  $html.= "<h3>".$row['Nome']." ".$row['Abbreviazione']."</h3>";
  $html.= " <div>";
  $splitted=explode(";",$row['significato']);
  for($i=0;$i<count($splitted);$i++)
  {
    $J=$i+1;
    $html.= " <p>".$J." : ".$splitted[$i]. "</p>";  
  }
  $html.= "</div><br><hr>";
  if($row = $result->fetch_assoc())
  {
    $html.= "<h3> more definitions for ".$row['Nome']."</h3><br><br> ";
  // output data of each row
    while($row = $result->fetch_assoc()) {
      $html.= "<h3>".$row['Nome']." ".$row['Abbreviazione']."</h3><div>";
      $splitted=explode(";",$row['significato']);
  for($i=0;$i<count($splitted);$i++)
  {
    $J=$i+1;
    $html.= "<p>".$J." : ".$splitted[$i]. "</p>";  
  }
  $html.= "</div><br><hr>";
    }
  }else {
    $html.= "parola non trovata";
   }}
  return $html;
}
?>