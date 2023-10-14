<?php
require_once 'gbprimepay.php';
require_once '../connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>payment</title>
</head>
<body>
    <?php
    $token = "TOKEN";
    // $public_key = "PUBLIC_KEY";
    // $secret_key = "SECRET_KEY";
    $gbprimepay = new GBPrimePay();
    $qrcode = $gbprimepay->promptpay([
        'amount' => $_GET['amount'] . '.00',
        'referenceNo' => $_GET['referenceNo'] . 'PP000001',
        'backgroundUrl' => 'https://dev.0x01code.me/gbprimepay.webhook.php',
    ], $token);
    echo '<img src="' .$qrcode. '">';
    ?>
</body>
</html>