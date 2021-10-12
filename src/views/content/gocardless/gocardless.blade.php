<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Example</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">


</head>

<body>

    <!-- component -->
    <div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        style="background-image: url(https://images.unsplash.com/photo-1604262725913-1c415cd27564?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2142&q=80);"
        id="modal-id">
        <div class="leading-loose">
            <div class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                @if (empty(config('gateway.gc_access_token')))
                <p class="text-red-800 font-medium">
                    Please add cardless token in the .env file.
                </p>
                @else
                <p class="text-gray-800 font-medium">Customer information</p>
                <div class="">
                    <label class="block text-sm text-gray-00" for="cus_name">Name</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="first_name" name="cus_name"
                        type="text" required="" placeholder="Your Name" aria-label="Name">
                </div>
                <div class="">
                    <label class="block text-sm text-gray-00" for="cus_name">Last Name</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="last_name" name="cus_name"
                        type="text" required="" placeholder="Your Name" aria-label="Name">
                </div>
                <div class="mt-2">
                    <label class="block text-sm text-gray-600" for="cus_email">Email</label>
                    <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" name="email"
                        type="text" required="" placeholder="Your Email" aria-label="Email">
                </div>
                <div class="mt-2">
                    <label class=" block text-sm text-gray-600" for="cus_email">Address</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="address" name="address"
                        type="text" required="" placeholder="Street" aria-label="Email">
                </div>
                <div class="mt-2">
                    <label class="hidden text-sm block text-gray-600" for="cus_email">City</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="city" name="city" type="text"
                        required="" placeholder="City" aria-label="Email">
                </div>

                <div class="inline-block mt-2 w-1/2 pr-1">
                    <label class="hidden block text-sm text-gray-600" for="cus_email">Country</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="country" name="country"
                        type="text" required="" placeholder="Country" aria-label="Email">
                </div>
                <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                    <label class="hidden block text-sm text-gray-600" for="cus_email">Post Code</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="post_code" name="cus_email"
                        type="text" required="" placeholder="Zip" aria-label="Email">
                </div>
                <div class="mt-4">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit"
                        onclick="submitUser()">$10.00</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>

<script>
    /**
     * This Fuction will submit the user information to go cardless using using ajax request and the return is the
     * Location where you have to redirect the user, note that you can use a page load if you like
     * @return [type]
     */
    function submitUser() {

        let first_name = document.querySelector('#first_name').value;
        let last_name  = document.querySelector('#last_name').value;
        let email      = document.querySelector('#email').value;
        let address    = document.querySelector('#address').value;
        let city       = document.querySelector('#city').value;
        let country    = document.querySelector('#country').value;
        let post_code  = document.querySelector('#post_code').value;

        // Request fuction
        (async () => {
            const rawResponse = await fetch('/gocardless_pay/setup/debit', {
                method: 'POST',
                headers: {
                    "Content-Type"    : "application/json",
                    "Accept"          : "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token"    : '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    first_name:first_name,
                    last_name:last_name,
                    email:email,
                    address:address,
                    city:city,
                    country:country,
                    post_code:post_code,
                })
            });
            const content = await rawResponse.json();

            // Check for errors
            if (content.errors) {
                for (const [key, value] of Object.entries(content.errors)) {
                    console.log(value);
                }
            } else {
                window.location.href = content.data;
            }
        })();

    }


</script>

</html>
