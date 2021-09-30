

@php
    use Mariojgt\Gateway\Controllers\BraintreeController;
    $brain = new BraintreeController();
@endphp
<script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
<!-- Step one: add an empty container to your page -->
<div id="dropin-container"></div>

<input type="hidden" id="nonce" name="payment_method_nonce" />
<script type="text/javascript">
    const form = document.getElementById('payment-form'); // <<<<< Attention to this id you need this
    braintree.dropin.create({
        authorization: '{{ $brain->clientToken() }}',
        container: '#dropin-container'
    }, (error, dropinInstance) => {
        if (error) console.error(error);

        form.addEventListener('submit', event => {
            event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);

                // Step four: when the user is ready to complete their
                //   transaction, use the dropinInstance to get a payment
                //   method nonce for the user's selected payment method, then add
                //   it a the hidden field before submitting the complete form to
                //   a server-side integration
                document.getElementById('nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>

