<?php
include "connection.php";
session_start();

if(isset($_POST['Envoyer'])){
    $recoveryemail = $_POST['email'];

    $sql = "SELECT vkey FROM insc WHERE  email='{$recoveryemail}' and isadmin=0 and verified=1 and isaccepted=1";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $vkey = $row['vkey'];

    
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
    $mail->addAddress($recoveryemail);     
   
    
    $mail->isHTML(true);                                 
    
    $mail->Subject = 'Réinstallation du mot de passe  ';
    $mail->Body    = "Veuillez cliquer <a href='http://localhost:8888/recovery.php?vkey=$vkey'>ici</a> pour réinstaller votre mot de passe ";
    
    if($result)
    {

        if(!$mail->send()) {
            exit( "erreur");
        } else {
        $message= "Un mail de récupération de mot de passe vous a été envoyé";
        header("location:login.php?message=$message");

        }
    }
    else{
        echo ("Ce compte inexistant ou non accepté ");
    }
}
    
    
    


    
?>
    <!Doctype html>
    <head>
        <title> Mot de passe oublié</title>
        <link rel="icon" href="images/inseainsc.png">
        <meta charset="utf-8">
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
    <form name="email" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post">
    
            <input type="email" name="email" id="email" required placeholder="Entrer email"> <br><br><br>
            <button type="submit" name="Envoyer" class="btn">Envoyer</button>
    
    
    
    </form>
    </div>
    
    </body>
    </html>