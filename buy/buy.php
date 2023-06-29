<?php
require_once '../config.php';
require_once '../db/User.php';
require_once '../db/Subs.php';

if(!empty($_POST['sub_id'])&&!empty($_POST['jwt'])){
    $user=User::check($_POST['jwt']);
    if(!empty($user)){
        $subInfo=Subs::getById($_POST['sub_id']);
    }
}
?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<div id="paypal-button-container"></div>
<div id="paypal-button"></div>
<script>
    paypal.Button.render({
        env: '<?php echo PAYPAL_ENV; ?>',
        client: {
            sandbox: '<?php echo PAYPAL_API_CLIENT_ID; ?>',
            production: '<?php echo PAYPAL_API_CLIENT_ID; ?>'
        },
        payment: function (data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: '<?php echo isset($subInfo) ? $subInfo['cost'] : ''; ?>',
                        currency: 'USD'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function (data, actions) {
            return actions.payment.execute()
                .then(function () {
                   window.location = "process.php?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&sid=<?php echo isset($subInfo) ? $subInfo['id']: ''; ?>&uid=<?php echo isset($user) ? $user['id']: ''; ?>";
               });
        }
    }, '#paypal-button');
</script>