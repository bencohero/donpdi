<?php
	session_start();
		//require('../config/conf.php');
		include("../config/librairies.php");
		$mysqli = db_connexion();
	//ini_set("display_errors",0);error_reporting(0);
	if(isset($_SESSION['password']) && isset($_SESSION['email'])){
		
?>
<?php 
        $type_paiement = $_POST['type_paiements'];
        $id_tarifs = $_POST['id_tarifs'];
		// Au cas où il n'a pas choisi de moyen de paiement.
		if($type_paiement == ""){
			$msg = "Veuillez selectionner un moyen de paiement svp.<br />";
			echo(msgerrors($msg));
			//echo(msgsuccess($msg));
			?>
			<script type="text/javascript">
				var obj = 'window.location.replace("offre_details.php?id_tarifs=$id_tarifs");';
				setTimeout(obj,2000); //Redirection dans 5 Secondes
			</script>
		<?php 
		}
		// Paiement électronique.
		if($type_paiement == 1){
			$msg = "Redirection pour le paiement.<br />";
			//echo(msgerror($msg));
			echo(msgsuccess($msg));
			$montant = 0;
			$total = 0;
			$description = "";
			$article = "";
			$frais = 0;
			$_SESSION['type'] = "client";
			$montant = $_SESSION['montant'];
			$id_users = $_SESSION['id_user'];
			$id_client = $_SESSION['id_client'];
			$id_tarifs = $_SESSION['id_tarifs'];
			$_SESSION['liste_id_ab'] = $id_users.",".$id_client;
			$_SESSION['etat'] = 0;
			$table = "factures_clients";
			$attributs = "idClient,idtarifs,etat_facture"; 
			$valeurs = "'$id_client','$id_tarifs',0";
			$res1 = insertData($mysqli,$table,$attributs,$valeurs) or die('Error : ('. $mysqli->errno .') '. $mysqli->error); 
			if($res1){
				$_SESSION['id_facture'] = $mysqli->insert_id;
			}	
			?>
			<script type="text/javascript">
				var obj = 'window.location.replace("../pay/payin_avec_redirection_php_cURL.php");';
				setTimeout(obj,2000); //Redirection dans 5 Secondes
			</script>	
			<?php
					
}
		<?php 
	
		// Paiement espèce.
		if($type_paiement == 2){
			$msg = "Génération du reçu pour le paiement en espèce.<br />";
			echo(msgerror($msg));
			//echo(msgsuccess($msg));
			?>
			<script type="text/javascript">
				var obj = 'window.location.replace("offre_details.php?id_tarifs=$id_tarifs");';
				setTimeout(obj,2000); //Redirection dans 5 Secondes
			</script>
		<?php 
		}
		// Paiement espèce.
		if($type_paiement == 2){
			$msg = "Chargement du RIB du prestataire.<br />";
			//echo(msgerror($msg));
			echo(msgsuccess($msg));
			?>
			<script type="text/javascript">
				var obj = 'window.location.replace("offre_details.php?id_tarifs=$id_tarifs");';
				setTimeout(obj,2000); //Redirection dans 5 Secondes
			</script>
		<?php 
		}
		
        
			
?>
<?php
}else{
    header("Location:deconnexion.php");
}
?>