<?php
include "connection.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_GET['vkey'])){// si la clé de vérification est passée par GET
    $uvkey = $_GET['vkey'];

    $sql = "SELECT * FROM insc WHERE vkey ='{$uvkey}' ";
    $result = mysqli_query($conn, $sql);
    $_SESSION['result']=$result;
    $_SESSION['key']=$uvkey;


}

if ($_SESSION['result']) { //si la clé est trouvée 

        if(isset($_POST['Valider'])){
            $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
            $pwd2 = mysqli_real_escape_string($conn,$_POST['pwd2']);
            $letter = preg_match('@[a-z]@', $pwd);
            $number = preg_match('@[0-9]@', $pwd);
            
            if( !$letter || !$number  || strlen($pwd) < 8) {
                echo "<div class='fail'>Mot de passe doit contenir au moins 8 caractéres, un chiffre et une lettre </div>";
            }
            else{
           
           if($pwd!=$pwd2){ //on vérifie si les deux champs du mdp sont identiques
                echo "<div class='fail'> Champs non identiques</div>";

            }
            else{
            $vkey = md5(time().$email); //génération d'une nouvelle clé pour des raisons de sécurité
            $pwd=md5($pwd); //hashage du mdp avec md5
            $sql = "UPDATE  insc SET  passwords = '{$pwd}' , vkey='{$vkey}' , verified=1  WHERE vkey='{$_SESSION['key']}'";

            if (mysqli_query($conn, $sql))
            {            
                
                header("location:verified.php"); 
                }
    
            
            else{
                echo "Erreur: (" . $sql. ") " . "<br>" . mysqli_error($conn);
                }
            }
        }
    }
    }
        
        else{
             exit("Erreur");
            }
   

?>

<!doctype html>
<html>
<head>
    <title>Vérfication</title>

    <meta charset="utf-8">
    <link rel="icon" href="images/inseainsc.png">

    <style type="text/css">
    

body{
    background-color:lightgrey;
    font-family:Helvetica;
    text-align:center;
}
.messagenv {
  margin: 20px auto;
  padding: 6px;
  border:0.3px solid rgb(255,186,0);
  background: rgb(255,223,0);
  border-radius: 5px;
  width: 30%;
  color:rgb(156,135,14);
  position: relative;
  
}
.fail {
  margin: 20px auto;
  border:0.3px solid rgb(220,192,195);
  padding: 6px;
  background: rgb(254,219,223);
  border-radius: 5px;
  width: 30%;
  color:rgb(179,98,101);
  position: relative;
}

.logform{
    border-radius:7px;
    width: 30%;
    background: white;
    position: absolute;
    top: 30%;
    left: 35%;
    box-shadow: 0px 2px 5px grey;

}

form{
    background-color:white;
    border-radius:7px;
    padding: 1.5em;
  
}

h2{
    font-size:200%;
    color:#525252;}
input{
    width:70%;
    border:none;
    padding: 8px;
    background-color :#f6f6f6f6;}

.btn
{  background-color:#599bb3;
    border:none;
	border-radius:5px;
	cursor:pointer;
	color:#ffffff;
	font-size:15px;
	font-weight:bold;
	padding:8px 19px;}

button{
    background-color:grey;
    border:none;
	border-radius:5px;
	cursor:pointer;
	color:#ffffff;
	font-size:15px;
	font-weight:bold;
    padding:8px 19px;}
    
.nv{
    color:#525252;
    font-size:11px;
    position: absolute;
    top:64.5%;
    left:45%;
}

</style>

</body>
<br>
<div class="logform">
<br><p></p><br>
<form name="login" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post">

        <input type="password" name="pwd" id="pwd" required placeholder="Mot de passe"> <br><br>
        <input type="password" name="pwd2" id="pwd2" required placeholder="Confirmer Mot de passe"> <br><br><br>
        <button type="submit" name="Valider" class="btn">Valider</button>



</form>
</div>

</body>
</html>