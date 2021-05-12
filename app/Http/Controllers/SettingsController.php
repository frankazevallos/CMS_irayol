<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:setting.index', ['only' => ['index']]);
        $this->middleware('permission:setting.create', ['only' => ['create','store']]);
        $this->middleware('permission:setting.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:setting.show', ['only' => ['show']]);
        $this->middleware('permission:setting.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the settings.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * Show the form for creating a new setting.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a new setting in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $data = $this->getData($request);
            Setting::create($data);
            return redirect()->route('setting.index')->with('success', __('global.successfully_added'));
        } catch (Exception $e) {
            return redirect()->back()->with('danger', "Error: ". $e->getMessage());
        }
    }

    /**
     * Display the specified setting.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $setting = Setting::findOrFail($id);

        return view('settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified setting.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return response()->json(['status' => 'success', 'message' =>  $setting]);
    }

    /**
     * Update the specified setting in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $this->getData($request);
            $setting = Setting::findOrFail($id);
            $setting->update($data);

            return response()->json(['status' => 'success', 'message' =>  $setting]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified setting from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $setting = Setting::findOrFail($id);
            $setting->delete();

            return redirect()->route('setting.index')->with('warning', __('global.successfully_destroy'));
        } catch (Exception $e) {
            return redirect()->back()->with('danger', "Error: ". $e->getMessage());
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'key' => 'required|string|min:1|max:191',
            'value' => 'required|string|min:1|max:191|nullable'
        ];
        $data = $request->validate($rules);
        return $data;
    }

    public function ajaxIndex(){
        $data = Setting::select('id', 'key', 'value',)->orderBy("id", 'desc');

        return Datatables::of($data)
        ->addColumn('action', function($data){
            return '<a class="btn btn-primary btn-sm" href="javascript:void(0)" id="editSetting" data-id="'.$data->id.'" ><i class="fas fa-pencil-alt"></i>' ." " . __('global.edit') . '</a>';
        })
        ->rawColumns(['action'])->make(true);
    }

}
