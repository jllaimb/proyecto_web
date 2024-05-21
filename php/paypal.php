<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

 <!-- Set up a container element for the button -->
 <div id="paypal-button-container"></div>

<!-- Include the PayPal JavaScript SDK -->

<script src="https://www.paypal.com/sdk/js?client-id=AZK6ysIcb3mH7E2GrG7Tlb6qkUUqJEKzaylQxl8t13NWk3Fqs7C0R3mKrDqWTDeVkw4xHaCON81Z8HpU&currency=EUR"></script>
<!-- <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script> -->
<script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({

        style: {
            color:  'blue',
            shape:  'pill',
            label:  'pay',
            height: 40
        },
        createOrder: function(data, actions){
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: 100
                    }
                }]
            });
        },

        onApprove: function(data, actions){
            actions.order.capture().then(function(detalles){
               // console.log(detalles);
               window.location.href='../html/completado.html'

            });
        },

        onCancel: function(data){
            alert("Pago cancelado");
            console.log(data);
        }

    }).render('#paypal-button-container');
</script>



</body>
</html>