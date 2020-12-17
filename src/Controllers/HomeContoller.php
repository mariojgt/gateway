<?php

namespace Mariojgt\Gateway\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeContoller extends Controller
{
    public function index()
    {
        return view('gateway::content.index');
    }
}
