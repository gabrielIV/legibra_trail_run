<?php

if($_GET["t"]=="c9438bbb2dd7a969eb7acc1d16a47e7595adf29217da88bca014bb882e29496630db5d196182888dffdb95d7a00abbc9786cc58011fbf086f1de858ec217dbf5ea6258652e4a939c53d435e730e90833"){

}else{


    echo "<h2> > <code>Access Denied</code></h2>";
    exit();

    // echo bin2hex(random_bytes(80));

}


?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/semantic.min.css"/>
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/bootstrap.min.css"/>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/af-2.3.0/b-1.5.2/datatables.min.css"/>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"/> -->


  <title>Admin - Legibra Trail Run</title>
</head>

<body>

<div class="container">



<div class="float-right pt-4">

    <button type="button" class="btn btn-primary d-inline-block" data-toggle="modal" data-target="#exampleModalCenter">
    Sms to all
  </button>
  <button type="button" class="btn btn-danger d-inline-block" data-toggle="modal" data-target="#unpaid_modal">
    Sms to Unpaid
  </button>

  <div class="dropdown d-inline-block">

    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Export
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" target="_blank" href="php/csv.php">Export to csv</a>

    </div>
  </div>

</div>

  <h1 class="py-4">Legibra Trail Run</h1>
  <div class="row">
    <div class="col-md-6">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" onclick="fetch_all()" >All</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="fetch_paid()">paid</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false" onclick="fetch_unpaid()">Unpaid</a>
    </li>
  </ul>
    </div>
    <div class="col-md-6  ml-0 text-right" style="flex-grow:1">

    <div class="d-inline-block float-right pt-2">
    Paid  <span class="badge badge-info mr-3 ml-2 paid-stat">0</span>
    Unpaid  <span class="badge badge-info mr-3 ml-2 unpaid-stat">0</span>
    All  <span class="badge badge-info mr-3 ml-2 all-stat">0</span>
    </div>
  
    </div>
  </div> 


  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane pt-5 pb-5 fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">






      <table class="table table-hover table-bordered table-all">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Email</th>
            <th scope="col">Registration Date</th>
            <th scope="col">Tshirt size</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody id="all">

        </tbody>
      </table>






    </div>
    <div class="tab-pane pt-5 pb-5 fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">



      <table class="table table-hover table-bordered table-paid">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Email</th>
            <th scope="col">Registration Date</th>
            <th scope="col">Tshirt size</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody id="paid">

        </tbody>
      </table>




    </div>
    <div class="tab-pane pt-5 pb-5 fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

      <table class="table table-hover table-bordered table-unpaid ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Email</th>
            <th scope="col">Registration Date</th>
            <th scope="col">Tshirt size</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody id="unpaid">

        </tbody>
      </table>


<div class="mb-5 pt-5 pb-5">

</div>
    </div>
  </div>

</div>




  <!-- Optional JavaScript -->



  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Bulk Sms</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="all_form">
            <div class="form-group">
              <label for="exampleInputEmail1">Send to</label>
              <select class="form-control" name="group">
                <option value="*">All</option>
              </select>
              <small id="emailHelp" class="form-text text-muted">messages will be sent to the selected users.</small>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Sms </label>
              <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter sms text" rows="4" name="sms_text"></textarea>
              <small id="emailHelp" class="form-text text-muted">to use users data, use {name} for user's name, {phone} form users phone number and {email} for email.</small>
            </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="sendSms('all_form')">Send Sms</button>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="unpaid_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Unpaid bulk sms</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form id="unpaid_form">
            <div class="form-group">
              <label for="exampleInputEmail1">Send to</label>
              <select class="form-control" name="group">
                <option value="0">Unpaid</option>
              </select>
              <small id="emailHelp" class="form-text text-muted">messages will be sent to the selected users.</small>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Sms </label>
              <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter sms text" rows="4" name="sms_text" disabled>Hello .Thanks for registering for the Legibra Trail Run.Please complete your registration by paying a registration fee of KES. 2,000 using Paybill 461110. The account name is your full name.</textarea>
              <small id="emailHelp" class="form-text text-muted">to use users data, use {name} for user's name, {phone} form users phone number and {email} for email.</small>
            </div>

          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="sendSms('unpaid_form')">Send Sms</button>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/af-2.3.0/b-1.5.2/datatables.min.js"></script>

  <script type="text/javascript">
// alert("ok")
  fetch_all()
    function fetch_all() {

      $.ajax({
        url: "php/all.php",
        method: "post",
        data: "",
        success: function(data) {
            data=JSON.parse(data)
          // console.log(data);
          
            $("#all").html("")
            // $('.table-all').DataTable()
            $('.table-all').dataTable().fnClearTable();
          $('.table-all').dataTable().fnAddData(data);
        },
        error: function(error) {
          console.error(error);
        }
      })

      stats()

    }

var unique_id=0;

    function fetch_paid() {

      stats()

      $.ajax({
        url: "php/paid.php",
        method: "post",
        data: "",
        success: function(data) {
          console.log(data);
            data=JSON.parse(data)
            $('.table-paid').dataTable().fnClearTable();
          $('.table-paid').dataTable().fnAddData(data);

        },
        error: function(error) {
          console.error(error);
        }
      })

    }

    function fetch_unpaid() {

      $.ajax({
        url: "php/unpaid.php",
        method: "post",
        data: "",
        success: function(data) {

            data=JSON.parse(data)
            console.log(data);
            $('.table-unpaid').dataTable().fnClearTable();
          $('.table-unpaid').dataTable().fnAddData(data);

        },
        error: function(error) {
          console.error(error);
        }
      })

    }




    function changeStatus(status,id,el) {

        var button=$(el).parent().prev()

        $(button).prop("disabled",true);

      $.ajax({
        url: "php/update_status.php",
        method: "post",
        data: "status="+status+"&id="+id,
        success: function(data) {
            console.log(data)

            $(button).prop("disabled",false);

            if(status==1){

            $(button).html("Paid")
            $(button).removeClass("btn-danger")
            $(button).addClass("btn-success")

            }else{
                $(button).html("Not Paid")
            $(button).removeClass("btn-success")
            $(button).addClass("btn-danger")
            }

            alertify.success("Updated successfully")
            stats()

        },
        error: function(error) {
          console.error(error);
        }
      })

    }

    $(document).ready(function() {
    } );

function sendSms(smsid) {
var el=$(':input:disabled')
$(el).removeAttr('disabled');
console.log("#"+smsid);
// return false;

  var arr=$("#"+smsid).serializeArray();
var status="UNPAID"
if(arr[0].value=="*"){
  status="ALL"
}else if(arr[0].value=="1"){
  status="PAID"

}


  if( !confirm("This bulk messages will be sent to "+status+" users. Are you sure you want to continue") ){
    return false;
  }
  
  alertify.success("sending SMS ...")

  $.ajax({
    url: "php/bulk_sms.php",
    method: "get",
    data: "group="+arr[0].value+"&text="+arr[1].value,
    success: function(data) {

      console.log(data);
      alertify.success("SMS sent successfully.")

        // data=JSON.parse(data)
        // console.log(data);

    },
    error: function(error) {
      console.error(error);
    }
  })

  $(el).attr('disabled','disabled');
stats()

}


function stats(){

 $.ajax({
    url: "php/stats.php",
    method: "post",
    data: "",
    success: function(data) {
      data=JSON.parse(data)
      // console.log(data);
      
      // alertify.success("SMS sent successfully.")

        $(".paid-stat").html(data.paid)
        $(".unpaid-stat").html(data.unpaid)
        $(".all-stat").html(data.all)
        
        setTimeout(function() {
          stats()
        }, 5000);

    },
    error: function(error) {
      console.error(error);
    }
  })

}


stats()
  </script>


</body>

</html>
