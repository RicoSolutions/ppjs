<?php
$secretkey = "sk_test_FebNwoDiYrcepKwkkRJt6";

$email = htmlspecialchars($_POST['email']);
$firstname = htmlspecialchars($_POST['firstname']);
$lastname = htmlspecialchars($_POST['lastname']);
$token = $_POST['payplugToken'];
// $amountc = $_SESSION['amount'];
$amountc = $_POST['amount'];


require_once("payplug-php/lib/init.php");
\Payplug\Payplug::setSecretKey($secretkey);

try {
  $payment = \Payplug\Payment::create(array(
    'amount'         => $amountc*100,
    'currency'       => 'EUR',
    'payment_method' => $token,
    'customer'       => array(
      'email'           => $email,
      'first_name'       => $firstname,
      'last_name'        => $lastname
    ),
    'notification_url' => 'https://ppjs.rico.solutions/notifications.html'
  ));
} catch (\Payplug\Exception\ConnectionException $e) {
  echo "Connection  with the PayPlug API failed.";
} catch (\Payplug\Exception\InvalidPaymentException $e) {
  echo "Payment object provided is invalid.";
} catch (\Payplug\Exception\UndefinedAttributeException $e) {
  echo "Requested attribute is undefined.";
} catch (\Payplug\Exception\HttpException $e) {
  echo "Http errors.";
} catch (\Payplug\Exception\PayplugException $e) {
  echo 'Failure code: ' . $e->getMessage();
} catch (Exception $e) {
  echo 'Caught exception: '. $e->getMessage();
}

if ($payment->is_paid == true) {
  echo "<div><strong>Thanks " . $payment->customer->email . ", your payment has been accepted.</strong></div>";
} else {
  var_dump($e);
  echo "<div><strong>Error !</strong><br />". $payment->failure->message ." (" . $payment->failure->code . ").</div>";
}
