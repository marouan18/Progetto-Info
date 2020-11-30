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
$query = "SELECT * FROM parole limit 500 ";
$result = $conn->query($query);
while($row = $result->fetch_assoc()){
echo " <tr> <th scope='row'>".$row['Id']."</th>";
echo "<td>".$row['Nome']."</td>";
echo "<td>".$row['Tipologia']."</td>";
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
$return=" ";
if($conn->query($query)===true){
 $return="Operazione eseguita con successo";
}
else{
    $return="operazione non eseguita";
}
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
  $html.= "<h2>".$row['Nome']." ".$row['Tipologia']."</h2>";
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
      $html.= "<h2>".$row['Nome']." ".$row['Tipologia']."</h2><div>";
      $splitted=explode(";",$row['significato']);
  for($i=0;$i<count($splitted);$i++)
  {
    $J=$i+1;
    $html.= "<p>".$J." : ".$splitted[$i]. "</p>";  
  }
  $html.= "</div><br><hr>";
    }
  }}else {
    $html.= "<br><br><h3>parola non trovata</h3>";
   }
  return $html;
}
function RicercaNelSignificato($query,$word)
{
  $conn=DataConnect();
  $result = $conn->query($query);
  $html="";
  
  if($result->fetch_row()>0)
  {
    $html.="<br><br><h3> ricerca per parola chiave</h3>";
  // output data of each row
    while($row = $result->fetch_assoc()) {
      $html.= "<h2>".$row['Nome']." ".$row['Tipologia']."</h2><div>";
      $splitted=explode(";",$row['significato']);
      $regex="/\b(".$word.")\b/";
  for($i=0;$i<count($splitted);$i++)
  {
    $J=$i+1;
    if(strpos($word,$splitted[$i])===false){
      $splitted2=explode(" ",$splitted[$i]);
      $html.="<p>".$J." : ";
      foreach($splitted2 as &$p){
        if(preg_match($regex, $p)){
        $html.="<b>".$p." </b>";
        }
        else{
          $html.=$p." ";
        }      
      }  
      $html.="</p>";
    }
    else{
    $html.= "<p>".$J." : ".$splitted[$i]. "</p>";  
  }}
  $html.= "</div><br><hr>";
    }
  }
   return $html;
  }

  function countRows(){
    $conn=DataConnect();
    $sql="SELECT count(*) as 'count' FROM `parole`";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    return intval($row['count']);
  }
  function esistenzaId($Id){
    $conn=DataConnect();
    $sql="SELECT * FROM `parole` where Id=".$Id;
    $result=$conn->query($sql);
    $risultato="";
    if($result->fetch_assoc()>0){
      $risultato="bene";
    }
    else{
      $risultato="male";
    }
    return $risultato;
  }
?>