<?php
include "connection.php";
session_start();

if(isset($_GET['id'])&& isset($_SESSION["email"])){ // si on récupere l'id avec le get et qu'on est connecté 
    $uid=$_GET['id'];

    $sql = "SELECT email FROM insc WHERE id='{$uid}'";
    $result=mysqli_query($conn,$sql);

    if($result){
    $row = mysqli_fetch_assoc($result);
    $email= $row["email"];

    $sql="UPDATE insc SET isaccepted=1 where id='{$uid}'";

    require 'phpmailer/PHPMailerAutoload.php';
    
    $mail = new PHPMailer;
    
    $mail->isSMTP();                                     
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;         
    $mail->Port = 587;                                               
    $mail->Username = 'insea.signup@gmail.com';               
    $mail->Password = 'insea.signup.1';                         
    $mail->SMTPSecure = 'tls';                           
    
    $mail->setFrom('insea.signup@gmail.com', 'INSEA SignUp');
    $mail->addAddress($email);     
   
    
    $mail->isHTML(true);                                  
    
    $mail->Subject = 'Acceptation de la demande d\'inscription ';
    $mail->Body    = "Votre demande a été bien acceptée! Vous pouvez maintenant accéder à votre compte";
    

    }
    if(mysqli_query($conn, $sql)){

        if(!$mail->send()) {
            exit( "erreur");
        } else {
        $message= "Le profil est bien validé";
        header("location:pannel.php?message=$message");

    }
    }
}
else{ //sinon on se rend à la page de login pour se connecter
    header("location:login.php")  ;            
}