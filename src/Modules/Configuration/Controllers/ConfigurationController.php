<?php
namespace mariojgt\gateway\Modules\Configuration\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models Used
use mariojgt\gateway\Modules\Configuration\Models\Configuration;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = Configuration::orderBy('section')->get();

        foreach ($configs as $value) {
            $sections[$value->section] = $value->id;
        }
        $sections = array_flip($sections);

        $breadcrumb = [
            'Configuration' => ''
        ];
        return view('gateway.configuration::index')
            ->with(compact('breadcrumb', 'sections', 'configs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gateway.configuration::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required',
            'section'   => 'required',
            'class'     => 'nullable',
            'options'   => 'nullable',
            'notes'     => 'nullable',
        ]);

        Configuration::create($data);

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
        return view('gateway.configuration::show');
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
        return view('gateway.configuration::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (is_array(request('config'))) {
            foreach (request('config') as $key => $value) {
                Configuration::where('name', $key)
                    ->update(['value' => $value]);
            }
        }
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
