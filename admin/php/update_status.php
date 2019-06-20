<?php

require '../../php/connect.php';

include  '../../php/email/PHPMailer/PHPMailerAutoload.php';
include ("../../php/email/send_email.php");

include '../../php/inc/AfricasTalkingGateway.php';
include '../../php/sendsms.php';;

$res=$connection->query("update online set status=$_POST[status] where id=$_POST[id] ");



echo $connection->error;

if($res){
  echo "success";

  $res=$connection->query("select name from online where id=$_POST[id] ");
  $status="PAID";
if($_POST["status"]!="1"){
  $status="NOT PAID";
}

$row=$res->fetch_assoc();

    sendSms("$organiser_phone1","$row[name]'s status changed to $status",$connection);

}else{
    echo "error";
}


if($_POST["status"]=="1"){


  $res=$connection->query("select * from online where id=$_POST[id] ");
  $status="PAID";
  $row=$res->fetch_assoc();


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
}




 ?>
