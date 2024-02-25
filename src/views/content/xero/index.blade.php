<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xero payment Example</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <!-- component -->
    <div class="min-w-screen h-screen animated fadeIn faster left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"
        style="background-image: url(https://images.unsplash.com/photo-1604262725913-1c415cd27564?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2142&q=80);"
        id="modal-id">

        <div class="">
            <div class="w-full">
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <div class="bg-white shadow rounded-lg p-6">
                    <form action="{{ route('xero.create.invoice') }}" method="POST">
                        @csrf
                        <div class="grid lg:grid-cols-2 gap-6">
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="name" class="bg-white text-gray-600 px-1">Type *</label>
                                    </p>
                                </div>
                                <div class="flex justify-center">
                                    <div class="mb-3 xl:w-96">
                                        <select class="form-select appearance-none
                                    block
                                    w-full
                                    px-3
                                    py-1.5
                                    text-base
                                    font-normal
                                    text-gray-700
                                    bg-white bg-clip-padding bg-no-repeat
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                            name="type" aria-label="Default select example">
                                            <option selected value="ACCPAY">ACCPAY</option>
                                            <option value="ACCREC">ACCREC</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="lastname" class="bg-white text-gray-600 px-1">Account Number Or Id
                                            *</label>
                                    </p>
                                </div>
                                <p>
                                    <input id="lastname" autocomplete="false" tabindex="0" type="text" name="account_id"
                                        class="py-1 px-1 outline-none block h-full w-full">
                                </p>
                            </div>
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="username" class="bg-white text-gray-600 px-1">Item
                                            Description</label>
                                    </p>
                                </div>
                                <p>
                                    <input id="username" autocomplete="false" tabindex="0" type="text"
                                        name="item_description" class="py-1 px-1 outline-none block h-full w-full">
                                </p>
                            </div>
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="password" class="bg-white text-gray-600 px-1">Item Quantity
                                            *</label>
                                    </p>
                                </div>
                                <p>
                                    <input id="password" autocomplete="false" tabindex="0" value="2" type="text"
                                        name="item_quantity" class="py-1 px-1 outline-none block h-full w-full">
                                </p>
                            </div>
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="password" class="bg-white text-gray-600 px-1">Item UnitAmount
                                            *</label>
                                    </p>
                                </div>
                                <p>
                                    <input id="password" autocomplete="false" tabindex="0" value="20" type="text"
                                        name="item_unit_amount" class="py-1 px-1 outline-none block h-full w-full">
                                </p>
                            </div>
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="password" class="bg-white text-gray-600 px-1">Item AccountCode
                                            *</label>
                                    </p>
                                </div>
                                <p>
                                    <input id="password" autocomplete="false" tabindex="0" value="200" type="text"
                                        name="item_account_code" class="py-1 px-1 outline-none block h-full w-full">
                                </p>
                            </div>
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="password" class="bg-white text-gray-600 px-1">Item TaxType *</label>
                                    </p>
                                </div>
                                <p>
                                    <input id="password" autocomplete="false" tabindex="0" value="NONE" type="text"
                                        name="item_tax_type" class="py-1 px-1 outline-none block h-full w-full">
                                </p>
                            </div>
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="password" class="bg-white text-gray-600 px-1">Item LineAmount
                                            *</label>
                                    </p>
                                </div>
                                <p>
                                    <input id="password" autocomplete="false" tabindex="0" value="40" type="text"
                                        name="item_line_amount" class="py-1 px-1 outline-none block h-full w-full">
                                </p>
                            </div>
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="password" class="bg-white text-gray-600 px-1">Item Reference
                                            *</label>
                                    </p>
                                </div>
                                <p>
                                    <input id="password" autocomplete="false" tabindex="0" value="Your reference"
                                        type="text" name="item_reference"
                                        class="py-1 px-1 outline-none block h-full w-full">
                                </p>
                            </div>
                            <div
                                class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                    <p>
                                        <label for="password" class="bg-white text-gray-600 px-1">Item Status *</label>
                                    </p>
                                </div>
                                <div class="flex justify-center">
                                    <div class="mb-3 xl:w-96">
                                        <select class="form-select appearance-none
                                    block
                                    w-full
                                    px-3
                                    py-1.5
                                    text-base
                                    font-normal
                                    text-gray-700
                                    bg-white bg-clip-padding bg-no-repeat
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                            name="item_status" aria-label="Default select example">
                                            <option selected value="DRAFT">DRAFT</option>
                                            <option value="SUBMITTED">SUBMITTED</option>
                                            <option value="AUTHORISED">AUTHORISED</option>
                                            <option value="DELETED">DELETED</option>
                                            <option value="SUBMITTED">SUBMITTED</option>
                                            <option value="AUTHORISED">AUTHORISED</option>
                                            <option value="DELETED">DELETED</option>
                                            <option value="VOIDED">VOIDED</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-t mt-6 pt-3">
                            <button
                                class="rounded text-gray-100 px-3 py-1 bg-blue-500 hover:shadow-inner hover:bg-blue-700 transition-all duration-300">
                                Create Invoice
                            </button>
                        </div>
                    </form>
                </div>


                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-blueGray-700">My Accounts</h3>
                            </div>
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                <button
                                    class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button">Check Documentation</button>
                            </div>
                        </div>
                    </div>

                    <div class="block w-full overflow-x-auto">
                        <table class="items-center bg-transparent w-full border-collapse ">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Name
                                    </th>
                                    <th
                                        class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Type
                                    </th>
                                    <th
                                        class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        BankAccountNumber
                                    </th>
                                    <th
                                        class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Account Number
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($accountsInfo['accounts'] as $item)
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                        {{ $item['Name'] }}
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                        {{ $item['Status'] }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $item['Type'] }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <i class="fas fa-arrow-up text-emerald-500 mr-4"></i>
                                        {{ $item['BankAccountNumber'] ?? '-' }}
                                        {{ $item['BankAccountType'] }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <i class="fas fa-arrow-up text-emerald-500 mr-4"></i>
                                        {{ $item['AccountID'] }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Example invoice list --}}
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-blueGray-700">My Invoices</h3>
                            </div>
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                                <button
                                    class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button">Check Documentation</button>
                            </div>
                        </div>
                    </div>

                    <div class="block w-full overflow-x-auto">
                        <table class="items-center bg-transparent w-full border-collapse ">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Type
                                    </th>
                                    <th
                                        class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        InvoiceID
                                    </th>
                                    <th
                                        class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        InvoiceNumber
                                    </th>
                                    <th
                                        class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        SubTotal
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($invoicesInfo['invoices'] as $item)
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                        {{ $item['Type'] }}
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                                        {{ $item['InvoiceID'] }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $item['InvoiceNumber'] }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <i class="fas fa-arrow-up text-emerald-500 mr-4"></i>
                                        {{ $item['SubTotal'] }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="max-w-2xl mx-auto">

                <div
                    class="p-4 max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Userfull Link for documentation</h3>
                    </div>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Xero Api Reference
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            <a href="https://developer.xero.com/documentation/api/accounting/overview" target="_blank" class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                                                Link
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Xero Api Explorer
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            <a href="https://api-explorer.xero.com" target="_blank" class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                                                Link
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Accounts apps
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            <a href="https://developer.xero.com/app/manage" target="_blank" class="bg-indigo-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" >
                                                Link
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="mt-5">This card component is part of a larger, open-source library of Tailwind CSS components.
                    Learn more
                    by going to the official <a class="text-blue-600 hover:underline"
                        href="https://developer.xero.com/" target="_blank">Documentation</a>.
                </p>
            </div>

        </div>
    </div>
</body>

</html>
