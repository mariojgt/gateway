<?php

namespace mariojgt\checkout\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use mariojgt\checkout\Modules\Dashboard\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        return view('checkout.dashboard::index');
    }
}
