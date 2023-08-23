<?php
	session_start();
	//ini_set("display_errors",0);error_reporting(0);
	if(isset($_SESSION['password']) && isset($_SESSION['email'])){
		
?>
<?php 
        
        require('../config/conf.php');
		include("../config/librairies.php");
		$mysqli = db_connexion();
		$montant = 0;
        $total = 0;
		$description = "";
		$article = "";
		$frais = 0;
		//echo($_SESSION['liste_id_ab']);
		//exit;
		//echo("ici");
        // Soit $co la variable contenant la commande
		//if(isset($_SESSION['id_participant']) && isset($_SESSION['montant'])){
			$co = new Pay_Checkout_Invoice($store, $setup);
			$montant = $_SESSION['montant'];
			$id_users = $_SESSION['id_user'];
			$id_prestataire = $_SESSION['id_prestataire'];
			//$total = $mysqli->real_escape_string($_POST['total']);
			//$frais = $frais+$frais_plateforme;
			$total = $montant;
			$description = "Paiement ".$montant;
			$article = "Paiement";
			$co->addItem("$article", 1, $montant, $montant,$description);
			$co->setTotalAmount($total);
			$co->setDescription("PAIEMENT DES FRAIS ".$montant);
			$co->addCustomData("idabs",$_SESSION['liste_id_ab']);
			// démarrage du processus de paiement
			// envoi de la requete
			if($co->create()) {
			  // Requête acceptée, alors on redirige le client vers la page de validation de paiement*
			  
			  $token = $co->getToken();
			  $_SESSION['token'] = $token;
			  $date = date("Y-m-d");
			  $permitted_chars = '0123456789ABCD';
			// Output: 54esmdr0qf
				$tid = substr(str_shuffle($permitted_chars), 0, 10).date("YmdHms");
			  //$tid = 'IM'.date("Y-m-d H:i:s");
			  //echo(" $tid");
			  $table = "transactions";
				$attributs = "id_compte,id_participant,tid,date,montant,total,token_d,etat"; 
				$valeurs = "'$id_users','$id_prestataire','$tid','$date','$montant','$total','$token',0";
				//echo("<br>".$valeurs);
				$res = insertData($mysqli,$table,$attributs,$valeurs) or die('Error : ('. $mysqli->errno .') '. $mysqli->error); 
				//echo(" $tid");
				if($res){
					$_SESSION['tid'] = $tid;
					$_SESSION['etat'] = 0;
					//$_SESSION['montant_retrait'] = $montant;
					//$_SESSION['tel_retrait'] = "226".$tel_souhait;
					//$t1 = $co->getInvoiceUrl();
					
					//echo("$t1");
					//exit;
				?>
				<SCRIPT LANGUAGE="JavaScript">
					document.location.href="<?php echo($co->getInvoiceUrl()); ?>"
				</SCRIPT>
				<?php
					//header("Location:".$co->getInvoiceUrl());
				}
			}else{
			  // Requête refusée, alors on affiche le motif du rejet
			  echo $co->response_text;
			}
		//}		
?>
<?php
}else{
    header("Location:deconnexion.php");
}
?>