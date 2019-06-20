<?php

require '../../php/connect.php';

$res=$connection->query("SELECT count(*) as total from online where status=1");
$res1=$connection->query("SELECT count(*) as total from online where status!=1");
$res2=$connection->query("SELECT count(*) as total from online");

$row=$res->fetch_assoc();
$paid=$row['total'];

$row=$res1->fetch_assoc();
$unpaid=$row['total'];

$row=$res2->fetch_assoc();
$all=$row['total'];

$data=array();

$data["paid"]=$paid;
$data["unpaid"]=$unpaid;
$data["all"]=$all;

echo json_encode($data);


?>