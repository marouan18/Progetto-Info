<?php
session_start();
include_once("session.php");
include_once("../dal.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['conferma'])){
        $word=$_POST['voce'];
        $type=$_POST['type'];
        $mean=$_POST['mean'];
        $messaggio= aggiungereriga($word,$mean,$type);
        header("location:erroreprivato?msg=".$messaggio);
        exit();
    }else{
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
                <input type="text" placeholder="enter word" value="Voce" name="voce"required>
                <label for="type"><b>Tipologia</b></label>
                <?php echo Tipologie();?>
                <label for="mean"><b>Significato</b></label>
                <input type="text" placeholder="enter meaning" value="significato"name="mean" required>
                <button style="width:49%;" type="submit" name="annulla">Annulla</button>
                <button style="width:49%;"type="submit" name="conferma">Conferma</button>
            </div>
        </form>
    </div> 
</body>
</html>
