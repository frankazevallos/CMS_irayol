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
                        'path' => $destinationPath . '/' . $filename,
                        'extension' => $extension,
                    ]);
                    
                    $data[] = array('id' => $dataMedia->id, 'path' => $dataMedia->getFile());

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
        try {
            $media = Media::findOrFail($id);
            return response()->json(['status' => 'success', 'message' =>  $media]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            
            $media = Media::findOrFail($id);
            $destinationPath = storage_path() . '/app/public/' . $media->path;

            if (file_exists($destinationPath)) {
                $media['size'] = $media->formatSizeUnits(filesize($destinationPath));
            }

            $media['path'] = $media->getFile();

            return response()->json(['status' => 'success', 'message' =>  $media]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
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
        try {
            $media = Media::findOrFail($id);
            $media->update($request->all());
            return response()->json(['status' => 'success', 'message' =>  $media]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {   
        try {
            $media = Media::find($id);
            $destinationPath = storage_path() . '/app/public/' . $media->path;

            if (file_exists($destinationPath)) {
                File::delete($destinationPath);
            }

            $media->delete();

            return response()->json(['status' => 'success', 'message' => __('global.successfully_destroy')]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
    }

    public function ajaxIndex (Request $request){
        try {
            if ($request->ajax()) {

                $query = str_replace(" ", "%", $request->get('query'));

                if($query != '') {
                    $medias = Media::where('file', 'like', '%'.$query.'%')->orderBy("created_at", 'desc')->paginate(18);
                } else {
                    $medias = Media::orderBy("created_at", 'desc')->paginate(18);
                }

                return view('media.items', compact('medias'))->render();
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
        
    }
}
