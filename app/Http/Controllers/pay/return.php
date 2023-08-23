<?php
	session_start();
	require('../config/conf.php');
	include("../config/librairies.php");
	$mysqli = db_connexion();
	$etat_fact = 0;
	//$_SESSION['id_edition'] = 1;
	if(isset($_SESSION['password']) && isset($_SESSION['email'])){
	//$id_user = $_SESSION['id_user'];
	//$id_facture = $_SESSION['id_facture'];
	// Soit $co la variable contenant la commande
		$co = new Pay_Checkout_Invoice($store, $setup);
		// La méthode confirm returne true ou false dépendamment du statut du paiement
		// Vous pouvez donc utiliser une instruction if - else et gérer le résultat comme bon vous semble
		
		if ($co->confirm()) {
		  // transaction réussie
		  $Token = $co->getToken(); // Token de paiement
		  $operator_id = $co->getOperator_id(); // ID de l'opérateur
		  $operator_name = $co->getOperator_name(); // Nom de l'opérateur
		  $CustomData = $co->showCustomData(); // Nom de l'opérateur
		  //$CustomerInfo = $co->getCustomerInfo($Token); // Un ensemble d'information sur le client en fonction du type d'information passé 
		  $TotalAmount = $co->getTotalAmount(); // Montant total payé par le client
		  $Status = $co->getStatus(); // Status de la transaction
		  $ReceiptUrl = $co->getReceiptUrl(); // Nom de l'opérateur
		  $tid = $mysqli->real_escape_string($_SESSION['tid']); // Cette transaction id est geré par le dev.
		  //$etat = $mysqli->real_escape_string($_SESSION['etat']); // Etat de la transaction géré par le developpeur
		  // On met à jour la ligne de la transaction dans la base
		  $table = "transactions";
		  $attributs_valeurs = "operator_id='$operator_id',operator_name='$operator_name',token_r='$Token',etat='1'"; // Etat reussi
		  $cle_valeurs = "tid='$tid'";
		   //echo("Tokeen:$Token<br />OperatorD: $operator_id<br />");
		   //print_r($CustomData);
		   //print_r($CustomerInfo);
		   //exit;
		  $res = UpdateData($mysqli,$table,$attributs_valeurs,$cle_valeurs);		
		  if($res){
			  // On met aà jour les informations de la facture.
			  
			  $data = $CustomData[0]['valueof_customdata'];//$_SESSION['liste_id_ab'];
			  $id = explode(",", $data);
			  if($_SESSION['type']!="client"){
				  for($i=0;$i<count($id);$i++){
					  $sql = "UPDATE abonnements SET etat_paye=1 WHERE id_abonnement='".$id[$i]."'";
					  $o = $mysqli->query($sql);
					  
				  }
					if($o){
						// On envoi un mail de confirmation de paiement.
						$email = $_SESSION['email'];
						$sujet = "Abonnement effectué sur la plateforme CCIBF";
						$message_fr = "Bonjour cher prestataire, <br /> Vous venez de finaliser votre abonnement à laplateforme.<br /> .<br />
						Cordialement<br />
						Le Coordonateur<br />
						Contacts : Tel / Whatsapp: ";
						if(SERV!="localhost"){
							emailFr($sujet,$message_fr,$email,"");
							emailFr($sujet,$message_fr,constant(EMAILADMIN),"");
						}

						$msg = "Paiement effectué avec succès.<br />";
						echo(msgsuccess($msg));
						?>
						<script type="text/javascript">
						var obj = 'window.location.replace("../app/listeoffres.php");';
						setTimeout(obj,5000); //Redirection dans 10 Secondes
						</script>
					
	  
				   <?php
					}
				}
				if($_SESSION['type']=="client"){
					 $sql = "UPDATE factures_clients SET etat_facture=1 WHERE idfacture='".$_SESSION['id_facture']."'";
					 $o = $mysqli->query($sql);
					 if($o){
						// On envoi un mail de confirmation de paiement.
						$email = $_SESSION['email'];
						$sujet = "Paiement reussi";
						$message_fr = "Bonjour cher client, <br /> Vous avez fait un paiement de prestation avec succès.<br /> .<br />
						Cordialement<br />
						Le Coordonateur<br />
						Contacts : Tel / Whatsapp: ";
						if(SERV!="localhost"){
							emailFr($sujet,$message_fr,$email,"");
							emailFr($sujet,$message_fr,constant(EMAILADMIN),"");
						}

						$msg = "Paiement effectué avec succès.<br />";
						echo(msgsuccess($msg));
						?>
						<script type="text/javascript">
						var obj = 'window.location.replace("../customs/transactions.php");';
						setTimeout(obj,5000); //Redirection dans 10 Secondes
						</script>
					
	  
				   <?php
					}
				}		
		}else{
		  //transaction échouée
					$msg = "Transaction echouée.<br />";
					echo(msgerrors($msg));
		  ?>
				<script type="text/javascript">
					var obj = 'window.location.replace("../app/listeoffres.php");';
					setTimeout(obj,5000); //Redirection dans 10 Secondes
					</script>
			   <?php
		}	
	}else{
					$msg = "Paiement echoué.<br />";
					echo(msgerrors($msg));
?>		
				<script type="text/javascript">
					var obj = 'window.location.replace("../app/listeoffres.php");';
					setTimeout(obj,5000); //Redirection dans 10 Secondes
					</script>
			
<?php
	}
}else{
		header("Location:deconnexion.php");
	}
?>
