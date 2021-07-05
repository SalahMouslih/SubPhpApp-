<?php
include "connection.php" ;
session_start();
if(!empty($_GET["id"]) && isset($_SESSION["email"])){
	$id_del = mysqli_real_escape_string($conn,$_GET["id"]);
	$sql = "DELETE FROM insc WHERE id=$id_del";
	if (mysqli_query($conn, $sql)) {
    	$refus= "le profil a été supprimé avec succés";
	} else {
    	$refus="Erreur" . mysqli_error($conn);
	}
   header("Location:pannel.php?refus=$refus");

}
?>