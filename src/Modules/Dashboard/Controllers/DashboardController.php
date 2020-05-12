<?php

namespace mariojgt\gateway\Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use mariojgt\gateway\Modules\Dashboard\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        return view('gateway.dashboard::index');
    }
}
