<?php

    include ("connect.php");
    // email include data
    include  'email/PHPMailer/PHPMailerAutoload.php';
    include ("./email/send_email.php");

    // sms include data
    include ('inc/AfricasTalkingGateway.php');
    include ("sendsms.php");

    //$callbackJSONData = '{"Body":{"stkCallback":{"MerchantRequestID":"10219-282761-1","CheckoutRequestID":"ws_CO_29112017125436847","ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":1.00},{"Name":"MpesaReceiptNumber","Value":"LKT9FDXVQ1"},{"Name":"Balance"},{"Name":"TransactionDate","Value":20171129125455},{"Name":"PhoneNumber","Value":254719273965}]}}}}';

    $balance = "";
    $b2CUtilityAccountAvailableFunds = "";

    $callbackJSONData = file_get_contents('php://input');
    $callbackData = json_decode($callbackJSONData,true);

    $data = json_decode($callbackJSONData);

    $json_good =  json_encode($data, JSON_PRETTY_PRINT);

    $datas = json_decode($json_good, true);

    $callbackData = $datas["Body"]["stkCallback"];

    echo $resultCode = $callbackData["ResultCode"];

    echo $checkoutRequestID = $callbackData["CheckoutRequestID"];

    if ($resultCode == "0") {
      // code...
        echo $resultDesc = $callbackData["ResultDesc"];
        echo $merchantRequestID = $callbackData["MerchantRequestID"];
        echo $checkoutRequestID = $callbackData["CheckoutRequestID"];

        $CallbackMetadata = $callbackData["CallbackMetadata"];
        echo $amount = $CallbackMetadata["Item"][0]["Value"];
        echo $mpesaReceiptNumber = $CallbackMetadata["Item"][1]["Value"];
        echo $transactionDate = $CallbackMetadata["Item"][3]["Value"];
        //echo $balance = $CallbackMetadata["Item"][2]["Value"];
        echo $phoneNumber = $CallbackMetadata["Item"][4]["Value"];

        // echo $b2CUtilityAccountAvailableFunds = $callbackData->stkCallback->CallbackMetadata->Item[3]->Value;

        $query = "UPDATE `online` SET `resultCode` = '".$resultCode."', `resultDesc` = '".$resultDesc."', `merchantRequestID` = '".$merchantRequestID."', `amount` = '".$amount."', `mpesaReceiptNumber` = '".$mpesaReceiptNumber."', `balance` = '".$balance."', `b2CUtilityAccountAvailableFunds` = '".$b2CUtilityAccountAvailableFunds."', `transactionDate` = '".$transactionDate."', `phoneNumber` = '".$phoneNumber."', `payment_method` = 'mpesa', `status` = 1  WHERE  `online`.`checkoutRequestID` = '".$checkoutRequestID."'";

        $result = mysqli_query($connection, $query);

        if($result){
            echo "success";
            $result=$connection->query("select * from online where checkoutRequestID='$checkoutRequestID' ");

            $row=$result->fetch_assoc();

            sendSms($row["phoneNumber"],ucfirst($row["name"]).".
We confirm payment for The Legibra Trail Run.
You will receive an E- receipt via Email.
Thank you and see you on the D-Day.",$connection);

            sendEmail($row["email"]," $row[name] - Legibra Trail Run payment confirmation.","
        <p>Dear $row[name],
      <p>We have received payment for The Legibra Trail Run.</p>
      <p>Our accounts team will send you an E-receipt in a separate email.</p>
      <p>Thank You and see you on the D-Day.</p>
      <p>Sylvia & Peter.</p>",$connection);
      
      sendSuccessEmail($row["name"],$row["phoneNumber"],$row["email"],$row["distance"],$connection);



        }else{
            echo "fail";
        }
    } else {
      // code...
      $query = "UPDATE `online` SET `status` = 2  WHERE  `online`.`checkoutRequestID` = '".$checkoutRequestID."'";

      $result = mysqli_query($connection, $query);

      if($result){
          echo "successs";
      }else{
          echo "fail";
      }
    }





?>
