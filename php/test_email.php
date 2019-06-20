<?php


 include ("connect.php");
    // email include data
    include  'email/PHPMailer/PHPMailerAutoload.php';
    include ("./email/send_email.php");



    sendEmail("gabrielkamau9@gmail.com","Test -Legibra trail run","Hello world ",$connection);

?>
