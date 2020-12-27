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
$query = "SELECT  s.Id, s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
left join tipologie t on t.IdT=s.FK_Tipologia  limit 500";
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
$msg="";
$conn=DataConnect();
$query= "DELETE FROM sostantivi where Id=$id";
$result=$conn->query($query);
if ($conn->affected_rows==1) {
    $msg="riga eliminata con successo";
    } else {
    $msg="Id non trovato"; 
    } 
  $conn->close();
  return $msg;
}

function OperazioneRiga($conn){
$return=0;
$status=$conn->execute();
if($status===true){
 $return="Operazione eseguita con successo";
}
else{
    $return="operazione non eseguita";
}
return $return;
}
function CaricaRiga($id){
    $conn=DataConnect();
    $stmt = $conn->prepare( "SELECT s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
    inner join tipologie t on t.IdT=s.FK_Tipologia  where Id=?");
    $stmt->bind_param('s', $id); // 's' specifies the variable type => 'string'
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    /*$query= "SELECT s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
    inner join tipologie t on t.IdT=s.FK_Tipologia  where Id=$id";
    $result=$conn->query($query);
    $row=$result->fetch_assoc();*/
    return $row;  
}

function CercaParole($word){
  $conn=DataConnect();
  $query="SELECT s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
  inner join tipologie t on t.IdT=s.FK_Tipologia where nome=?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $word); // 's' specifies the variable type => 'string'
  $stmt->execute();
  $result = $stmt->get_result();
  $html="";
  $numrighe=$result->num_rows;
  if($numrighe > 0 )
  {
    $numrighe--;
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
  if( $numrighe>0)
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
function RicercaNelSignificato($word){
  $conn=DataConnect();
  $word='%'.$word.'%';
  $query="SELECT s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
  inner join tipologie t on t.IdT=s.FK_Tipologia where significato LIKE ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $word); // 's' specifies the variable type => 'string'
  $stmt->execute();
  $result = $stmt->get_result();
  $html="";
  
  if($result->num_rows>0)
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
    $stmt = $conn->prepare("SELECT count(*) as 'count' FROM `sostantivi`");
    $stmt->execute();
    $result = $stmt->get_result();
   /* $sql="SELECT count(*) as 'count' FROM `sostantivi`";
    $result=$conn->query($sql);
    */$row=$result->fetch_assoc();
    return intval($row['count']);
  }
  function esistenzaId($Id){
    $conn=DataConnect();
    $stmt = $conn->prepare("SELECT * FROM `sostantivi` where Id=?");
    $stmt->bind_param('d', $Id); // 's' specifies the variable type => 'string'
    $stmt->execute();
    $result = $stmt->get_result();
   /* $sql="SELECT * FROM `sostantivi` where Id=".$Id;
    $result=$conn->query($sql);
    */$risultato="";
    if($result->num_rows>0){
      $risultato="bene";
    }
    else{
      $risultato="male";
    }
    return $risultato;
  }

  function modificariga($word,$mean,$type,$Id){
    $conn=DataConnect();
    $sql= "UPDATE sostantivi s SET s.Nome=?, s.significato=?, s.FK_Tipologia=(select t.IdT from tipologie t where t.Type=?) 
    WHERE s.Id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssd', $word,$mean,$type,$Id); // 's' specifies the variable type => 'string'
    return  OperazioneRiga($stmt);
  }
  function aggiungereriga($word,$mean,$type){
    $conn=DataConnect();
    $sql= "INSERT INTO sostantivi(Nome,FK_Tipologia,significato) values( ?,(select t.IdT from tipologie t where t.Type=?), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $word,$type,$mean); // 's' specifies the variable type => 'string'
    return OperazioneRiga($stmt);

  }
  function Tipologie(){
    $html=" <select name='type' id='types'>";
    $conn=DataConnect();
    $sql="select Type from tipologie";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row=$result->fetch_assoc()){
      $html.="<option value='".$row['Type']."'>".$row['Type']."</option>";
    }
    $html.="</select>";
    return $html;
  }
?>