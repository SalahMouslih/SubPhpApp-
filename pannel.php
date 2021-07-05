
<?php
include "connection.php";
session_start();

if(isset($_SESSION["email"])){
    $aemail=$_SESSION["email"];
    $anom= $_SESSION["nom"];
    $aprenom= $_SESSION["prenom"];
    $aid= $_SESSION["id"];
    $fullname = $aprenom . " " . $anom;

}

?>

<?php

if(isset($_GET["refus"])){
    $refus=$_GET["refus"];
}
 if(isset($refus)) { echo "<div class='refus'>".$refus."</div>"; } 

if(isset($_GET["message"])){
    $message=$_GET["message"];
}
 if(isset($message)) { echo "<div class='success'>".$message."</div>"; } 



?>

<!Doctype html>
<head>
    <title>Pannel</title>
    
    <meta charset="utf-8">
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
.refus {
    
    margin: 20px auto;
  border:0.3px solid rgb(220,192,195);
  padding: 6px;
  background: rgb(254,219,223);
  border-radius: 5px;
  width: 30%;
  color:rgb(179,98,101);
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
.adminwlcm{
    font-size:130%;

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
.site {
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
.add{
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
.demandes{
    
        width: 80%;
        margin-left:auto; 
        margin-right:auto;
        text-align: center;
        border-spacing: 0;

}

.demandes td, th{
    border-bottom: 0.2px solid grey;
    padding: 9px 9px;
}
  
.inscris{
    
    width: 80%;
    margin-left:auto; 
    margin-right:auto;
    text-align: center;
    border-spacing: 0;

}

.inscris td, th{
border-bottom: 0.2px solid grey;
padding: 9px 9px;
}

</style>

<body>

    <div class='container'>
        <button id="b" type="button" class="btn" onclick="location. href='logout.php';">Déconnection</button>
        <br><br><br><br>

    
        <p class='adminwlcm' >
            <?php echo 'Bonjour , <strong>'. $fullname. '</strong>' ?> 
        </p> 
        <br>
    

        <h4> Nouvelles demandes: </h4>
        <p>
        <?php
        
    if(isset($_SESSION["email"])){ // si la session est activé
    $sql = "SELECT * FROM insc where verified=1 and isaccepted=0 and isadmin=0";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

        echo"
      	<table class='demandes' cellspacing='4'>
      		<thead>
      			<tr>
      				<th>Nom</th>
                      <th>Prènom</th>
                      <th>Email</th>
                      <th></th>
      			</tr>
              </thead>
              
              <tbody>";

    			while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                            <td>" . $row["nom"]."</td>
                            <td>" . $row["prenom"]."</td>
                            <td>" . $row["email"]."</td>
                            <td><a href=\"consultation.php?id=".$row["id"]."\">Consulter</a></td></tr>";
        					
                         }
                
                      }
                     else{
                            echo "pas de demandes pour l'instant";
                        }
                    }
                    else{ //sinon on le redirecte vers la page de connection
                        header("location:login.php")  ;            
                    }
			?>
      		</tbody>
      	</table>
        </p>
        <br>
         
        <h4> liste des inscris accéptés: </h4>
        <p>
        <?php
if(isset($_SESSION["email"])){

        $sql = "SELECT * FROM insc where verified=1 and isaccepted=1 and isadmin=0";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

        echo"
      	<table class='inscris' cellspacing='4'>
      		<thead>
      			<tr>
      				<th>Nom</th>
                      <th>Prènom</th>
                      <th>Email</th>
                      <th colspan='2'> Actions</th>
      			</tr>
              </thead>
              
              <tbody>";

    			while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                            <td>" . $row["nom"]."</td>
                            <td>" . $row["prenom"]."</td>
                            <td>" . $row["email"]."</td>
                            <td><a href=\"information.php?id=".$row["id"]."\">Voir Informations</a></td>"."</td><td><a href=\"delete.php?id=".$row["id"]."\" onclick=\"return confirm('Vous voulez vraiment supprimer cet étudiant')\">Supprimer</a></td></tr>";

        					
                         }
                
                      }
                     else{
                            echo "Pas d'inscriptions pour le moment";
                        }
                    }
                   
			?>
      		</tbody>
      	</table>
        </p>
        <br>
        <h4> Actions: </h4>
        <p>
        <button type="button" class="add"> <a class="add" href='addadmin.php'>Ajouter admin</a></button><br><br>
        <button type="button" class="site"> <a class="site" href='http://www.insea.ac.ma' target="new">Aller vers le site</a></button>

        <p>


        

        </div>