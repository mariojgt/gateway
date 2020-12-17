<div>
    @php
        use Mariojgt\Gateway\Controllers\BraintreeGatewayContoller;
        $brainTree = new BraintreeGatewayContoller;
        $clientId = $brainTree->clientToken();
    @endphp

    <div id="payment-form"></div>
    <input type="hidden" id="clien_data" name="client_data" >

    {{-- need js for the payment button --}}
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script src="https://js.braintreegateway.com/web/3.69.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.69.0/js/data-collector.min.js"></script>
    <script>

        var clientToken = "{{ $clientId }}";
            braintree.setup(clientToken, "dropin", {
                container: "payment-form"
            });

            braintree.client.create({
                authorization: clientToken
            }, function(err, clientInstance) {
                // Creation of any other components...
                braintree.dataCollector.create({
                    client: clientInstance,
                    paypal: true
                }, function(err, dataCollectorInstance) {
                    if (err) {
                        // Handle error in creation of data collector
                        return;
                    }
                    // At this point, you should access the dataCollectorInstance.deviceData value and provide it
                    // To your server, e.g. by injecting it into your form as a hidden input.
                    var deviceData = dataCollectorInstance.deviceData;
                    deviceData = JSON.parse(deviceData);
                    // Set the hidden vield with the value we need
                    document.querySelector('#clien_data').value = deviceData.correlation_id
                });
            });

    </script>
</div>
