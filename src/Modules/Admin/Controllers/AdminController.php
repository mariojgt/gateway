<?php

namespace mariojgt\checkout\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mariojgt\checkout\Modules\Admin\Models\Admin;
use mariojgt\checkout\Modules\Role\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::get();
        $roles = Role::orderBy('display_order')->get();

        // $user = Admin::find(1);

        // $user->roles()->attach(Role::where('name', 'super admin')->first());

        $breadcrumb = [
            'Admin Users'    => ''
        ];
        return view('checkout.admin::index')
            ->with(compact('breadcrumb', 'admins', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'surname'   => 'required',
            'email'     => 'email|required',
            'role'      => 'int|required'
        ]);

        $admin = Admin::create();
        $admin->name = request('name');
        $admin->surname = request('surname');
        $admin->email = request('email');
        $admin->username = request('username');
        $admin->save();

        $admin->roles()->attach(request('role'));

        $message = [
            'type'    => 'success',
            'message' => 'Admin was created.'
        ];
        return redirect()->back()
            ->with(compact('message'));
    }
}
