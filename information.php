<?php
include "connection.php";
session_start();

if(isset($_GET['id'])&& isset($_SESSION["email"])){
    $uid=$_GET['id'];
    $sql="SELECT * FROM insc where id='{$uid}'";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    
    if($row["isaccepted"]==1){
    $unom=$row["nom"];
    $uprenom=$row["prenom"];
    $fullname = $uprenom . "  " . $unom;
    $uemail=$row["email"];
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
        exit("erreur");
    }
}
else{
    header("location:login.php")  ;            
}
?>

<!Doctype html>
<head>
	<title>Informations</title>
    <meta charset="utf-8">
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

.infos{
    font-size:110%;
    
}
.retour {
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
    <br>
    <div class="container">
        

        <p>
        <?php
        
        echo "<img class='img' alt= $fullname src='$imgpath'>";
        ?>
        </p>


        <div class='infos'>
            
        <p><?php echo " $fullname, <strong> $age </strong>" ?> </p> 
        <p> <strong> Email: </strong>  <?php echo $uemail?></p>


    
    
    <div id="det"> 
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





    
    
        <br><br>
        <p>
        <button type="button" class="retour"> <a class="retour" href='pannel.php'>Retour</a></button>
        <p>
            
        </div>
