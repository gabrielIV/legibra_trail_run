<?php




function sendSuccessEmail($name,$phone,$email,$distance,$connection){

    $organiser_phone1="0735135135";
    // $organiser_phone2="0723634326";
    //$organiser_phone2="0720986349";

    $organiser_email1="runners@legibra.solutions";
    $organiser_email2="accounts@legibra.com";
    //$organiser_email2="ngugipm@gmail.com";


    sendEmail($organiser_email1,"$name - Legibra Trail Run Registration.","

      <p>Hi Sylvia,</p>
      <p>$name has paid for the Legibra Trail Run on ".date("Y-m-d h:i:sa")." </p>

      <ul>
        <li> <b>Name :</b> $name </li>
        <li> <b>Mobile Number :</b> $phone </li>
        <li> <b>Email :</b> $email </li>
        <li> <b>Distance :</b> $distance KM</li>
      </ul>
      <p>Please ensure that an E-reciept is sent to $name</p>

    ",$connection,array($organiser_email2));

    sendSms($organiser_phone1,"$name has paid for the Legibra Trail Run.
$phone

",$connection);
}


function sendEmail($email,$subject,$message,$connection,$cc='')
{
	// code...
  			// $name=$_POST['name'];
        // $email = $email;
        // $message = $message;

		date_default_timezone_set('Etc/UTC');
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'legibra.net';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "run@legibra.solutions";
		//Password to use for SMTP authentication
		$mail->Password = "Run@legibra.254";
		//Set who the message is to be sent from
		$mail->setFrom('run@legibra.solutions', 'Legibra Trail Run');
		//Set who the message is to be sent to
		$mail->addAddress($email, $subject);
		//Set the subject line
		$mail->Subject = $subject;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
        $mail->isHTML(true);
        // $mail->SMTPDebug = 2;

        $mail->msgHTML( $message );
            if(is_array($cc)){

		       foreach ($cc as $cc_email) {
                    $mail->AddCC($cc_email);
                }

		   }else{
				if($cc!=''){

				    $mail->AddCC($cc);
				    }


				}

		//send the message, check for errors

		$email_status="";
		if ($mail->send()){
			echo "<br>Email sent successfully <br>";
			$email_status="Email sent successfully";
		} else {
		    echo "Mailer Error: " . $mail->ErrorInfo;
				$email_status="Mailer Error: " . $mail->ErrorInfo;
		}

		$res=$connection->query("insert into emails (sender , reciever , status , message) values( 'run@legibra.solutions' , '$email' , '$email_status' ,'$message' ) ; ");
		echo $connection->error;
	}


?>
