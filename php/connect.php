<?php
  $dbname = "legiajay_trail_run";
	$dbhost = "localhost";
	$dbuser = "legiajay_run";
	$dbpass = "=2(#e?Fs1u@-";

//   $dbname = "legibra_trail_run";
//   $dbhost = "localhost";
//   $dbuser = "root";
//   $dbpass = "";

	$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//$connection = mysqli_select_db($conn,$dbname);
    $response = "";
    if ($connection) {
        //$response = "success";
    }else{
        //$response = "db fail";
    }


    $organiser_phone1="0735135135";
    $organiser_phone2="0732542542";

    $organiser_email1="runners@legibra.solutions";
    $organiser_email2="accounts@legibra.com";

    // $organiser_email1="g.muhangia@legibra.co.ke";
    // $organiser_email2="g.muhangia@legibra.co.ke";

    if(isset($_POST["name"])){
        $_POST["name"]=ucfirst($_POST["name"]);
    }
    
    if(isset($_POST["phone"])){
    
    $_POST["phone"]=preg_replace('/[^0-9]/', '', $_POST["phone"]);
        $phone=(int)$_POST["phone"];
        // echo "$phone <br>";
        $_POST["phone"]=$phone;
        if(strlen($_POST["phone"])==12){
          // str_replace("254","",$_POST["phone"]);
        }elseif(strlen($_POST["phone"])==9) {
          $_POST["phone"]="254".$_POST["phone"];

        }elseif(strlen($_POST["phone"])>12){
          $_POST["phone"] =  str_replace(substr($_POST["phone"], -10),'',$_POST["phone"]) . substr($_POST["phone"], -9);
        }
        
    }

?>
