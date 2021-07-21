{{-- Start Stripe --}}
{{-- This Component will load all the needed values so the user can pay with stripe --}}
<div id="paypal-button-container"></div>

<script
    src="{{ 'https://www.paypal.com/sdk/js?client-id=' . config('gateway.paypal_client_id') . '&currency=GBP&debug=true' }}">
</script>

<script>
    paypal.Buttons({
    createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: "{{ $amount ?? '10.00' }}"
                }
            }]
        });
    },
    onInit: function(data, actions)  {
        console.log(actions);
    },
    // onClick is called when the button is clicked
    onClick: function()  {
        // Send the request to the back end to generate a pre order
        fetch("{{ config('gateway.paypal_session_generate') }}", {
                method: 'POST',
                headers: {
                    "Content-Type"    : "application/json",
                    "Accept"          : "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token"    : "{{ csrf_token() }}" // get the site csrf_token
                },
            }).then(function(response) {
                // Return the json response
                console.log(response.json());
                return response.json();
            })
            .then(function(result) {
                // If `redirectToCheckout` fails due to a browser or network
                // error, you should display the localized error message to your
                // customer using `error.message`.
                if (result.error) {
                    alert(result.error.message);
                }
            });

    },
    onCancel: function (data) {
        fetch("{{ config('gateway.paypal_session_degenerate') }}", {
                method: 'POST',
                headers: {
                    "Content-Type"    : "application/json",
                    "Accept"          : "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token"    : "{{ csrf_token() }}" // get the site csrf_token
                },
            }).then(function(response) {
                // Return the json response
                console.log(response.json());
                return response.json();
            })
            .then(function(result) {
                // If `redirectToCheckout` fails due to a browser or network
                // error, you should display the localized error message to your
                // customer using `error.message`.
                if (result.error) {
                    alert(result.error.message);
                }
            });
    },
    onApprove: function(data, actions) {
        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            console.log("{{ config('gateway.paypal_complete') }}");
            // This function shows a transaction success message to your buyer.
            // alert('Transaction completed by ' + details.payer.name.given_name);
            // console.log(details.id);
            window.location = "{{ config('gateway.paypal_complete') }}" + '?session=' + details.id;
        });
        }
    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
</script>
