<?php
session_start();
include_once("session.php");
include_once("../dal.php");
if(esistenzaId($_SESSION['id'])=="male"){
    echo "<script type='text/javascript'>alert(Id non esistente);</script>"; 
    header("location:Admin");
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['conferma'])){
        $word=$_POST['voce'];
        $type=$_POST['type'];
        $mean=$_POST['mean'];
        $sql= "INSERT INTO parole(Nome,Tipologia,significato) values( '".$word."', '".$type."', '".$mean."')";
        echo "<script type='text/javascript'>alert(".OperazioneRiga($sql).");</script>"; 
        header("location:Admin");
        exit();
    }else{
        header("location:Admin");
        exit();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/Style.css">
    <script src="../Javascript/scripts.js"></script>
</head>
<body onload="EsciDallaPagina()">
    <div id="id01" class="modal">
        <form class="modal-content animate" action="" method="post">
            <div class="imgcontainer">
                <span onclick=" window.history.back()" class="close" title="Close Modal">&times;</span>
            </div>
            <div class="container">
                
                <label for="voce"><b>Voce</b></label>
                <input type="text" placeholder="enter word" value="Voce" name="voce"required>
                <label for="type"><b>Tipologia</b></label>
                <input type="text" placeholder="enter word type" value="Tipo" name="type"required>
                <label for="mean"><b>Significato</b></label>
                <input type="text" placeholder="enter meaning" value="significato"name="mean" required>
                <button style="width:49%;" type="submit" name="annulla">Annulla</button>
                <button style="width:49%;"type="submit" name="conferma">Conferma</button>
            </div>
        </form>
    </div> 
</body>
</html>
