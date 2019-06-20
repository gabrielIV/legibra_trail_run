function radioClick(el) {

  console.log($(el).val());
  if ($(el).val() == "yes") {
    $(".pay-card").hide()
    $(".pay-card-2").show()
  } else {
    $(".pay-card-2").hide()

    $(".pay-card").show()


  }

}

var payment_method = "mpesa";


function getPaymentType(el) {

  payment_method = $(el).val()

}


function makePaymentMpesa() {

  var data = window.location.search.replace("?", "").split("=")

  $.ajax({
    url: "php/online.php",
    type: "POST",
    data: "id=" + data[0] + "&phone=" + data[1],
    success: function(n) {

      console.log(n);
      checkStatus()

      setTimeout(function() {
        window.location = "./error.html"
      }, 80000);
    },
    error: function(e) {
      console.error(e);
    }
  });

}


var payment_status = "0"

function checkStatus() {
  var data = window.location.search.replace("?", "").split("=")

  $.ajax({
    url: "php/check_payment.php",
    type: "POST",
    data: "id=" + data[0],
    success: function(n) {
      console.log(n);
      payment_status = n
      if (n == "1") {

        window.location = "./success.html"

      } else if (n == "2") {

        window.location = "./error.html"

      } else {


        setTimeout(function() {
          checkStatus()
        }, 5000);
      }
    },
    error: function(e) {
      console.error(e);
    }
  });
}



function pay() {
  if ($("#inlineRadio3").prop("checked")) {
    $("#mpesa_modal").modal()
    makePaymentMpesa()
  } else {
    $("#dpo_modal").modal()
    makePaymentDPO()

  }
}

function makePaymentDPO() {
  var data = window.location.search.replace("?", "").split("=")
  window.location="./php/DPO/dpo_request.php?id="+data[0]
}
