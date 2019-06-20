<?php

include '../connect.php';


$res=$connection->query("select * from online where id=$_GET[id] ");

$row=$res->fetch_assoc();

$names=explode(" ",$row["name"]);

function unique_number_generator($length) {
            
  if (function_exists("random_bytes")) {
      $bytes = random_bytes(ceil($length / 2));
  } elseif (function_exists("openssl_random_pseudo_bytes")) {
      $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
  } else {
      throw new Exception("no cryptographically secure random function available");
  }
  return substr(bin2hex($bytes), 0, $length);
}

if($row['status']=="1"){
    
    header("Location: ../success.html");
    
}else{



   $xml = '
   <?xml version="1.0" encoding="utf-8"?>
<API3G>
<CompanyToken>D635E3C8-9224-4C98-B480-DDF234D85724</CompanyToken>
<Request>createToken</Request>
<Transaction>
<PaymentAmount>2000.00</PaymentAmount>
<PaymentCurrency>KES</PaymentCurrency>
<CompanyRef>LTR-'.strtoupper(unique_number_generator(4)).'</CompanyRef>
<RedirectURL>https://run.legibra.com/php/DPO/dpo_callback.php</RedirectURL>
<BackURL>https://run.legibra.com/payment.html </BackURL>
<CompanyRefUnique>0</CompanyRefUnique>
<PTL>5</PTL>
<customerFirstName>'.$names[0].'</customerFirstName>
<customerLastName>'.$names[1].'</customerLastName>
<customerZip>254</customerZip>
<customerCity>Nairobi</customerCity>
<customerCountry>KE</customerCountry>
<customerEmail>'.$row['email'].'</customerEmail>
<customerPhone>'.$row['phoneNumber'].'</customerPhone>

</Transaction>
<Services>
  <Service>
    <ServiceType>20658</ServiceType>
    <ServiceDescription>Legibra Trail Run</ServiceDescription>
    <ServiceDate>'.date("Y/m/d  g:i").'</ServiceDate>
  </Service>
</Services>
</API3G>
   ';

   // give the path of the Third party site
   //$url = "https://secure.sandbox.directpay.online/API/v5/"; sandbox url
   $url = "https://secure.3gdirectpay.com/API/v6/"; // live url

   $ch = curl_init($url);
   //curl_setopt($ch, CURLOPT_MUTE, 1);
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
   curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $output = curl_exec($ch);
   // echo $output."<br>";


  $output=simplexml_load_string($output);

   json_encode($output);

   $output->TransToken;

    //$connection->query("update online set TransactionToken='$output->TransToken' where id=$_GET[id] ");
    $connection->query("update online set TransactionToken='$output->TransToken',amount='2000.00',status=1 where id=$_GET[id] ");

    echo $connection->error;

  header('Location: https://secure.3gdirectpay.com/pay.asp?ID='.$output->TransToken);

   curl_close($ch);
   
}

?>
