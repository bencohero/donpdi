<?php
/*session_start();
include("../config/librairies.php");
$mysqli = db_connexion();
//$Api_key = $_SESSION['api_key'];
//$key = $_SESSION['token_app'];
$montant = 0;
$total = 0;
$description = "";
$article = "";
$frais = 0;
$montant = @$_SESSION['amount'];
$id_donateur = @$_SESSION['id_donateur'];
//$id_prestataire = @$_SESSION['id_prestataire'];
//$id_typeprestation = @$_SESSION['id_typeprestation'];
//$type_mode = @$_SESSION['type_mode'];
//$id_abonnement = @$_SESSION['id_abonnement'];
$total = $montant;
$description = "Paiement " . $montant;
$article = "Paiement";
$Api_key = "1Y9GYNQHHCPSUQO9U";
$Token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOiI3NzQiLCJpZF9hYm9ubmUiOjg5OTQyLCJkYXRlY3JlYXRpb25fYXBwIjoiMjAyMy0wMi0wMSAxOTozNDowNSJ9.CrkksYoYvihtI2m2KvBVu1l58XO8Y2F2phc3VPYrv7U";
$_SESSION['api_key'] = $Api_key;
$_SESSION['token_app'] = $Token;
//$libelle_trans = $_SESSION['libelle_trans'];
//$liste_id_ab = $_SESSION['liste_id_ab'];			
//echo($Api_key.'====='.$key);
//exit;
*/
function Payin_with_redirection($Api_key, $Token, $id,$montant, $firstname,$lastname, $email, $numTransaction)
{

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://app.ligdicash.com/pay/v01/redirect/checkout-invoice/create",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => '
						{
						"commande": {
							"invoice": {
							"items": [
								{
								"name": "PAIEMENT DE DONS",
								"description": "PAIEMENT DE DONS ",
								"quantity": 1,
								"unit_price": "' . $montant . '",
								"total_price": "' . $montant . '"
								}
							],
							"total_amount": "' . $montant . '",
							"devise": "XOF",
							"description": "PAIEMENT DES FRAIS",
							"customer": "",
							"customer_firstname":"' . $firstname. '",
							"customer_lastname":"' . $lastname . '",
							"customer_email":"' . $email . '"
							},
							"store": {
							"name": "Dons",
							"website_url": "https://Dons.com/"
							},
							"actions": {
							"cancel_url": "http://localhost:8000/dons/don/cancelpayment",
							"return_url": "http://localhost:8000/dons/don/payementResponse",
							"callback_url": "http://localhost:8000/dons/don/payementResponse"
							},
							"custom_data": {
							"transaction_id": "' . $numTransaction . '", 
							"id_donateur": "' . $id . '", 
							"id_prestataire": "",
							"idabs":""
							}
						}
						}',
		CURLOPT_HTTPHEADER => array(
			"Apikey: $Api_key",
			"Authorization: Bearer $Token",
			"Accept: application/json",
			"Content-Type: application/json"
		),
	));

	$response = json_decode(curl_exec($curl));

	curl_close($curl);
	return $response;
}



//XXXXXXXXXXXXXXXX-EXECUTION DES METHODES-XXXXXXXXXXXXXXXXXXXXXXX

/*
 En cas de reclamation ou de besoin de correction ou verrification d'une transaction,
 vous pouvez rappeler la transaction en recuperant le token par session ou depuis votre DB ou par variable $_GET['token']
 Raison pour laquel vous devez stocker le 'invoiceToken=' de votre transaction client dans votre base de données historique transaction ou en variable SESSION
 On suppose que le 'invoiceToken=' est recuperé par exemple
*/
//echo $_GET['token'];
//$invoiceToken=$_GET['token'];


//XXXXXXXXXXXXXXXX-EXECUTION DES METHODES-XXXXXXXXXXXXXXXXXXXXXXX
//$transaction_id = $_SESSION['transaction_id'];
//$amount=100;
//print_r($curl);
//exit;

//echo($_SESSION['tel']);

//exit;
//$redirectPayin = Payin_with_redirection($Api_key, $Token, $transaction_id, $montant);

//vous pouvez decommenter print_r($response) pour voir les resultats vour la documentationV1.2
//print_r($redirectPayin);exit;
//echo $redirectPayin->response_text;exit;
//echo $redirectPayin->token;exit;//Ce token doit etre enregistrer dans votre base de donne trasction client pour vos verrification de status apres paiement 
/*$_SESSION['invoiceToken'] = $redirectPayin->token; //Vous devez stoker ce TOKEN pour de verrification de status ulterieur
$_SESSION['token'] = $_SESSION['invoiceToken'];
$token = $redirectPayin->token;
$date = date("Y-m-d");
$permitted_chars = '0123456789ABCD';*/
// Output: 54esmdr0qf
//$tid = substr(str_shuffle($permitted_chars), 0, 10) . date("YmdHms");
//$tid = 'IM'.date("Y-m-d H:i:s");
//echo(" $tid");
// Normal - Abonnement et paiement
/*$table = "transaction";
$attributs = "iddonateur,date,numerotransaction,montant, token";
$valeurs = "'$id_donateur','$date','$transaction_id', '$montant', '$token'";*/

/*if($id_typeprestation==1){
		$table = "transactions";
		$attributs = "id_compte,id_prestataire,id_typeprestation,type_mode,libelle_trans,id_ab,tid,date,montant,total,token_d,etat"; 
		$valeurs = "'$id_users','$id_prestataire','$id_typeprestation','$type_mode','$libelle_trans','$liste_id_ab','$tid','$date','$montant','$total','$token',0";
	}
	 
	// JNL - Abonnement et paiement
	if($id_typeprestation==2){
		$table = "trans_jnl";
		$attributs = "id_compte,id_prestataire,id_typeprestation,id_abonnement,type_mode,libelle_trans,id_ab,tid,date,montant,total,token_d,etat"; 
		$valeurs = "'$id_users','$id_prestataire','$id_typeprestation','$id_abonnement','$type_mode','$libelle_trans','$liste_id_ab','$tid','$date','$montant','$total','$token',0";
	}*/

//echo("<br>".$valeurs);
//$res = insertData($mysqli, $table, $attributs, $valeurs) or die('Error : (' . $mysqli->errno . ') ' . $mysqli->error);
//echo(" $tid");
/*if ($res) {
	//$_SESSION['tid'] = $tid;
	//$_SESSION['etat'] = 0;		
	if (isset($redirectPayin->response_code) and $redirectPayin->response_code == "00") {
		//$redirectPayin->response_text contient l'url de redirection
		header('Location: ' . $redirectPayin->response_text);
	} else {
		echo 'response_code=' . $directPayin->response_code;
		echo '<br><br>';
		echo 'response_text=' . $directPayin->response_text;
		echo '<br><br>';
		echo 'description=' . $directPayin->description;
		echo '<br><br>';
		echo '<br><br>Veuillez lire la documentation et le WIKI subcodes[]';
		exit;
	}
	
	
}
*/
