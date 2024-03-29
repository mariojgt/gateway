<?php

namespace Mariojgt\Gateway\Controllers;

use DateTime;
use Carbon\Carbon;
use Braintree\Gateway;
use GuzzleHttp\Client;
use Stripe\StripeClient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use XeroAPI\XeroPHP\Configuration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use XeroAPI\XeroPHP\Api\AccountingApi;
use Illuminate\Support\Facades\Storage;
use XeroAPI\XeroPHP\Models\Accounting\Account;
use XeroAPI\XeroPHP\Models\Accounting\AccountType;
use XeroAPI\XeroPHP\Models\Accounting\Currency;
use XeroAPI\XeroPHP\Models\Accounting\CurrencyCode;

/**
 * This Controller comes with the basic for a checkout out of the box
 * More fuction you need to extend and implement for you needs,
 * For more information check the api exporter
 * https://api-explorer.xero.com/
 */
class XeroController extends Controller
{
    // Xero API Endpoints
    public $xero_endpoint_accounting = 'https://api.xero.com/api.xro/2.0/';
    public $xero_endpoint_assets     = 'https://api.xero.com/assets.xro/1.0/';
    public $xero_endpoint_files      = 'https://api.xero.com/files.xro/1.0/';
    public $xero_endpoint_payroll    = 'https://api.xero.com/payroll.xro/2.0/';
    public $xero_endpoint_projects   = 'https://api.xero.com/projects.xro/2.0/';

    // Token we goin to use to access the Xero API this token is generated by the generateAcessToken() method
    public $bearer_token;
    // Tennent ID
    public $tenant_id;

    public function __construct()
    {
        // https://developer.xero.com/documentation/guides/oauth2/auth-flow#3-exchange-the-code ⬅️⬅️⬅️⬅️⬅️⬅️⬅️
        // Does the inicial request to xero so generate the token , More information please check the documentation
        $getAcessToken = $this->generateAcessToken();
        $this->bearer_token = $getAcessToken['access_token'];

        // Now does the request to xero to get the tenant id if we don;t have as part to the config file
        if (empty(config('gateway.target_tenant_id'))) {
            $tenantsInfo       = $this->getTenantId();
            $this->tenant_id = $tenantsInfo[0]['tenantId'];
        } else {
            $this->tenant_id = config('gateway.target_tenant_id');
        }
    }

    /**
     * Generate the Xero Account token
     * @return [type]
     */
    public function generateAcessToken()
    {
        if (empty(config('gateway.xero_client_id')) || empty(config('gateway.xero_client_secret'))) {
            throw new \Exception('Please set the Xero Client ID and Client Secret in the config file more information check https://developer.xero.com/app/manage');
        }
        // Sending the request to xero with the normal authorization and form data
        $response = Http::withBasicAuth(config('gateway.xero_client_id'), config('gateway.xero_client_secret'))
            ->asForm()
            ->post(
                'https://identity.xero.com/connect/token',
                [
                    'grant_type' => 'client_credentials',
                ]
            );

        if ($response->status() == 200) {
            return $response->json();
        } else {
            throw new \Exception('Xero CLient or Secret is not valid please generate one following on this link https://developer.xero.com/app/manage');
        }
    }

    /**
     * Get the accounts conected to this client id and secret
     * @param mixed $tempToken
     *
     * @return [type]
     */
    public function getTenantId()
    {
        // Does the request to get the accounts attach to this client id and secret
        $response = Http::withToken($this->bearer_token)->get('https://api.xero.com/connections');
        // Now return the data with status or trow an error
        if ($response->status() == 200) {
            return $response->json();
        } else {
            throw new \Exception('Xero CLient or Secret accounts not found please attach your account under my apps');
        }
    }

    /**
     * @return [type]
     */
    public function genericRequest()
    {
        $response = Http::acceptJson()
            ->withToken($this->bearer_token)
            ->get($this->xero_endpoint_accounting . 'Accounts');

        return $response;
    }

    public function getAccountsList()
    {
        $data = $this->doesRestApiRequest();
        dd($data->json());
        dd($this->bearer_token, $this->tenant_id);
    }
}
