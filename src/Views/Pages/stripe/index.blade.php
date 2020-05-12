<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{config("gateway.stripe_secret")}}');

    stripe.redirectToCheckout({
    sessionId: '{{$stripe_session->id}}'
    }).then(function (result) {
    // If `redirectToCheckout` fails due to a browser or network
    $('.errormsg').html(result.error.message);
    });
</script>
