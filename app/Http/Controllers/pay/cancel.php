<?php
	session_start();
	include("../config/librairies.php");
	$mysqli = db_connexion();
	//On vérifie les informations de connexion
	if(isset($_SESSION['password']) && isset($_SESSION['email'])){
	//On detruit un certain nombre de variables.
		//unset($_SESSION['id_participant']);
		unset($_SESSION['montant']);
		unset($_SESSION['tid']);
		unset($_SESSION['token']);
		print ("<script language = \"JavaScript\">"); 
		print ("location.href = '../app/listeoffres.php';"); 
		print ("</script>");
	
?>

<?php
}else{
    header("Location:deconnexion.php");
}
?>