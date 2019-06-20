<?php

include '../connect.php';

$dataPOST = trim(file_get_contents('php://input'));

$xmlData = simplexml_load_string($dataPOST);

// $txt = $dataPOST;
//  $myfile = file_put_contents('dpo_response.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

echo '<?xml version="1.0" encoding="utf-8"?>
<API3G>
  <Response>OK</Response>
</API3G>';



// email include data
include  '../email/PHPMailer/PHPMailerAutoload.php';
include ("../email/send_email.php");

// sms include data
include ('../inc/AfricasTalkingGateway.php');
include ("../sendsms.php");


// TransID=21AAC58E-E6EF-4F6F-9BA5-393B09A93E3A&CCDapproval=790195&PnrID=49FKEOA&TransactionToken=21AAC58E-E6EF-4F6F-9BA5-393B09A93E3A&CompanyRef=49FKEOA

$connection->query("update online set amount='$xmlData->TransactionAmount' status=1 where TransactionToken='$xmlData->TransactionToken'  ");

$res=$connection->query("select * from online where TransactionToken='$xmlData->TransactionToken' ");

echo $connection->error;

$row=$res->fetch_assoc();

sendSms($row["phoneNumber"],"$row[name].
We confirm payment for The Legibra Trail Run.
You will receive an E- receipt via Email.
Thank you and see you on the D-Day.",$connection);

sendEmail($row["email"]," $row[name] - Legibra Trail Run payment confirmation.","
<p>Dear, $row[name]
<p>We have received payment for The Legibra Trail Run.</p>
<p>Our accounts team will send you an E-receipt in a separate email.</p>
<p>Thank You and see you on the D-Day.</p>
<p>Sylvia & Peter.</p>",$connection);

 sendSuccessEmail($row["name"],$row["phoneNumber"],$row["email"],$row["distance"],$connection);

?>
