<?php
session_start(); 

function Caricaretabella(){
include_once("database.php");
$query = "SELECT * FROM parole limit 100 ";
$result = $conn->query($query);
while($row = $result->fetch_assoc()){
$row=$result->fetch_assoc();
echo " <tr> <th scope='row'>".$row['Id']."</th>";
echo "<td>".$row['Nome']."</td>";
echo "<td>".$row['Abbreviazione']."</td>";
echo "<td>".$row['significato']."</td> </tr>";
}}
?>