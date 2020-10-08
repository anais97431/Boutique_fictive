<?php
/* 
 * PayPal and database configuration 
 */

// PayPal configuration 
define('PAYPAL_ID', 'sb-8szdr976758@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

define('PAYPAL_RETURN_URL', 'http://localhost/paypal/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/paypal/cancel.php');
// define('PAYPAL_NOTIFY_URL', 'http://localhost/paypal/ipn.php');
define('PAYPAL_CURRENCY', 'EUR');


// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">

        <div class="pro-box">
            <div class="body">
                <!-- PayPal payment form for displaying the buy button -->
                <form action="<?php echo PAYPAL_URL; ?>" method="post">

                    <div>A PAYER 100 Euro</div>


                    <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">

                    <!-- Specify details le nom de la personne. -->
                    <input type="hidden" name="item_name" value="André Postel">
                    <!-- Si IPN retour id_user -->
                    <input type="hidden" name="item_number" value="45">
                    <!-- Somme a envoyer a Paypal -->
                    <input type="hidden" name="amount" value="100">
                    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

                    <!-- Specify URLs -->
                    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                    <!-- <input type="hidden" name="notify_url" value="<?php // echo PAYPAL_NOTIFY_URL; 
                                                                        ?>"> -->

                    <!-- Display the payment button. -->
                    <input type="submit" name="submit" value="Payer par Paypal">

                </form>
            </div>
        </div>
        <?php  ?>
    </div>

    <!-- <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
    <script>
    paypal.Buttons().render('body');
    </script> -->



</body>

</html>