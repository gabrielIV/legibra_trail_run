<?php

    // Be sure to include the file you've just downloaded
    require_once('inc/AfricasTalkingGateway.php');

    // Specify your login credentials
    $username   = "sandbox";
    $apikey     = "fafb5abf4c449faad3534328d3baa83a7c4978f2385eb281bb7aa16bc0568f27";//"04d1e4c431a14b7b7ea83160c3c45ffce63393af50f55c5d80cffd2566215e3a";

    //recipients
    $recipients = $phone;

    $message = $message;

    // $gateway    = new AfricasTalkingGateway($username, $apikey);

    $gateway    = new AfricasTalkingGateway($username, $apikey, "sandbox");

    // so wrap the call in a try-catch block
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
                echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                      </button>
                                      Message sent successfully
                                    </div>";
            }else{
                echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                      </button>
                                      unable to save to database
                                    </div>";
            }


    //        echo " Number: " .$result->number;
    //        echo " Status: " .$result->status;
    //        echo " MessageId: " .$result->messageId;
    //        echo " Cost: "   .$result->cost."\n";
        }
    }
    catch ( AfricasTalkingGatewayException $e )
    {
        echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
                                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                      </button>
                                      Error in sending sms $e
                                    </div>";
    }

?>
