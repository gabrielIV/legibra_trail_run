<?php

    // Be sure to include the file you've just downloaded
    // require_once('inc/AfricasTalkingGateway.php');

    // Specify your login credentials

    /**
     *
     */


  function sendSms($phone,$message,$connection)
      {
        // code...

              $username   = "legibra_marathon";
              $apikey     = "dc75459a332128b4ec7c8184bfaf1d9cfcf51fdba098a5d727a35667f356f774";

            //  $username   = "Legibra_trail_run";
            //  $apikey     = "cbf174e4f73df5d025e5390bfd74b98904fa4d1924ad0c3398fd8bcaf2ec949e";

            
             $recipients = $phone;
             //
             // $message = $message;

             $gateway    = new AfricasTalkingGateway($username, $apikey);

            //   $gateway = new AfricasTalkingGateway($username, $apikey, "sandbox");

          try
          {
              // Thats it, hit send and we'll take care of the rest.
              $results = $gateway->sendMessage($recipients, $message);

              foreach($results as $result) {
                  // status is either "Success" or "error message"


                  $query = "INSERT INTO `sms` (`id`, `phone`, `message`, `status`, `cost`) VALUES (NULL, '$result->number', '$message', '$result->status', '$result->cost')";
                  $result=mysqli_query($connection,$query);
                  //$count=mysqli_num_rows($result);

                  if($result==1){
                      echo "Message added successfully";
                  }else{
                      echo "error saving in database";
                  }


          //        echo " Number: " .$result->number;
          //        echo " Status: " .$result->status;
          //        echo " MessageId: " .$result->messageId;
          //        echo " Cost: "   .$result->cost."\n";
              }
          }
          catch ( AfricasTalkingGatewayException $e )
          {
              echo "Error sending message $e";
          }

        }


?>
