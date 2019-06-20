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


    $organiser_phone1="0723850725";
    $organiser_phone2="0720986349";

    $organiser_email1="s.korir@legibra.co.ke";
    $organiser_email2="ngugipm@gmail.com";

    if(isset($_POST["name"])){
        $_POST["name"]=ucfirst($_POST["name"]);
    }
?>
