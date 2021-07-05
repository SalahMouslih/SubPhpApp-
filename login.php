<?php
include "connection.php" ;


if (isset($_POST['login'])){
    $entered_email = $_POST["email"];
    $entered_password = $_POST["pwd"];
    $pw=md5($entered_password); //hashage du mdp entré avec md5


$sql = "SELECT * FROM insc WHERE email='{$entered_email}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
       if ($row['isaccepted']==1){ //si la demande de l'utilisateur est acceptée par l'admin
            if($row['passwords']==$pw){
                if ($row['isadmin']==1){ // il s'agit d'un admin
                    session_start();
                            
            
                    $_SESSION["id"] = $row["id"];                            
                    $_SESSION["email"] = $row["email"];                            
                    $_SESSION["nom"] = $row["nom"];    
                    $_SESSION["prenom"] = $row["prenom"];    
                                            
                        

                    // Redirection de l'admin vers son pannel
                    header("location: pannel.php");                }
                else{
                    session_start();
                            
                    // Store data in session variables
                    $_SESSION["id"] = $row["id"];                            
                    $_SESSION["email"] = $row["email"];                            
                    $_SESSION["nom"] = $row["nom"];    
                    $_SESSION["prenom"] = $row["prenom"];    
                                            
                        

                    // Redirection de l'utilisateur vers son profil
                    header("location: profile.php");
                }
            }
            else{
               echo  "<div class='message'> Mot de passe incorrecte</div>";   
            }
        }
        else{
            echo  "<div class='messagenv'> Compte en cours de vérification </div>";
        }
    }
    else{
        echo  "<div class='message'> Ce compte n'existe pas</div>";   

    }

}


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<script>
    $(document).on('click', '.toggle-password', function() {

$(this).toggleClass("fa-eye fa-eye-slash");

var input = $("#pwd");
input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
</script>




<!doctype html>
<html>
<head>
	<title>Connection</title>
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
.message {
  margin: 20px auto;
  border:0.3px solid rgb(220,192,195);
  padding: 6px;
  background: rgb(254,219,223);
  border-radius: 5px;
  width: 30%;
  color:rgb(179,98,101);
  position: relative;
}
.msg {
    
    margin: 20px auto;
    border:0.3px solid rgb(96, 148, 180);
    padding: 6px;
    background: rgb(173,217,229);
    border-radius: 5px;
    width: 30%;
    color:rgb(12, 116, 140);
    position: relative;
}
.logform{
    border-radius:7px;
    width: 30%;
    background: white;
    position: absolute;
    top: 300px;
    left: 35%;
    box-shadow: 0px 2px 5px grey;

}
.eye {
    color:grey;
  float: center;
  margin-left: -26px;
  margin-top: 6px;
  position: relative;
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
    top:630px;
    left:45%;
}
.pwd{
    color:grey;
    font-size:11px;
    text-decoration:underline;
    position: absolute;
    top:195px;
    left:62%;
}


</style>
<?php
if(isset($_GET["message"])){
    $message=$_GET["message"];
}
 if(isset($message)) { echo "<div class='msg'>".$message."</div>"; 
} 
?>
</body>
<div class="logform">

<form name="login" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post">
<h2> Connection </h2>


        <input type="email" name="email" id="email" placeholder="Email" required> <br><br>
        <input type="password" name="pwd" id="pwd" required placeholder="Mot de passe"> <span toggle="#password-field" class="fa fa-fw fa-eye eye toggle-password"></span>
        <a class="pwd" href="forgotpwd.php"><i>Mot de passe oublié?</i></a><br><br><br>
        <button type="submit" name="login" class="btn">Login</button>
        <button type="button" onclick="location. href='acceuil.php';">Retour</button><br><br>



</form>
</div>
<div class="nv"> Nouveau membre? <a href="index-inscription.php">inscrivez-vous</a></div>

</body>
</html>