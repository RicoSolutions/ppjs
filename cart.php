<?php

$amount = $_POST['amount'];
$amountc = $amount*100;
$guest = $_POST['guest'];
// $_SESSION['amount'] = $amountc;

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>payplug.js example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
  <script type="text/javascript" src="https://api.payplug.com/js/1.0/payplug.js"></script>

  <!-- Link to the Stripe jQuery library cloned from https://github.com/stripe/jquery.payment -->
  <script src="jquery_payment/lib/jquery.payment.js"></script>


<!-- Integrate Stripe jQuery.payment library -->
  <script>
  jQuery(function($) {
    $('[data-numeric]').payment('restrictNumeric');
    $('.cc-number').payment('formatCardNumber');
    $('.cc-exp').payment('formatCardExpiry');
    $('.cc-cvc').payment('formatCardCVC');
    $.fn.toggleInputError = function(erred) {
      this.parent('.form-group').toggleClass('has-error', erred);
      return this;
    };
    $('form').submit(function(e) {
      e.preventDefault();
      var cardType = $.payment.cardType($('.cc-number').val());
      $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
      $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
      $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
      $('.cc-brand').text(cardType);
      $('.validation').removeClass('text-danger text-success');
      $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
    });
  });
  </script>


<!-- Integrate PayPlug Library -->
  <script type="text/javascript">
  Payplug.setPublishableKey('pk_test_c163da4d8c413cbe9c99bd152afd64da');

  var payplugResponseHandler = function(code, response, details) {
    console.log(code + ' : ' + response + ' : ' + details);
    if (code == 'card_number_invalid') {
      document.querySelectorAll("#error-card-bad")[0].style.display = 'block';
    }
    if (code == 'cvv_invalid') {
      document.querySelectorAll("#error-cvv-bad")[0].style.display = 'block';
    }
    if (code == 'expiry_date_invalid') {
      document.querySelectorAll("#error-expiry-bad")[0].style.display = 'block';
    }
    if (code == 'payplug_api_error') {
      document.querySelectorAll("#error-api-bad")[0].innerHTML = response + ', details: ' +  details;
      document.querySelectorAll("#error-api-bad")[0].style.display = 'block';
    }
    return false;
  };

  document.addEventListener('DOMContentLoaded', function() {
    [].forEach.call(document.querySelectorAll("[data-payplug='form']"), function(el) {
      el.addEventListener('submit', function(event) {
        var form = document.querySelectorAll("#signupForm")[0];
        Payplug.card.createToken(form, payplugResponseHandler,
          {'amount': <?= $amountc; ?>,
          'currency': 'EUR'
        });
        event.preventDefault();
      })
    })
  })
  </script>


<!-- Write the form -->
</head>
<body>
  <div class="container">
    <div class="row">

      <header>
        <div class='col-sm-12'>
          <h1><i class="fa fa-smile-o fa-2x" aria-hidden="true"></i> payplug.js example</h1>
          <hr />
          <p class="intro">Welcome <?php echo $guest; ?>,</p>
          <p class="intro">This example is creating a payment of <?php echo $amount; ?>€.</p>
        </div>
      </header>
      <hr>

      <div class='col-sm-6'>

        <form action="payment.php" method="POST" id="signupForm" class="form" novalidate data-payplug="form">

          <div class="panel">
            <div class="panel-body">
              <div class="input-error-wrapper" id="error-api">
                <p class="input-error" id="error-api-bad"></p>
              </div>

              <p class="form-control-static">Firstname:
                <input id="firstname" type="text" class="form-control" id="firstname" name="firstname" placeholder="Your firstname" required autocomplete="on">
              </p>

              <p class="form-control-static">Lastname:
                <input id="lastname" type="text" class="form-control" id="lastname" name="lastname" placeholder="Your lastname" required autocomplete="on">
              </p>

              <p class="form-control-static">Email:
                <input id="email" type="text" class="form-control" id="email" placeholder="Email" name="email" value="" >
              </p>

              <p class="form-control-static">Card number:
                <input id="cc-number" type="text" class="form-control cc-number" autocomplete="cc-number"
                placeholder="•••• •••• •••• ••••" value="" data-payplug="card_number" required>
              </p>

              <div class="input-error-wrapper" id="error-card">
                <p class="input-error" id="error-card-bad" style="display:none;">Invalid payment card number.</p>
              </div>

              <p class="form-control-static">Card CVV:
                <input id="cc-cvc" type="text" class="form-control cc-cvc" autocomplete="off" placeholder="•••" data-payplug="card_cvv" required>
              </p>

              <div class="input-error-wrapper" id="error-cvv">
                <p class="input-error" id="error-cvv-bad" style="display:none;">Invalid CVV code.</p>
              </div>

              <p class="form-control-static">Card expiration:
                <input id="cc-exp" type="text" class="form-control cc-exp" autocomplete="cc-exp" placeholder="Expiration (MM/YY)" data-payplug="card_month_year" required>
              </p>

              <div class="input-error-wrapper" id="error-expiry">
                <p class="input-error" id="error-expiry-bad" style="display:none;">Invalid credit card expiration date.</p>
              </div>
              <br>

              <input type="hidden" name="amount" value="<?php echo $amount; ?>">

              <p>
                <button type="submit" class="btn btn-primary btn-block" data-payplug='submit'>Submit payment</button>
              </p>


            </form>

          </div>
        </div>


      </div>
    </div>
  </body>
  </html>
