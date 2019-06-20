<?php

  // require 'email/PHPMailer/PHPMailerAutoload.php';
    include ("connect.php");

    // email include data
    include  'email/PHPMailer/PHPMailerAutoload.php';
    include ("./email/send_email.php");

    // sms include data
    include ('inc/AfricasTalkingGateway.php');
    include ("./sendsms.php");


     $_POST['phone']=htmlspecialchars($_POST['phone']);
     $_POST['name']=str_replace("'", "", $_POST['name']);
     $_POST['email']=htmlspecialchars($_POST['email']);
     
     


    $new_user=true;

    $query = "select * from online where email='$_POST[email]' and phoneNumber='$_POST[phone]' ;";

    $result = mysqli_query($connection, $query);

    echo $connection->error;


    while ($row=$result->fetch_assoc()) {
      // code...
      $new_user=false;
    }

    echo $new_user;

// ADD TO DATABASE IF ITS A NEW USER

if ($new_user) {
  // code...
    $query = "INSERT INTO `online` (`name`,`email`,`distance`,`phoneNumber`) VALUES ('$_POST[name]', '$_POST[email]', '$_POST[distance]', '$_POST[phone]');";

    $result = false;
    $result = mysqli_query($connection, $query);

    if($result){
        echo "successs";
    }else{
        echo "fail";
    }

    $result=$connection->query("select * from online where email='$_POST[email]' and phoneNumber='$_POST[phone]' order by id desc limit 1");

    echo "$connection->error";
     $row=$result->fetch_assoc();

     $user_id=$row['id'];

    

    // SEND NOTIFICATION MESSAGES AND EMAILS

    $phone=$_POST['phone'];
    $message="Hello $_POST[name] Thankyou for registering for the legibra trail run !!!";



    // sms message to Organizer

    sendSms($organiser_phone1,"$_POST[name] has registered for the Legibra Trail Run. Check Email for details and payment status.",$connection);
    
    sendSms($organiser_phone2,"$_POST[name] has registered for the Legibra Trail Run. Check Email for details and payment status.",$connection);

    // sms to client
    sendSms($_POST["phone"],"Legibra Trail Run Registration Confirmed. Please pay a registration fee of Ksh 2,000 using mPesa PayBill 461110 and account name ".strtoupper($_POST["name"])." .",$connection);

    // email to organiser
    sendEmail($organiser_email1,"$_POST[name] - Legibra Trail Run Registration.","

      <p>Hi Sylvia & Peter,</p>
      <p>I am $_POST[name] and I have registered for the Legibra Trail Run. Below are my details:</p>

      <ul>
        <li> <b>Name :</b> $_POST[name] </li>
        <li> <b>Mobile Number :</b> $_POST[phone] </li>
        <li> <b>Email :</b> $_POST[email] </li>
        <li> <b>Distance :</b> $_POST[distance] KM</li>
      </ul>

      <p><b>Thank you and see you at the start line.</b></p>
      <span>$_POST[name]</span>
    ",$connection,$organiser_email2);

    // email to client
        sendEmail($_POST['email'],"$_POST[name] - Legibra Trail Run Registration.","

          <p>Hi $_POST[name],</p>
          <p>Thank you for registering for the Legibra Trail Run.</p>
          <p>We have the following details.</p>

          <ul>
              <li> <b>Name :</b> $_POST[name] </li>
              <li> <b>Phone Number :</b> $_POST[phone] </li>
              <li> <b>Email Address :</b> $_POST[email] </li>
              <li> <b>Distance :</b> $_POST[distance] KM</li>
          </ul>

          <p> Please pay a registration fee of Ksh 2,000 using mPesa PayBill 461110 and account name ".strtoupper($_POST["name"])." or complete your payment here : https://run.legibra.com/payment.html?$row[id]=$row[phoneNumber] </p>
          
          <p>Keep fit for the D-Day.</p>
          <span>Sylvia & Peter.</span>
        ",$connection);
        
        //sendSuccessEmail($_POST["name"],$_POST["phone"],$_POST["email"],$_POST["distance"]);


  }



  $query = "select id,phoneNumber,status from online where email='$_POST[email]' and phoneNumber='$_POST[phone]' order by id desc limit 1;";

  $result = mysqli_query($connection, $query);

  echo $connection->error;


  $row=$result->fetch_assoc();



  // echo $row["id"];
if($row["status"]=="1"){
  header("Location: ../success.html");

}else {
  header("Location: ../payment.html?$row[id]=$row[phoneNumber]");

}



  ?>
