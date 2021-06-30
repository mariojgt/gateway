
{{-- Start Stripe --}}
{{-- This Component will load all the needed values so the user can pay with stripe --}}
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Start the stripe using the public key
    var stripe = Stripe("{{ config('gateway.stripe_secret_public') }}");
</script>

<script>
    /**
     * This Function will Request to the server a session token base on the user cart
     */
    function RegenerateSessionAndRedirect() {
        (async () => {
            const rawResponse = await fetch("{{ config('gateway.stripe_session_generate') }}", {
                method: 'POST',
                headers: {
                    "Content-Type"    : "application/json",
                    "Accept"          : "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token"    : "{{ csrf_token() }}" // get the site csrf_token
                },
            }).then(function(response) {
                // Return the json response
                return response.json();
            })
            .then(function(session) {
                // Get the return and redirect to the stipe checkout
                return stripe.redirectToCheckout({ sessionId: session.session });
            })
            .then(function(result) {
                // If `redirectToCheckout` fails due to a browser or network
                // error, you should display the localized error message to your
                // customer using `error.message`.
                if (result.error) {
                    alert(result.error.message);
                }
            });
        })();
    }
</script>
