<?php

include '../connect.php';

// email include data
include  '../email/PHPMailer/PHPMailerAutoload.php';
include ("../email/send_email.php");

// sms include data
include ('../inc/AfricasTalkingGateway.php');
include ("../sendsms.php");


// TransID=21AAC58E-E6EF-4F6F-9BA5-393B09A93E3A&CCDapproval=790195&PnrID=49FKEOA&TransactionToken=21AAC58E-E6EF-4F6F-9BA5-393B09A93E3A&CompanyRef=49FKEOA

$connection->query("update online set TransID='$_GET[TransID]' , CCDapproval='$_GET[CCDapproval]' , PnrID='$_GET[PnrID]' , CompanyRef='$_GET[CompanyRef]' ,payment_method='dpo' where TransactionToken='$_GET[TransactionToken]'  ");



//header('Location: https://run.legibra.com/success.html');


//
// $connection->query("insert into dpo_payments (string,Result,ResultExplanation,TransactionToken,TransactionRef,CustomerName,CustomerCredit,TransactionApproval,TransactionCurrency,TransactionAmount,FraudAlert,FraudExplnation,TransactionNetAmount,TransactionSettlementDate,TransactionRollingReserveAmount,CustomerPhone)
// values ('$dataPOST','$xmlData->Result','$xmlData->ResultExplanation','$xmlData->TransactionToken','$xmlData->TransactionRef','$xmlData->CustomerName','$xmlData->CustomerCredit','$xmlData->TransactionApproval','$xmlData->TransactionCurrency','$xmlData->TransactionAmount','$xmlData->FraudAlert','$xmlData->FraudExplnation','$xmlData->TransactionNetAmount','$xmlData->TransactionSettlementDate','$xmlData->TransactionRollingReserveAmount','$xmlData->CustomerPhone') ");



 ?>
