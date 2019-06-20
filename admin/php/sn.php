<?php

require '../../php/connect.php';

include '../../php/inc/AfricasTalkingGateway.php';
include '../../php/sendsms.php';

sendSms("0717638548","This is a test.",$connection);

 ?>
