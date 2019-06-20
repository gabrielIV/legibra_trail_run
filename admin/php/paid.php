<?php

require '../../php/connect.php';


$res=$connection->query("select id,name,phoneNumber,email,time,tshirt_size,status,payment_method from online where status=1");

$array = array();

while($row=$res->fetch_assoc()){

$status="";

if($row["status"]=="1"){
if($row["payment_method"]==""){

  $status='<div class="dropdown">
    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Paid
          </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" onclick="changeStatus(1,'.$row["id"].',this)">Paid</a>
                    <a class="dropdown-item" href="#" onclick="changeStatus(0,'.$row["id"].',this)">Not paid</a>
                      </div>
                      </div>';
  }else {
    $status="<a href='#' class='btn btn-success'>Paid</#>";

  }
}else {
  $status='<div class="dropdown">
    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Not paid
          </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" onclick="changeStatus(1,'.$row["id"].',this)">Paid</a>
                    <a class="dropdown-item" href="#" onclick="changeStatus(0,'.$row["id"].',this)">Not paid</a>
                      </div>
                      </div>';

}
// $smallArray[5]=$status;
$row["status"]=$status;

$smallArray=array();
foreach ($row as $key => $value) {
  array_push($smallArray,$value);
}
array_push($smallArray,$status);

  array_push($array,$smallArray);
}

echo json_encode($array);

 ?>
