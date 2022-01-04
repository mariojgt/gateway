<?php

namespace Mariojgt\Gateway\Controllers\Demo;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $xeroController = new XeroController();
        dd($xeroController->createAccount('test', '123'));
        return view('gateway::content.xero.index');
    }
}
