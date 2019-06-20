<?php

    include ("connect.php");

    $query = "select status from online where id=$_POST[id];";

    $result = mysqli_query($connection, $query);

    $row=$result->fetch_assoc();

    echo $row["status"];


    if($row["status"]=="2"){
      $query = "UPDATE `online` SET `status` = 0  WHERE  id = $_POST[id] ";

      $result = mysqli_query($connection, $query);

      if($result){
          // echo "successs";
      }else{
          // echo "fail";
      }
    }




    ?>
