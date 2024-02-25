# Paypal Integration

The way this integration works is you need to drop the blade component in the checkout page and tell how much you wish to pay and give 3 routes, on where you will generate a session and maybe pre generate a order, one where the user decide to cancel , and the complete one.

### Setup

- Setup you env file, you can get those keys in this link https://developer.paypal.com/developer/applications

  ```
  PAYPAL_CLIENT_ID="yout_client_key"
  PAYPAL_SECRET="sercre_key"
  ```

- In the config file you can enable or disable the sandbox mode in the config varaible gateway.paypal_live

- Render the paypal widget, at this point you need to have a valid api and the config file with the routes setup

  ```html
  @php
          $amountYouWantToPay = "20.25";
      @endphp
  <x-gateway::pay_paypal amount="{{ $amountYouWantToPay }}" />
  ```

  

