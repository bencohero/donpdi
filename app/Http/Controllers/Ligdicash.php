<?php

namespace App\LGD;

class Ligdicash
{
    private const APIKEY = "1Y9GYNQHHCPSUQO9U";
    private const TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOiI3NzQiLCJpZF9hYm9ubmUiOjg5OTQyLCJkYXRlY3JlYXRpb25fYXBwIjoiMjAyMy0wMi0wMSAxOTozNDowNSJ9.CrkksYoYvihtI2m2KvBVu1l58XO8Y2F2phc3VPYrv7U";


    
    public static function ligdicashWithRedirection($id, $montant, $firstname, $lastname, $email, $numTransaction)
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
							"customer_firstname":"' . $firstname . '",
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
                "Apikey: " . self::APIKEY,
                "Authorization: Bearer " . self::TOKEN,
                "Accept: application/json",
                "Content-Type: application/json"
            ),
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);
        return $response;
    }

    public static function ligdicashGetPayStatus($invoiceToken)
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
                "Apikey: " . self::APIKEY,
                "Authorization: Bearer " . self::TOKEN
            ),
        ));
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        return $response;
    }
}
