<?php
session_start();
include_once("session.php");
include_once("../dal.php");
if(esistenzaId($_SESSION['id'])=="male"){
  header("Location:../errore.php?msg=Id non esistente");
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST['conferma'])){
    $word=$_POST['voce'];
    $type=$_POST['type'];
    $mean=$_POST['mean'];
  //  $sql= "UPDATE sostantivi s SET s.Nome='".$word."', s.significato='".$mean."', s.FK_Tipologia=(select t.IdT from tipologie t where t.Type='".$type."') 
   // WHERE s.Id=".$_SESSION['id']."";
    $messaggio=modificariga($word,$mean,$type,$_SESSION['id']);
 //   echo "<script type='text/javascript'>alert(".OperazioneRiga($sql).");</script>"; 
    header("location:../errore.php?msg=".$messaggio);
    exit();
}
else{
    header("location:Admin");
    exit();
}}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/Style.css">
    <script src="../Javascript/scripts.js"></script>
</head>
<?php require("PrivateTemplate.php")?>
                <label for="voce"><b>Voce</b></label>
                <input type="text" name="voce"value="<?php echo CaricaRiga($_SESSION['id'])['Nome'];?>" required>
                <label for="type"><b>Tipologia</b></label>
                <?php echo Tipologie();?>
                <label for="mean"><b>Significato</b></label>
                <input type="text" placeholder="Enter meaning" name="mean" value="<?php echo CaricaRiga($_SESSION['id'])['significato'];?>" required>
                <button style="width:49%;" type="submit" name="annulla">Annulla</button>
                <button style="width:49%;"type="submit" name="conferma">Conferma</button>
            </div>
        </form>
    </div> 
</body>
</html>
