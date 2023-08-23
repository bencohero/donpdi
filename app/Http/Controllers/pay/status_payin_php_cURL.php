<?php
//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

function StatusPayin($Api_key, $key, $invoiceToken)
{

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://app.ligdicash.com/pay/v01/redirect/checkout-invoice/confirm/?invoiceToken=" . $invoiceToken,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"Apikey: $Api_key",
			"Authorization: Bearer $key"
		),
	));
	$response = json_decode(curl_exec($curl));
	curl_close($curl);

	return $response;
}

// if (isset($Payin)) {
// 	if (trim($Payin->status) == "completed") {
// 		/*echo "Le client(Payer) a validé le paiement vous devez executé vos traitements apres paiement valide<br><br>";
// 			print_r($Payin);
// 			echo 'status='.$Payin->status;;
// 			echo '<br><br>';
// 			echo 'response_text='.$Payin->response_text;
// 			*/
// 		$table = "transction";
// 		$attributs_valeurs= "status = completed";	
// 		$cle_valeurs = "token = $token";
// 		$upres = UpdateData($mysqli, $table, $attributs_valeurs, $cle_valeurs);

// 		header('Location: ../app/');
// 		// On recupère les informations pour genrer la licence.
// 		//$tid = $mysqli->real_escape_string($_SESSION['tid']); // Cette transaction id est geré par le dev.
// 		// Normal
// 		/*if($id_typeprestation==1){
// 				$table = "transactions";
// 				$attributs_valeurs = "operator_id='$Payin->operator_id',operator_name='$Payin->operator_name',etat='1'"; // Etat reussi
// 				$cle_valeurs = "tid='$tid'";
// 			}*/
// 		// JNL
// 		/*if($id_typeprestation==2){
// 				$table = "trans_jnl";
// 				$attributs_valeurs = "operator_id='$Payin->operator_id',operator_name='$Payin->operator_name',etat='1'"; // Etat reussi
// 				$cle_valeurs = "tid='$tid'";
// 			}*/
// 		//$res = UpdateData($mysqli,$table,$attributs_valeurs,$cle_valeurs);		
// 		if ($res) {
// 			// On met aà jour les informations de la facture.

// 			//$data = $CustomData[0]['valueof_customdata'];
// 			$data = $_SESSION['liste_id_ab'];

// 			$id = explode(",", $data);
// 			//print_r("<br />".$id[0]);
// 			//exit;
// 			// Paiement des prestataires
// 			/*if($_SESSION['type']=="Prestataire"){
// 						for($i=0;$i<count($id);$i++){
// 							$sql = "UPDATE abonnements SET etat_paye=1 WHERE id_abonnement='".$id[$i]."'";
// 							$o = $mysqli->query($sql);
							
// 						}*/
// 			if ($o) {
// 				// On envoi un mail de confirmation de paiement.
// 				/*$email = $_SESSION['email'];
// 					$sujet = "Abonnement effectué sur la plateforme CCIBF";
// 					$message_fr = "Bonjour cher prestataire, <br /> Vous venez de finaliser votre abonnement à laplateforme.<br /> .<br />
// 					Cordialement<br />
// 					Le Coordonateur<br />
// 					Contacts : Tel / Whatsapp: ";
// 					if(SERV!="localhost"){
// 						emailFr($sujet,$message_fr,$email,"");
// 						emailFr($sujet,$message_fr,constant(EMAILADMIN1),"");
// 					}
// 					$msg = "Paiement effectué avec succès.<br />";
// 					echo(msgsuccess($msg));*/
//  			
// 			}
// 		}
// 		// Paiement des clients
// 		if ($_SESSION['type'] == "client") {
// 			if ($id_typeprestation == 1) {
// 				$sql = "UPDATE factures_clients SET etat_facture=1 WHERE idfacture='" . $_SESSION['id_facture'] . "'";
// 				$o = $mysqli->query($sql);
// 			}
// 			// On envoi un mail de confirmation de paiement.
// 			/*$email = $_SESSION['email'];
// 				$sujet = "Paiement reussi auprès de la CCIBF";
// 				$message_fr = "Bonjour cher client, <br /> Vous avez fait un paiement de prestation avec succès auprès de la CCIBF.<br /> .<br />
// 				Cordialement<br />
// 				Le Coordonateur<br />
// 				Contacts : Tel / Whatsapp: ";
// 				if(SERV!="localhost"){
// 					emailFr($sujet,$message_fr,$email,"");
// 					emailFr($sujet,$message_fr,constant(EMAILADMIN1),"");
// 				}
// 				$msg = "Paiement effectué avec succès.<br />";
// 				echo(msgsuccess($msg));*/

// 		}
// 	} elseif (trim($Payin->status) == "nocompleted") {
// 		echo ("Vous avez annulé le paiement, vous pouvez le reprendre plus tard.<br />");
// 		echo ("Veuillez nous conatcter à ces adresses si vous éprouvez des difficultés de paiement: <br />info@tramadec.com<br />");
// 		exit;
// 	} elseif (trim($Payin->status) == "pending") {
// 		echo ("Vous devez confirmer votre paiement.<br />");
// 		echo ("Veuillez nous conatcter à ces adresses si vous éprouvez des difficultés de paiement: <br />info@tramadec.com<br />");
// 		exit;
// 	} else {
// 		echo ("Erreur de paiement.<br />");
// 		echo ("Veuillez nous conatcter à ces adresses si vous éprouvez des difficultés de paiement: <br />info@tramadec.com<br />");
// 		exit;
// 	}
// } else {
// 	return false;
// }

?>