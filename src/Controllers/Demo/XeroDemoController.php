<?php

namespace Mariojgt\Gateway\Controllers\Demo;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Mariojgt\Gateway\Controllers\XeroController;
use Mariojgt\Gateway\Controllers\BraintreeController;
use Mariojgt\Gateway\Controllers\GocardlessController;

class XeroDemoController extends Controller
{
    /**
     * @return [blade view]
     */
    public function index()
    {
        // ? Start the xero controller that does the request to generate the bearer token and get the tenant id
        // ! also hasve the end points we can you, in order to make this generic all the request will be deal outsie
        // ! the xero controller class so you can perform more generic requests
        $xeroController = new XeroController();
        //? More information check the end poins in the https://api-explorer.xero.com
        ///#2 Here the end points list we can use to make the requests
        //* $xero_endpoint_accounting ACCOUNTING
        //* $xero_endpoint_assets ASSETS
        //* $xero_endpoint_files FILES
        //* $xero_endpoint_payroll PAYROLL
        //* $xero_endpoint_projects PROJECTS

        //* In Here a example to get all the accounts for more examples please check the https://api-explorer.xero.com
        // Note that $xeroController->xero_endpoint_accounting has the end point for the accounts but you can use any of the end points of add your own
        $response = Http::acceptJson()
            ->withToken($xeroController->bearer_token) // This is the token comes from the xero controller
            ->get($xeroController->xero_endpoint_accounting . 'Accounts'); // End point
        // Return the information as a colletion
        $accountsInfo = [
            'accounts'     => collect($response->json()['Accounts'])->take(3), // Take the first 10 accounts as collection
            'ProviderName' => $response->json()['ProviderName'],
        ];

        // Now we goin to get some invoices just as an example
        $responseInvoice = Http::acceptJson()
            ->withToken($xeroController->bearer_token) // This is the token comes from the xero controller
            ->get($xeroController->xero_endpoint_accounting . 'Invoices'); // End point

        $invoicesInfo = [
            'invoices'     => collect($responseInvoice->json()['Invoices'])->take(3),
            'ProviderName' => $response->json()['ProviderName'],
        ];

        return view('gateway::content.xero.index', compact('accountsInfo', 'invoicesInfo'));
    }

    /**
     ** Example create invoice
     *
     * @param Request $request
     *
     * @return [type]
     */
    public function createInvoice(Request $request)
    {
        // Call the xero helper that has the end points and generate the bearer token
        $xeroController = new XeroController();
        $invoiceArray = [
            "Invoices" => [
                [
                    //! ACCPAY or ACCREC More information https://developer.xero.com/documentation/api/accounting/types#invoices
                    "Type" => Request('type'),
                    "Contact" => [ // Contact array we can also create a contact in xero at this point
                        "ContactID" => Request('account_id'),
                        "name"      => Request('type'),
                    ],
                    "LineItems" => [ // array of items
                        [
                            "Description" => Request('item_description'),
                            "Quantity"    => Request('item_quantity'),       //* Qty of items
                            "UnitAmount"  => Request('item_unit_amount'),    //* In pounds
                            "AccountCode" => Request('item_account_code'),   //? Not sure leave as 200
                            "TaxType"     => Request('item_tax_type'),       //* Uk Has whole list of avalaibe for now is none
                            "LineAmount"  => Request('item_line_amount'),    //* In pounds
                        ]
                    ],
                    "Date"      => Carbon::now()->format('Y-m-d'),
                    "DueDate"   => Carbon::now()->addDay()->format('Y-m-d'),
                    "Reference" => Request('item_reference'),
                    "Status"    => Request('item_status'),
                ]
            ]
        ];

        // Sedn the request to the xero controller with aplication/json and send the invoice array
        $responseInvoice = Http::acceptJson()
            ->withToken($xeroController->bearer_token) // This is the token comes from the xero controller
            ->withBody(json_encode($invoiceArray, true), 'application/json')
            ->post($xeroController->xero_endpoint_accounting . 'Invoices'); // End point

        dd($responseInvoice->json(), 'Request Example');
    }
}
