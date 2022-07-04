<?php
//Saving response to the database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
if (mysqli_connect_errno()) {
//echo "Error connecting to db: " . mysqli_connect_error(); Just die dont print error for security reasons
exit();
}
else{
  $status1 = $_GET["status"];
  $tx_ref = $_GET["tx_ref"];
  $transaction_id = $_GET["transaction_id"];

$curl = curl_init();
if($status1=="successful"){
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$transaction_id/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Content-Type: application/json",
      "Authorization: Bearer FLWSECK_TEST-SANDBOXDEMOKEY-X"
    ),
  ));
  
  // $response = curl_exec($curl);
  $response = '
  {
    "status": "success",
    "message": "Transaction fetched successfully",
    "data": {
      "id": 1163068,
      "tx_ref": "akhlm-pstmn-blkchrge-xx6",
      "flw_ref": "FLW-M03K-02c21a8095c7e064b8b9714db834080b",
      "device_fingerprint": "N/A",
      "amount": 3000,
      "currency": "NGN",
      "charged_amount": 3000,
      "app_fee": 1000,
      "merchant_fee": 0,
      "processor_response": "Approved",
      "auth_model": "noauth",
      "ip": "pstmn",
      "narration": "Kendrick Graham",
      "status": "successful",
      "payment_type": "card",
      "created_at": "2020-03-11T19:22:07.000Z",
      "account_id": 73362,
      "amount_settled": 2000,
      "card": {
        "first_6digits": "553188",
        "last_4digits": "2950",
        "issuer": " CREDIT",
        "country": "NIGERIA NG",
        "type": "MASTERCARD",
        "token": "flw-t1nf-f9b3bf384cd30d6fca42b6df9d27bd2f-m03k",
        "expiry": "09/22"
      },
      "customer": {
        "id": 252759,
        "name": "Kendrick Graham",
        "phone_number": "0813XXXXXXX",
        "email": "user@example.com",
        "created_at": "2020-01-15T13:26:24.000Z"
      }
    }
  }
  ';
  curl_close($curl);
  // echo "<pre>$response</pre>";
  $json_response = json_decode($response);
  //Logging the response
	$LogFile= "logs.txt";
	//write to file
	$log = fopen($LogFile, "a");
	fwrite($log, $response);
	fclose($log);

	$status = $json_response->status;
	$message = $json_response->message;
  $payment_type = $json_response->data->payment_type;
  $cust_name = $json_response->data->customer->name;

  // echo "$status','$message','$payment_type','$cust_name";
  echo "<script>location.href='/thanks';</script>";
				exit();
}
else{
echo "Not successful";
}
}


