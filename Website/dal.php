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
$query = "SELECT * FROM parole limit 100 ";
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

function Modificariga($id,$word,$type,$mean){
$conn=DataConnect();
$query= "UPDATE parole SET Nome='".$word."', Abbreviazione='".$type."', significato='".$mean."' WHERE Id=".$id."";
$return="";
if($conn->query($query)===true){
 $return="modifica eseguita con successo";
}
else{
    $return="modifica non eseguita";
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

?>