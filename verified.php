<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connection.php"
?>
<style>


body{
    background:lightgrey;
    font-family: Helvetica;
    font-size:18px;
    text-align:center;
    align-items:center;
    color:grey;
    
}
.message{
  margin: 70px auto;
  padding: 25px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
}

input[type="button"]{
      background-color:grey;
        border:none;
        border-radius:5px;
        cursor:pointer;
        color:#ffffff;
        font-size:15px; 
        font-weight:bold;
        padding:8px 19px;
    }

</style>


<div class='message'>
<img src='https://pngimage.net/wp-content/uploads/2018/06/validation-png.png' width='20%' > <br><br>
Votre demande a bien été enregistrée. Nous allons vous répondre dans les meilleures delais
</div>

<input type="button" onclick="location. href='acceuil.php';" value="Retour" /> <br><br/>
