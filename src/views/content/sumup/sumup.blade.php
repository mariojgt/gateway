<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sumup payment Example</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <!-- component -->
    <div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        style="background-image: url(https://images.unsplash.com/photo-1604262725913-1c415cd27564?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2142&q=80);"
        id="modal-id">
        <div class="leading-loose">
            <form id="payment-form" action="{{ route('sumup.pay') }}" method="POST">
                @csrf
                <div class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                    @if (empty(config('gateway.sumup_client_secret')))
                    <p class="text-red-800 font-medium">
                        Please add sumup token in the .env file, if you don't have a token please visit
                        <a target="_blank"
                            href="https://me.sumup.com/en-us">https://me.sumup.com/en-us</a>
                    </p>
                    @else
                    <p class="text-gray-800 font-medium">Customer information</p>
                    <div class="">
                        <label class="block text-sm text-gray-00" for="cus_name">Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="first_name"
                            name="first_name" type="text" required="" placeholder="Your Name" aria-label="Name">
                    </div>
                    <div class="">
                        <label class="block text-sm text-gray-00" for="cus_name">Last Name</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="last_name"
                            name="last_name" type="text" required="" placeholder="Your Name" aria-label="Name">
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
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="city" name="city"
                            type="text" required="" placeholder="City" aria-label="Email">
                    </div>

                    <div class="inline-block mt-2 w-1/2 pr-1">
                        <label class="hidden block text-sm text-gray-600" for="cus_email">Country</label>
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="country" name="country"
                            type="text" required="" placeholder="Country" aria-label="Email">
                    </div>
                    <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
                        <label class="hidden block text-sm text-gray-600" for="cus_email">Post Code</label>
                        <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="post_code"
                            name="cus_email" type="text" required="" placeholder="Zip" aria-label="Email">
                    </div>

                    <div class="mt-4">

                    </div>
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                        type="submit">Paynow</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</body>

</html>
