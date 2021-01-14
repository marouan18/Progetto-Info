<?php
function DataConnect(){
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "dictionary";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
  die("Connection failed: " . $conn->connect_error);
return $conn;
}

function Login($usr,$pass){
  $errore="";
  $conn=DataConnect();
  $query = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $usr); 
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows>0){
      $row=$result->fetch_assoc();
      if(password_verify($pass,$row['password'])){
          $_SESSION['login'] =$usr;    
          header("location:Admin");
              exit();
      }
      else
          $errore="password sbagliata";
  }else
      $errore="username o password sbagliati";
  $conn->close();
  return $errore;
}
function Caricaretabella($parola){
$conn=DataConnect();
$startTime=microtime(true);
$variabile="";
if($parola=="nome") $variabile="'nome'";
else $variabile="nome";
  $query = "SELECT  s.Id, s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
  left join tipologie t on t.IdT=s.FK_Tipologia where ".$variabile." like ? limit 15";
$stmt = $conn->prepare($query);
$stmt->bind_param('s',$parola); 
$stmt->execute();
$result= $stmt->get_result();
$numrighe=$result->num_rows;
$endTIme=microtime(true);
if($numrighe>0){
while($row = $result->fetch_assoc()){
echo " <tr> <th scope='row'>".$row['Id']."</th>";
echo "<td>".$row['Nome']."</td>";
echo "<td>".$row['Tipologia']."</td>";
echo "<td>".$row['significato']."</td> </tr>";
}}
else{
  header("Location:erroreprivato?msg=parola non trovata");
  exit();
}
$conn->close();
return $endTIme-$startTime;
}

function aggiungiAdmin($usr,$pass){
$conn=DataConnect();
$username=$usr;
$password=$pass;
$hash=password_hash($password,PASSWORD_DEFAULT);
$query = "insert into users(username,password) values(?,?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss',$username, $hash); 
$stmt->execute();
try{
   $stmt->get_result();
   $conn->close();
}
catch(Exception $e){
    echo $e;
}}

function EliminaRiga($id){
$msg="";
$conn=DataConnect();
$query= "DELETE FROM sostantivi where Id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param('d',$id); 
return  OperazioneRiga($stmt);
}

function OperazioneRiga($conn){
$return=0;
$status=$conn->execute();
if($status===false)
  $return="Operazione non eseguita";
else
  $return="Operazione eseguita con successo";
$conn->close();
return $return;
}
function CaricaRiga($id){
    $conn=DataConnect();
    $stmt = $conn->prepare( "SELECT s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
    inner join tipologie t on t.IdT=s.FK_Tipologia  where Id=?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $conn->close();
    return $row;  
}

function CercaParole($word){
  $conn=DataConnect();
  $query="SELECT s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
  inner join tipologie t on t.IdT=s.FK_Tipologia where nome=?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('s', $word);
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
  if($numrighe>0)
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
    $html.= "<br><br><h3>la parola ".$word." non è stata trovata</h3>";
   }
   $conn->close();
  return $html;
}
function RicercaNelSignificato($word){
  $conn=DataConnect();
  $word1='%'.$word.'_';
  $word2='%'.$word;
  $query="SELECT s.Nome, t.Type as Tipologia, s.significato FROM sostantivi s 
  inner join tipologie t on t.IdT=s.FK_Tipologia where (significato LIKE ? or  significato LIKE ?) limit 10";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('ss', $word1,$word2); 
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
  $conn->close();
   return $html;
  }

  function countRows(){
    $conn=DataConnect();
    $stmt = $conn->prepare("SELECT count(*) as 'count' FROM `sostantivi`");
    $stmt->execute();
    $result = $stmt->get_result();
    $row=$result->fetch_assoc();
    $conn->close();
    return intval($row['count']);
  }

  function esistenzaId($Id){
    $conn=DataConnect();
    $stmt = $conn->prepare("SELECT Id FROM `sostantivi` where Id=?");
    $stmt->bind_param('d', $Id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $risultato="";
    if($result->num_rows>0)
      $risultato="bene";
    else
      $risultato="male";
    $conn->close();
    return $risultato;
  }

  function modificariga($word,$mean,$type,$Id){
    $conn=DataConnect();
    $sql= "UPDATE sostantivi s SET s.Nome=?, s.significato=?, s.FK_Tipologia=(select t.IdT from tipologie t where t.Type=?) 
    WHERE s.Id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssd', $word,$mean,$type,$Id);
    return  OperazioneRiga($stmt);
  }
  function aggiungereriga($word,$mean,$type){
    $conn=DataConnect();
    $sql= "INSERT INTO sostantivi(Nome,FK_Tipologia,significato) values( ?,(select t.IdT from tipologie t where t.Type=?), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $word,$type,$mean); 
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
    $conn->close();
    return $html;
  }
?>