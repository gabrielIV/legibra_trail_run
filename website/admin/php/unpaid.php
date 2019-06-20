<?php

require '../../php/connect.php';


$res=$connection->query("select * from online where status=0");

$array = array();

while($row=$res->fetch_assoc()){
  array_push($array,$row);
}

echo json_encode($array);

 ?>
