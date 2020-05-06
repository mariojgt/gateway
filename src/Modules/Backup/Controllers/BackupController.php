<?php
namespace mariojgt\checkout\Modules\Backup\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;
use DB;

// Models Used
use mariojgt\checkout\Modules\Admin\Models\Admin;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $tables = DB::select('SHOW TABLES');

        $tablesearch = "Tables_in_".strtolower(env('DB_DATABASE', 'forge'));

        $breadcrumb = [
            'Database Backups'   => ''
        ];

        return view('checkout.backup::index')
            ->with(compact('breadcrumb', 'tables', 'tablesearch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($table)
    {
        $model = DB::select('SELECT * FROM '.$table);
        $model = json_decode(json_encode($model), true);

        Excel::create($table, function ($excel) use ($model) {
            $excel->sheet('Sheet 1', function ($sheet) use ($model) {
                $sheet->fromArray($model);
            });
        })->export('xls');
        return false;
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
        return view('checkout.backup::show');
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
        return view('checkout.backup::edit');
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
