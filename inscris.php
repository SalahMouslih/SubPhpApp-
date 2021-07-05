
<!Doctype html>
<head>
    <title>Inscris</title>
    
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
.ret {
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

<div class="container">
<?php
include "connection.php";
session_start();


echo '<h2> liste des inscris accéptés: </h2>';

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
                            <td><a href=\"information.php?id=".$row["id"]."\">Voir Informations</a></td>"."</td></tr>";

        					
                         }
                
                      }
                     else{
                            echo "Pas d'inscriptions pour le moment";
                        }
                    }
                   
			?>
      		</tbody>
      	</table>
        <br>

        <button type="button" class="ret"> <a class="ret" href='pannel.php'>retour</a></button><br><br>
</div>