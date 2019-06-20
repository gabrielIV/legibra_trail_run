<?php

  include ("connect.php");

  // email include data
  include  'email/PHPMailer/PHPMailerAutoload.php';
  include ("./email/send_email.php");

  // sms include data
  include ('inc/AfricasTalkingGateway.php');
  include ("./sendsms.php");

$result=$connection->query("select * from online where status=0 and TIMESTAMPDIFF(MINUTE, time, NOW() )>5 and  follow_up=0");

echo "$connection->error";

while ($row=$result->fetch_assoc()) {
    // echo "$row[id] ";


    sendEmail($organiser_email1,"$row[name] -Legibra Trail Run payment status-Not paid.","
    <p>Hi Sylvia/Peter,</p>
    <p> $row[name] registeredfor the Legibra Trail Run on 15 September 2018.</p>
    <p>We have not received payment for the registration.Please follow up.</p>
    <p>Thank You.</p>",$connection);

    sendSms($organiser_phone1,"$row[name] has not paid for the Legibra Trail Run
    .Please follow up.",$connection);

    $connection->query("update online set follow_up=1 where id=$row[id]");
}

 ?>
