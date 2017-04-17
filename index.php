<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payplugjs example</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <h1>Payplugjs example</h1>


                    <p>Send payment details via the Form below</p>

                    <br />

                    <form method="post" action="cart.php" action="payment.php" name="index" role="form" onsubmit="return checkForm(this);">

                      <div class="form-group">
                          <label for="guest">Please enter your firstname:</label>
                          <input type="text" class="form-control" id="guest" name="guest" placeholder="Your firstname" required autocomplete="on">
                      </div>

                        <div class="form-group">
                            <label for="amount">Which amount do you want to pay?:</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount to pay" required autocomplete="on">
                        </div>


                        <p class="text-align">
                            <button type="submit" class="btn btn-primary id=" submit ">Submit</button>
            </p>

          </form>



        </div>



      </div>

    </div>

  </section>

</body>

<br /><br /><br /><br />

<footer>
  <div>
    <a href="https://www.payplug.com " target="_blank ">
      <!--Center the image and make it responsive by the use of class="center-block img-responsive " -->
      <img src="https://s3-eu-west-1.amazonaws.com/payplug-badges/en/badge_wide.png " class="center-block img-responsive " width="500px " border="0 "/>
    </a>
  </div>
</footer>
</html>
