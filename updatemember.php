<?php
include "connection.php";
session_start();

if (isset($_GET["id"]) && isset($_SESSION["email"])) {
    $id_et = mysqli_real_escape_string($conn, $_GET["id"]);
    $sql = "SELECT * FROM insc WHERE id=$id_et";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        $matricule = $row["matricule"];
        $nom = $row["nom"];
        $prenom = $row["prenom"];
        $cycle = $row["cycle"];
        $filiere = $row["filiere"];
        $niveau = $row["niveau"];
        $dateN = $row["date_naiss"];
        $dateIn = $row["date_insc"];
        $sexe = $row["sexe"];
                    
    
        $imgname = $niveau ."_". $matricule ."_". $filiere. '.jpg';
        $otherfilesname = $niveau . "_" . $matricule . "_" . $filiere . "_" . $nom . ".jpg";
        $imgpath = "/imagets/$imgname";
        $cinpath = "/cin/$otherfilesname";
        $bacpath = "/fichiersbac/$otherfilesname";
        $attpath = "/attestations/$otherfilesname";
    
        
    
    } 
}
else{
    header("location:login.php");
}



if (isset($_POST["update"])) {
    $umatricule = mysqli_real_escape_string($conn, $_POST["matricule"]);
    $unom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $uprenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
    $ucycle = mysqli_real_escape_string($conn, $_POST["cycle"]);
    $ufiliere = mysqli_real_escape_string($conn, $_POST["filiere"]);
    $univeau = mysqli_real_escape_string($conn, $_POST["niveau"]);
    $udateN = mysqli_real_escape_string($conn, $_POST["dateN"]);
    $usexe = mysqli_real_escape_string($conn, $_POST["sexe"]);
    $udateIn = mysqli_real_escape_string($conn, $_POST["dateIn"]);

    $imgname = $niveau ."_". $matricule ."_". $filiere. '.jpg';
    $otherfilesname = $niveau . "_" . $matricule . "_" . $filiere . "_" . $nom . ".jpg";
    $imgpath = "/imagets/$imgname";
    $cinpath = "/cin/$otherfilesname";
    $bacpath = "/fichiersbac/$otherfilesname";
    $attpath = "/attestations/$otherfilesname";
   

    if (!empty($_FILES['photo']['name'])){
    $photo_name = $_FILES['photo']['name'];
    $photo_temp_name = $_FILES['photo']['tmp_name'];
    $photo_type = $_FILES['photo']['type'];
    $directory = 'imagets/';

    if (!is_uploaded_file($photo_temp_name))
    {
        exit("Le fichier est introuvable");
    }
    if (!strstr($photo_type, 'jpg') && !strstr($photo_type, 'jpeg') && !strstr($photo_type, 'pdf') && !strstr($photo_type, 'png') && !strstr($photo_type, 'bmp'))
    {
        exit("Format invalide");
    }

    if (!move_uploaded_file($photo_temp_name, $directory . $photo_name))
    {
        exit(" Impossible de copier le fichier dans $directory ");
    }

    $Newname = $univeau . "_" . $umatricule . "_" . $ufiliere . ".jpg";
    rename("imagets/$photo_name", "imagets/$Newname");
    }
    if (!empty($_FILES['cin']['name'])){
    
    $cin_name = $_FILES['cin']['name'];
    $cin_temp_name = $_FILES['cin']['tmp_name'];
    $cin_type = $_FILES['cin']['type'];
    $directorycin = 'cin/';

    if (!is_uploaded_file($cin_temp_name))
    {
        exit("Le fichier est introuvable");
    }
    if (!strstr($cin_type, 'jpg') && !strstr($cin_type, 'jpeg') && !strstr($cin_type, 'pdf') && !strstr($cin_type, 'png') && !strstr($cin_type, 'bmp'))
    {
        exit("Format invalide");
    }

    if (!move_uploaded_file($cin_temp_name, $directorycin . $cin_name))
    {
        exit(" Impossible de copier le fichier dans $directorycin ");
    }

    $Newnamecin = $univeau . "_" . $umatricule . "_" . $ufiliere . "_" . $unom . ".jpg";
    rename("cin/$cin_name", "cin/$Newnamecin");
    }


    if (!empty($_FILES['att']['name'])){

    $att_name = $_FILES['att']['name'];
    $att_temp_name = $_FILES['att']['tmp_name'];
    $att_type = $_FILES['att']['type'];
    $directoryatt = 'attestations/';

    if (!is_uploaded_file($att_temp_name))
    {
        exit("Le fichier est introuvable");
    }
    if (!strstr($att_type, 'jpg') && !strstr($att_type, 'jpeg') && !strstr($att_type, 'pdf') && !strstr($att_type, 'png') && !strstr($att_type, 'bmp'))
    {
        exit("Format invalide");
    }

    if (!move_uploaded_file($att_temp_name, $directoryatt . $att_name))
    {
        exit(" Impossible de copier le fichier dans $directoryatt");
    }

    $Newnameatt = $univeau . "_" . $umatricule . "_" . $ufiliere . "_" . $unom . ".jpg";
    rename("attestations/$att_name", "attestations/$Newnameatt");
    }


    if (!empty($_FILES['bac']['name'])){

    $bac_name = $_FILES['bac']['name'];
    $bac_temp_name = $_FILES['bac']['tmp_name'];
    $bac_type = $_FILES['bac']['type'];
    $directorybac = 'fichiersbac/';

    if (!is_uploaded_file($bac_temp_name))
    {
        exit("Le fichier est introuvable");
    }
    if (!strstr($bac_type, 'jpg') && !strstr($bac_type, 'jpeg') && !strstr($bac_type, 'pdf') && !strstr($bac_type, 'png') && !strstr($bac_type, 'bmp'))
    {
        exit("Format invalide");
    }

    if (!move_uploaded_file($bac_temp_name, $directorybac . $bac_name))
    {
        exit(" Impossible de copier le fichier dans $directorybac ");
    }

    $Newnamebac = $univeau . "_" . $umatricule . "_" . $ufiliere . "_" . $unom . ".jpg";
    rename("fichiersbac/$bac_name", "fichiersbac/$Newnamebac");
    }

    //renommer les fichiers 
    $NewimgName = $univeau . "_" . $umatricule . "_" . $ufiliere . ".jpg";
    $NewfileName = $univeau . "_" . $umatricule . "_" . $ufiliere . "_" . $unom . ".jpg";
    
        rename($imgpath , "/imagets/$NewimgName");
        rename($cinpath , "/cin/$NewfileName");
        rename($bacpath , "/fichiersbac/$NewfileName");
        rename($attpath , "/attestations/$NewfileName");



    //mise à jour de la bd
    $sql = "UPDATE insc SET matricule ='{$umatricule}' , nom='{$unom}', prenom='{$uprenom}', cycle='{$ucycle}', filiere='{$ufiliere}', niveau='{$univeau}', date_naiss='{$udateN}', sexe='{$usexe}', date_insc='{$udateIn}' WHERE id='{$id_et}'";
    
    if (mysqli_query($conn, $sql)) {
        $message = "Votre profil a été mis à jour avec succès";
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    header("Location:profile.php?message=$message");
}
?>
<link rel="icon" href="images/inseainsc.png">
 <link rel="stylesheet" href="style-form.css" />
 

<div class="container">
    <form method="post" <?php echo ($_SERVER["PHP_SELF"]); ?> enctype="multipart/form-data">
        <h2>Modification</h2>
        <br /></br>

                    <img id="uimage" src="<?php echo $imgpath?>" alt="your image" /></br>
                    <label for="photo">Cliquer <strong> ici </strong> pour modifier votre photo</label>
                    <input type="file" onchange="document.getElementById('uimage').src = window.URL.createObjectURL(this.files[0])" id="photo" style="display : none;"  name="photo" accept="image/png, image/jpeg, image/bmp" />
                    <br /></br></br>

                    
        <h3>Modifier informations Personnelles:</h3>
   

                  <input type="hidden" id="id" name="id" value="<?php if(isset($id)) { echo $id; } ?>">
              
              
                  <label for="nom" class="labels">Nom: </label><br>
      			<input type="text" id="nom" name="nom" required value="<?php if(isset($nom)) { echo $nom; } ?>"><br/><br/><br/>
                  
                  <label for="prenom" class="labels">Prénom</label><br>
                  <input type="text" id="prenom" name="prenom" required value="<?php if(isset($prenom)) { echo $prenom; } ?>"><br/><br/><br/>

                  <input type="radio" name="sexe" value="Masculin" <?php if($sexe=="Masculin") { echo "checked"; } ?> required>Masculin
                <input type="radio" name="sexe" value="Féminin"<?php if($sexe=="Féminin") { echo "checked"; } ?>>Féminin
                <br><br/><br>

                  <label for="dateN"  class="labels">Date de naissance: </label> <br>

                  <input type="date" id="dateN" name="dateN" required value="<?php   echo $dateN ;  ?>"><br/><br/><br/>
                    


    
                <h3>Modifier informations académiques:</h3>
                  <label for="matricule" class="labels" >Matricule: </label> <br>
                  <input type="text" id="matricule" name="matricule" required value="<?php if(isset($matricule)) { echo $matricule; } ?>"><br/><br/><br/>
                 


                <label for="cycle" class="labels">Cycle: </label> <br>
                  <SELECT name="cycle">
                <OPTION value="ingénieur d'Etat"  <?php if($cycle=="Ingénieur d'Etat") { echo "selected"; } ?>>Ingénieur d’Etat</OPTION> 
                <OPTION value="Master"  <?php if($cycle=="Master") { echo "selected"; } ?>>Master</OPTION>
                <OPTION value="Doctorat"  <?php if($cycle=="Doctorat") { echo "selected"; } ?>>Doctorat</OPTION><br/><br/>

                </SELECT><br><br/>
                  
                <label for="filiere" class="labels">Filière:</label><br>
                <SELECT name="filiere">
                <OPTION value="Actuariat-Finance" <?php if($filiere=="Actuariat-Finance") { echo "selected"; } ?>>Actuariat-Finance</OPTION> 
                <OPTION value="Statistique-Economie Appliquée" <?php if($filiere=="Statistique-Economie Appliquée") { echo "selected"; } ?>>Statistique-Economie Appliquée</OPTION>
                <OPTION value="Recherche Opérationnelle et Aide à la Décision" <?php if($filiere=="Recherche Opérationnelle et Aide à la Décision") { echo "selected"; } ?>>Recherche Opérationnelle et Aide à la Décision</OPTION>
                <OPTION value="Ingénierie des Données et des Logiciels" <?php if($filiere=="Ingénierie des Données et des Logiciels") { echo "selected"; } ?>>Ingénierie des Données et des Logiciels</OPTION>
                <OPTION value="DS" <?php if($filiere=="Science des Données") { echo "selected"; } ?>>Science des Données</OPTION>
                </SELECT><br><br/><br/>

                
                <input type="radio" name="niveau" value="1 année" <?php if($niveau=="1 année") { echo "checked"; } ?> required>1 année
                <input type="radio" name="niveau" value="2 année" <?php if($niveau=="2 année") { echo "checked"; } ?>>2 année
                <input type="radio" name="niveau" value="3 année" <?php if($niveau=="3 année") { echo "checked"; } ?>>3 année<br/><br/><br>



                <label for="dateIn" class="labels">Date d'inscription: </label> <br>

                <input type="date" id="dateIn" name="dateIn" required value="<?php   echo $dateIn ;  ?>"><br/><br/><br/>


             <div class="files">

                  <label for="cin" class="files">Modifier Copie de la CIN: </label>
                <input type="file" onchange="document.getElementById('ucin').src = window.URL.createObjectURL(this.files[0])" id="cin"  name="cin" accept="image/png, image/jpeg, image/bmp" ><br>
                <img height="300" width="200" style="object-fit:cover;" id="ucin" src="<?php echo $cinpath?>" alt="your image" />

                <br><br/><br>

                <label for="bac" class="files" >Modifier Copie du Baccalauréat: </label>
                <input type="file" onchange="document.getElementById('ubac').src = window.URL.createObjectURL(this.files[0])" id="bac"  name="bac" accept="image/png, image/jpeg, image/bmp" ><br>
                <img height="300" width="200" style="object-fit:cover;" id="ubac" src="<?php echo $bacpath?>" alt="your image" /></br>

                <br><br/><br>

                <label for="att" class="flies">Modifier Attestation de réussite (CNC,DEUGS ou Licence): </label>
                <input type="file"  onchange="document.getElementById('uatt').src = window.URL.createObjectURL(this.files[0])" id="att" name="att"  accept="image/png, image/jpeg, image/bmp" ><br>
                <img height="300" width="200" style="object-fit:cover;" id="uatt" src="<?php echo $bacpath?>" alt="your image" /></br>

                <br><br/><br><br>

</div>
                <input Type="submit" name="update" value="Modifier">

                <input type="button" onclick="location. href='profile.php';" value="Annuler" /> <br><br/>
</form>
</div>
</body>
</html>

