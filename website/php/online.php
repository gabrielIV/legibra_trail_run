<?php
    include ("connect.php");

    // check if payment has been made

    $result=$connection->query("select status from online where id=$_POST[id] ");

    $row=$result->fetch_assoc();

    if($row['status']!='1'){

      // initialize stk push
    $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    $credentials = base64_encode('qH0sOXqmcJwiggRfPWmFJzg8m4tGHUCz:CRGdfwGI8xIjvBhj');
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header

    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $curl_response = curl_exec($curl);

    $token = json_decode($curl_response)->access_token;

    $url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $Bearer = $token;//'MB83GoSijEQlE9PQeBLMweVjR8dM';
    $Passkey = 'dd2162b04e5e0465a9700af18ab3913d8462b5d9f259e0d4dcfea2d5e0597709';
    $BusinessShortcode = '461110';
    $CallBackURL ='https://run.legibra.com/php/callback.php/';

    $amount = "2000";
    $phone_number = '254'.substr($_POST['phone'], 1); //"254708374149";
    $AccountReference = 'DW43FDF43';
    $TransactionDesc = 'A description of the transaction.';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$Bearer)); //setting custom header
    $timestamp = date("YmdHis", time());
    //base 64 encode BusinessShortcode, Passkey and Timestamp.
    //$password = base64_encode(hash_hmac('sha1', '174379', 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919',$timestamp));
    $password = base64_encode($BusinessShortcode . $Passkey . $timestamp);
    $curl_post_data = array(
      //Fill in the request parameters with valid values
      'BusinessShortCode' => $BusinessShortcode,
      'Password' => $password,
      'Timestamp' => $timestamp,
      'TransactionType' => 'CustomerPayBillOnline',
      'Amount' => $amount,
      'PartyA' => $phone_number,
      'PartyB' => $BusinessShortcode,
      'PhoneNumber' => $phone_number,
      'CallBackURL' => $CallBackURL,
      'AccountReference' => $AccountReference,
      'TransactionDesc' => $TransactionDesc
    );
    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    //print_r($curl_response);
    $data = json_decode($curl_response, true);
    //print_r($data);
    $error = "";
    @$error = $data["errorMessage"];
    @$msg = $data["ResponseDescription"];
    @$checkoutRequestID = $data["CheckoutRequestID"];
    if ($msg=="Success. Request accepted for processing" && $error=="") {
      echo $msg;
      //echo $data["CheckoutRequestID"];

// update database : checkout Request ID

      $query = "update online set checkoutRequestID='$checkoutRequestID' where id=$_POST[id];";
      echo $query;
      $result = mysqli_query($connection,$query);
      echo $connection->error;
      if($result){
          echo "<br/>successs";
      }else{
          echo "fail";
      }
    } else {
      echo $error;
    }

  }else {

    // response sent to paid users
    echo "paid";

    }



?>
