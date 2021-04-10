<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:media.index', ['only' => ['index']]);
        $this->middleware('permission:media.create', ['only' => ['create','store']]);
        $this->middleware('permission:media.edit', ['only' => ['edit','update', 'active']]);
        $this->middleware('permission:media.show', ['only' => ['show']]);
        $this->middleware('permission:media.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('media.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            if ($request->ajax()) {
                $files = $request->file('files');

                $destinationPath = '/uploads/' . date('Y') . '/' . date('m') . '/' . date('d'); //chmod 0777
                
                $data = [];

                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    $dataMedia = Media::create([
                        'user_id' => auth()->user()->id,
                        'file' => $filename,
                        'path' => "/storage" .  $destinationPath . '/' . $filename,
                        'extension' => $extension,
                    ]);

                    $data[] = $dataMedia->path;

                    $file->storeAs($destinationPath, $filename, 'public'); //save to path          
                }

                return response()->json(['status' => 'success', 'message' =>  $data]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
       
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try{
            $media = Media::find($id);
            $name = $media->file;
            $destinationPath = storage_path() . '/app/public/uploads/';

            if (file_exists($destinationPath . $name)) {
                File::delete($destinationPath . $name);
            }

            $delete = $media->delete();

            if ($delete) {
                return redirect()->back()->with('warning', __('global.successfully_destroy'));
            }
        } catch (\Exception $e){
            return redirect()->back('media.index')->with('danger', "Error: ". $e->getMessage());
        }
    }

    public function ajaxIndex (Request $request){
        if ($request->ajax()) {
            $medias = Media::orderBy("created_at", 'desc')->paginate(18);
            return view('media.items', compact('medias'));
        }
    }
}
