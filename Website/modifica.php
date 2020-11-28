<?php
session_start();
include_once("session.php");
include_once("dal.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST['conferma'])){
    $word=$_POST['voce'];
    $type=$_POST['type'];
    $mean=$_POST['mean'];
    echo "<script type='text/javascript'>alert(".Modificariga($_SESSION['id'],$word,$type,$mean).");</script>"; 
    header("location:modify.php");
    exit();
}
else{
    header("location:modify.php");
    exit();
}}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/StyleLogin.css">
    <script src="Javascript/scripts.js"></script>
</head>
<body onload="EsciDallaPagina()">
    <div id="id01" class="modal">
        <form class="modal-content animate" action="" method="post">
            <div class="imgcontainer">
                <span onclick=" window.history.back()" class="close" title="Close Modal">&times;</span>
            </div>
            <div class="container">
                
                <label for="voce"><b>Voce</b></label>
                <input type="text" name="voce" value="<?php echo CaricaRiga($_SESSION['id'])['Nome'];?>" required>
                <label for="type"><b>Tipologia</b></label>
                <input type="text" placeholder="Enter word type" name="type" value="<?php echo CaricaRiga($_SESSION['id'])['Abbreviazione'];?>" required>
                <label for="mean"><b>Significato</b></label>
                <input type="text" placeholder="Enter meaning" name="mean" value="<?php echo CaricaRiga($_SESSION['id'])['significato'];?>" required>
                <button style="width:49%;" type="submit" name="annulla">Annulla</button>
                <button style="width:49%;"type="submit" name="conferma">Conferma</button>
            </div>
        </form>
    </div> 
</body>
</html>
