<?php

require '../../php/connect.php';

include '../../php/inc/AfricasTalkingGateway.php';
include '../../php/sendsms.php';

$status="";
if($_GET["group"]!="*"){
  $status="where status=$_GET[group] ";
}

$res=$connection->query("select id,name,distance,phoneNumber,email,time,status,payment_method from online $status ");

$array = array();

while($row=$res->fetch_assoc()){

  $text=str_replace("{name}",$row["name"],$_GET["text"]);
  $text=str_replace("{email}",$row["email"],$text);
  $text=str_replace("{phone}",$row["phoneNumber"],$text);
  $text=str_replace("{distance}",$row["distance"],$text);
  // array_push($array,$text);
  //
  sendSms($row["phoneNumber"],"$text",$connection);
//   echo "$text \n";

}

// echo json_encode($array);


 ?>
