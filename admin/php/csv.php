<?php

require '../../php/connect.php';


header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"contacts.csv\"");

$res=$connection->query("select id,name,phoneNumber,email,time,status,distance,tshirt_size from online");
echo "$connection->error";
$array = array();

while($row=$res->fetch_assoc()){
  $smallArray=array();
  $status="not paid";
  if($row["status"]=="1"){
    $status="paid";
  }
  
  $row["distance"]=$row["distance"]." km";
  
  $row["status"]=$status;
  foreach ($row as $key => $value) {
    array_push($smallArray,$value);
  }
  array_push($array,$smallArray);
}

function array2csv($arr){


  $file = fopen("./contacts.csv","w");

foreach ($arr as $line){

  // echo json_encode($arr);

  fputcsv($file,$line);
  }

fclose($file);
echo readfile('./contacts.csv');


}


array2csv($array);
// echo "string";

 ?>
