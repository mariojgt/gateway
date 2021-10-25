# Gocardless integration

The Gocardless integration after you install the the gateway package you can access the following url /gocardless_pay out of the box you have a example how it works, there is a couple of things you have to add in order to be able to take payments or test the demo.

- ### Add you api keys in the env file

  ```
  GC_ACCESS_TOKEN='your_acess_token' // The token where you payments will be autenticated
  GOCARDLESS_WEBHOOK_ENDPOINT_SECRET='your_key' // Key used to autenticate the weebhook server
  GC_MANDATE_SUCCESS_PAGE='success.mandate' // The sucess page you will be redirect after setup the mandage
  ```

- ### Enable Weebhook 

  By default the weebhook comes enable but you can change that in the config file locate at gateway.gocardless_weebhook_enable , it handle 3 events, subscriptions create and cancel, and payment cancel, the way it work is they trigger some events that you can change to your need they are located at app/listeners/ look for Gocardless.

- ### More information how it works please check the DEMO