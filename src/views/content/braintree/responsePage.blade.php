<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Braintree payment Example</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <!-- component -->
    <div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        style="background-image: url(https://images.unsplash.com/photo-1604262725913-1c415cd27564?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2142&q=80);"
        id="modal-id">
        <div class="leading-loose">

            @if ($result->success)
            <div class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                <div class="flex my-10 border-2 border-green-700 rounded-sm p-5 bg-green-50 justify-between items-center">
                    <div class="flex justify-start gap-5 items-center">
                        <div class="w-20 h-20 bg-green-700 rounded-lg"></div>
                        <div>
                            <h1 class="font-bold tracking-wider text-gray-700">Success</h1>
                            <span class="tracking-wider uppercase text-xs text-green-700 font-bold">Approved</span>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 text-sm font-mono subpixel-antialiased
                                bg-gray-800  pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                        <div class="top mb-2 flex">
                            <div class="h-3 w-3 bg-green-500 rounded-full"></div>
                            <div class="ml-2 h-3 w-3 bg-orange-300 rounded-full"></div>
                            <div class="ml-2 h-3 w-3 bg-green-500 rounded-full"></div>
                        </div>
                        <div class="mt-4 flex">
                            <span class="text-green-400">Response:~$</span>
                            <p class="flex-1 typing items-center pl-2">
                                {{ $result }}
                                <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">

                <div class="flex my-10 border-2 border-red-700 rounded-sm p-5 bg-red-50 justify-between items-center">
                    <div class="flex justify-start gap-5 items-center">
                        <div class="w-20 h-20 bg-red-700 rounded-lg"></div>
                        <div>
                            <h1 class="font-bold tracking-wider text-gray-700">Error</h1>
                            <span
                                class="tracking-wider uppercase text-xs text-red-700 font-bold">{{ $result->message }}</span>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="coding inverse-toggle px-5 pt-4 shadow-lg text-gray-100 text-sm font-mono subpixel-antialiased
                                bg-gray-800  pb-6 pt-4 rounded-lg leading-normal overflow-hidden">
                        <div class="top mb-2 flex">
                            <div class="h-3 w-3 bg-red-500 rounded-full"></div>
                            <div class="ml-2 h-3 w-3 bg-orange-300 rounded-full"></div>
                            <div class="ml-2 h-3 w-3 bg-green-500 rounded-full"></div>
                        </div>
                        <div class="mt-4 flex">
                            <span class="text-green-400">Response:~$</span>
                            <p class="flex-1 typing items-center pl-2">
                                {{ $result }}
                                <br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</body>


</html>
