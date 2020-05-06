<?php
namespace DummyNamespace\Modules\DummyModuleName\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models Used
use DummyNamespace\Modules\DummyModuleName\Models\DummyModuleName;

class DummyModuleNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('DummyPackage.DummyModuleNameLower::index');
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('DummyPackage.DummyModuleNameLower::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'type'    => 'success',
            'message' => 'Data was created.'
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
        return view('DummyPackage.DummyModuleNameLower::show');
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
        return view('DummyPackage.DummyModuleNameLower::edit');
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
    public function destroy($id)
    {
        $message = [
            'type'    => 'success',
            'message' => 'Data was deleted.'
        ];
        return redirect()->back()
            ->with(compact('message'));
    }
}
