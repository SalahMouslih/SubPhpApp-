<?php
include "connection.php" ;
session_start();
if(!empty($_GET["id"]) && isset($_SESSION["email"])){
    session_destroy();
	$id_del = mysqli_real_escape_string($conn,$_GET["id"]);
    $sql = "DELETE FROM insc WHERE id=$id_del";
	if (mysqli_query($conn, $sql)) {
    	$message= "Votre profil a été supprimé avec succés";
	} else {
    	$message="Erreur" . mysqli_error($conn);
	}
   header("Location:acceuil.php?message=$message");

}
else{
    header("location:login.php");
}
?>