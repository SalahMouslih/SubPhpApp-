<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connection.php";

if (isset($_POST["Envoyer"]))
{
        $existingemail = mysqli_real_escape_string($conn, $_POST["email"]); 
        $sql1 = "SELECT * FROM insc where email='{$existingemail}'";
        $result = mysqli_query($conn, $sql1);

        if (mysqli_fetch_assoc($result)>0) { //on s'assure si l'email n'est pas déja utilisé
             echo "<div class='fail'>Email déja utilisé</div>";
        }
        else{ //sinon on continu le processus
    $matricule = mysqli_real_escape_string($conn, $_POST["matricule"]);
    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
    
       
        
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $cycle = mysqli_real_escape_string($conn, $_POST["cycle"]);
    $filiere = mysqli_real_escape_string($conn, $_POST["filiere"]);
    $niveau = mysqli_real_escape_string($conn, $_POST["niveau"]);
    $dateN = mysqli_real_escape_string($conn, $_POST["dateN"]);
    $sexe = mysqli_real_escape_string($conn, $_POST["sexe"]);
    $dateIn = mysqli_real_escape_string($conn, $_POST["dateIn"]);
    $vkey = mysqli_real_escape_string($conn, md5(time().$email)); // hashage du temps actuel et de l'email avec md5

    // upload des fichiers
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

    $Newname = $niveau . "_" . $matricule . "_" . $filiere . ".jpg";
    rename("imagets/$photo_name", "imagets/$Newname");

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

    $Newnamecin = $niveau . "_" . $matricule . "_" . $filiere . "_" . $nom . ".jpg";
    rename("cin/$cin_name", "cin/$Newnamecin");

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

    $Newnameatt = $niveau . "_" . $matricule . "_" . $filiere . "_" . $nom . ".jpg";
    rename("attestations/$att_name", "attestations/$Newnameatt");

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

    $Newnamebac = $niveau . "_" . $matricule . "_" . $filiere . "_" . $nom . ".jpg";
    rename("fichiersbac/$bac_name", "fichiersbac/$Newnamebac");

    //requete d'insertion 
    $sql = "INSERT INTO insc (matricule, nom, prenom, email , vkey , cycle, filiere, niveau,date_naiss, sexe, date_insc) VALUES ('{$matricule}','{$nom}','{$prenom}','{$email}','{$vkey}', '{$cycle}' ,'{$filiere}', '{$niveau}','{$dateN}', '{$sexe}','{$dateIn}')";

    

    // script du mail à envoyer
    require 'phpmailer/PHPMailerAutoload.php';
    
    $mail = new PHPMailer;
    
    $mail->isSMTP();                                      // utilisation de SMTP
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;         
    $mail->Port = 587;                                                 
    $mail->Username = 'insea.signup@gmail.com';                 // SMTP username
    $mail->Password = 'insea.signup.1';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Activer l'encryptage
    
    $mail->setFrom('insea.signup@gmail.com', 'INSEA SignUp');
    $mail->addAddress($email);     // Recepteur
   
    
    $mail->isHTML(true);                                  // Set email format to HTML
    
    $mail->Subject = 'Confirmation de l\'adresse mail';
    $mail->Body    = "<h4> Veuillez cliquer <a href='http://localhost:8888/verification.php?vkey=$vkey'>ici</a> pour vérifier votre adresse mail<h4>";
    
    if (mysqli_query($conn, $sql))
    {
        if(!$mail->send()) {
                echo "<div class='fail'> Veuillez réessayer </div>";
            } else {
                echo "<div class='succees'> Vos informations ont été enregitrées ! Veuillez vérifier votre email pour créer votre compte </div>";
            }    }
    else
    {
        echo "<div class='fail'> Une erreur s'est produite. Veuillez réessayer </div>" . $sql . "<br>" . mysqli_error($conn);

    }
}  
}

?>


<!DOCTYPE html>
    <head>
        <title>Inscription</title>
        <meta charset="utf-8" />
        <link rel="icon" href="images/inseainsc.png">
        <link rel="stylesheet" href="style-form.css" />
    </head>
    <body>

        <div class="container">
            <div class="form">
                <h2>Inscription</h2>
                <br /></br>

                

                <form name="inscription" method="post" action="" enctype="multipart/form-data">

                    <img id="uimage" src="https://www.aisd.net/swift-elementary/wp-content/files/sites/92/2017/10/person-placeholder.jpg" alt="your image" /></br>

                    <label for="photo">Cliquer <strong> ici </strong> pour choisir votre photo</label>
                    <input type="file"onchange="document.getElementById('uimage').src = window.URL.createObjectURL(this.files[0])" id="photo" style="display : none;"  name="photo" accept="image/png, image/jpeg, image/bmp" required />
                    <br />
                    <br />
                    <br />


                    <h3>
                    Infomations Personnelles:
                    </h3>
                    <input type="text" id="nom" name="nom" required placeholder="Entrez votre nom" /><br />
                    <br />
                    <br />

                    <input type="text" id="prenom" name="prenom" required placeholder="Entrez votre prénom" /><br />
                    <br />
                    <br />

                    <input type="email" id="email" name="email" required placeholder="Entrez votre email" /><br />
                    <br />
                    <br />

                    <input type="radio" name="sexe" value="Masculin" required />Masculin <input type="radio" name="sexe" value="Féminin" />Féminin <br />
                    <br />
                    <br />

                    <input type="date" id="dateN" name="dateN" required placeholder="Date de naissance" /><br />
                    <br />
                    <br />

                    

                    <h3>
                        Infomations Académiques:
                    </h3>

                    <input type="text" name="matricule" required placeholder="Entrez matricule" /> <br />
                    <br />
                    <br />

                    <select name="cycle">
                        <option value="Ingénieur d'Etat">Ingénieur d’Etat</option>
                        <option value="Master">Master</option>
                        <option value="Doctorat">Doctorat</option>
                    </select>
                    <br />
                    <br />
                    <br />

                    <select name="filiere">
                        <option value="Actuariat-Finance">Actuariat-Finance</option>
                        <option value="Statistique-Economie Appliquée">Statistique-Economie Appliquée</option>
                        <option value="Recherche Opérationnelle et Aide à la Décision">Recherche Opérationnelle et Aide à la Décision</option>
                        <option value="Ingénierie des Données et des Logiciels">Ingénierie des Données et des Logiciels</option>
                        <option value="Science des Données">Science des Données</option>
                    </select>
                    <br />
                    <br />
                    <br />

                    <input type="radio" name="niveau" value="1 année" required />1 année 
                    <input type="radio" name="niveau" value="2 année" />2 année 
                    <input type="radio" name="niveau" value="3 année" />3 année <br />
                    <br />
                    <br />

                    <input type="date" id="dateIn" name="dateIn" required placeholder="Date d'inscription" />
                    <br />
                    <br />
                    <br />

                    <label for="cin" class="files">Copie de la CIN: </label>
                    <input type="file" id="cin" name="cin" accept="image/png, image/jpeg, image/bmp" />
                    <br />
                    <br />
                    <br />

                    <label for="bac" class="files">Copie du Baccalauréat: </label>
                    <input type="file" id="bac" name="bac" accept="image/png, image/jpeg, image/bmp" />
                    <br />
                    <br />
                    <br />

                    <label for="att" class="files">Attestation de réussite (CNC,DEUGS ou Licence): </label>
                    <input type="file" id="att" name="att" accept="image/png, image/jpeg, image/bmp" />
                    <br />
                    <br />
                    <br />
                    <br />

                    <input type="submit" name="Envoyer" value="Envoyer" />
                    <input type="reset" value="Initialiser" />
                    <input type="button" onclick="location. href='acceuil.php';" value="Annuler" /> <br />
                    <br />
                </form>
            </div>
        </div>
    </body>
</html>
