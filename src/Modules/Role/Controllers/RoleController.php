<?php
namespace mariojgt\checkout\Modules\Role\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

// Models Used
use mariojgt\checkout\Modules\Role\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = Role::orderBy('area')->orderBy('display_order');

        if (Auth::guard('admin')->id() == '1') {
            $roles = $query->withTrashed()->get();
        } else {
            $roles = $query->get();
        }

        $breadcrumb = [
            'User Roles' => ''
        ];
        return view('checkout.role::index')->with(compact('breadcrumb', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checkout.role::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'description'   => 'required'
        ]);

        $role = Role::firstOrNew(['name' => request('name')]);
        $role->description = request('description');
        $role->area        = request('area', 'admin');
        $role->display_order = request('display_order', 10);
        $role->save();

        $message = [
        'type'    => 'success',
        'message' => 'Role was created.'
        ];

        return redirect()->back()
        ->with(compact('message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('checkout.role::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('checkout.role::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = [
        'type'    => 'success',
        'message' => 'Data was updated.'
        ];
        return redirect()->back()
        ->with(compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $role = Role::withTrashed()
            ->where('id', decrypt(request('encid')))
            ->first();

        if ($role->trashed()) {
             $role->forceDelete();
        } else {
            $role->delete();
        }
        return response('success');
    }

    /**
     * Restore the specified resource
     * @param  string $encid Encrypted id of row to remove
     * @return message        Succes message on restore
     */
    public function restore($encid)
    {
        $role = Role::withTrashed()
            ->find(decrypt($encid));
        $role->restore();

        $message = [
            'type'    => 'success',
            'message' => 'Data was restored.'
        ];
        return redirect()->back()
            ->with(compact('message'));
    }
}
