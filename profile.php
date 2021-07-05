<?php
include "connection.php";
session_start();

if(isset($_SESSION["email"])){
    $uemail=$_SESSION["email"];
    $unom= $_SESSION["nom"];
    $uprenom= $_SESSION["prenom"];
    $uid= $_SESSION["id"];
    $fullname = $uprenom . "  " . $unom;
    $sql="SELECT * FROM insc where id='{$uid}'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $umatricule= $row["matricule"];
    $ufiliere=$row["filiere"];
    $univeau = $row["niveau"] ;
    $ucycle = $row["cycle"] ;
    $usexe = $row["sexe"] ;
    $udn = $row["date_naiss"];
    $udi = $row["date_insc"];
    $age = date_diff(date_create($udn), date_create('today'))->y; 

    $imgname = $univeau ."_". $umatricule ."_". $ufiliere. '.jpg';
    $otherfilesname = $univeau . "_" . $umatricule . "_" . $ufiliere . "_" . $unom . ".jpg";
    $imgpath = "/imagets/$imgname";
    $cinpath = "/cin/$otherfilesname";
    $bacpath = "/fichiersbac/$otherfilesname";
    $attpath = "/attestations/$otherfilesname";

    




}
else{
    header("location:login.php");
}

?>

<script>
    // fonction qui permet d'afficher et masquer une division
    function toggle(e) {
        var det = document.getElementById('det');
        if (det.style.display == 'block') {
            det.style.display = 'none';

            document.getElementById(e.id).value = 'Afficher Details';
        }
        else {
            det.style.display = 'block';
            document.getElementById(e.id).value = 'Masquer Details';
        }
    }



</script>


<?php
if(isset($_GET["message"])){
    $message=$_GET["message"];
}
 if(isset($message)) { echo "<div class='success'>".$message."</div>"; 
} 



?>

<!Doctype html>
<head>
    <title>Profil</title>

    <meta charset="UTF-8">
    <link rel="icon" href="images/inseainsc.png">

</head>
<style type="text/css">

body {
    background: lightgrey;
    font-family: Helvetica;
    font-size: 15px;
    text-align: center;
    color: black;
}

.message{
    margin: 70px auto;
    padding: 25px;
    background: #fff;
    border-radius: 5px;
    width: 30%;
    display:block;
    position: relative;
}

.success {
    
  margin: 20px auto;
  border:0.3px solid rgb(96, 148, 180);
  padding: 6px;
  background: rgb(173,217,229);
  border-radius: 5px;
  width: 30%;
  color:rgb(12, 116, 140);
  position: relative;
  animation: hide 0.3s linear 3s 1 forwards;
}
@keyframes hide {
    to {
        opacity: 0;
    }
}
.container {
    width: 700px;
    margin: 40px;
    border-radius: 8px;
    background: white;
    position: relative;
    display: inline-block;
    padding: 30px;
    box-shadow: 0px 2px 5px grey;
}
.btn {
    background-color: #800020;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: #ffffff;
    font-size: 15px;
    font-weight: bold;
    padding: 8px 19px;
    float: right;
    position: relative;
    
}
.upd {
    background-color: #599bb3;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: #ffffff;
    font-size: 15px;
    font-weight: bold;
    padding: 8px 10px;
    text-decoration: none;

    
}
.del{
    background-color: grey;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: #ffffff;
    font-size: 15px;
    font-weight: bold;
    padding: 8px 10px;
    text-decoration: none;
    
}
.infos{
    font-size:110%;
    
}
a{
    text-decoration: underline;
    font-size: 80%;
    color:black;

}
.img {  
    object-fit: cover;
    height:180px;
    width:180px;
    border:5px solid #599bb3;
    border-radius: 50%;
}
#details{
    border:none;
    background:transparent;
    cursor: pointer;
    text-decoration:underline;
    color:#599bb3;

}

</style>

<body>
    <div class="container">
        <button id="button" type="button" class="btn" onclick="location. href='logout.php';">Déconnection</button>
        <br><br><br><br>

        <p>
        <?php
        
        echo "<img class='img' alt= $fullname src='$imgpath'>";
        ?>
        </p>


        <div class='infos'>
            
        <p><?php echo " $fullname, <strong> $age </strong>" ?> </p> 
        <p> <strong> Email: </strong>  <?php echo $uemail?></p>

        </div>

        <p>
    	<input type="button" value="Afficher Details" id="details" onclick="toggle(this)">
    </p>
    <div class='infos'>

    <!--la division concernée par la fonction. elle a display comme none -->
        <div style="display:none" id="det"> 
            <p> <strong> <?php echo $usexe ?> </strong>  </p>

         <p> <strong> Date de naissance : </strong> <?php echo $udn ?> </p> 
         <p> <strong> Matricule : </strong> <?php echo $umatricule ?> </p>
         <p> <strong> Cycle : </strong> <?php echo $ucycle ?> </p>
         <p> <strong> Filière : </strong> <?php echo $ufiliere ?> </p>
         <p> <strong> Niveau : </strong> <?php echo $univeau ?> </p> 
         <p> <strong> Date d'inscription : </strong> <?php echo $udi ?> </p> 
         <p> <strong> CIN : </strong> <a href="<?php echo $cinpath?>" target="new">cliquez ici </a></p> 
          <p> <strong> Copie du Bac : </strong> <a href="<?php echo $bacpath?>" target="new">cliquez ici</a> </p> 
         <p> <strong> Attestaion : </strong> <a href="<?php echo $attpath?>" target="new">cliquez ici</a> </p> 


      </div>
    </div>

        <br><br>
        <p>
        <button type="button" class="upd"> <a class="upd" href='updatemember.php?id=<?php echo $uid ?>'>Modifier</a></button>
        <button type="button" class="del"  onclick="return confirm('Vous voulez vraiment supprimer votre compte')"> <a class="del" href='deletemember.php?id=<?php echo $uid ?>'>Supprimer</a></button>
        <p>
            
     </div>
</body>
</html>

