<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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
                $image = ['gif', 'png', 'jpg', 'jpeg', 'raw', 'webp',];

                $destinationPath = '/uploads/' . date('Y') . '/' . date('m') . '/' . date('d');

                $data = [];

                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    $file->storeAs($destinationPath, $filename, 'public');

                    if(in_array($extension, $image)){

                        $img = Image::make($file);
                        $img->resize(600, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        $img->save(public_path() . '/storage/' . $destinationPath . '/'. 'thumb_'.$filename, 60);

                        $thumb = '/storage/' . $destinationPath . '/' . 'thumb_' . $filename;
                    } else {
                        $thumb = null;
                    }

                    $dataMedia = Media::create([
                        'user_id' => auth()->user()->id,
                        'file' => $filename,
                        'path' => '/storage' . $destinationPath . '/' . $filename,
                        'thumb' => $thumb,
                        'extension' => $extension,
                    ]);

                    $data[] = array('id' => $dataMedia->id, 'path' => $dataMedia->getFile());
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
    public function show($id){
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
    public function edit($id){
        try {

            $media = Media::findOrFail($id);
            $destinationPath = public_path()  . $media->path;

            if (file_exists($destinationPath)) {
                $media['size'] = $media->formatSizeUnits(filesize($destinationPath));
            }

            $media['filePath'] = $media->path;
            $media['path'] = $media->getFile('path');

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
    public function update(Request $request, $id){
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
    public function destroy($id){
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

                $media = new Media();
                $medias = $media->getMediaAjax($request->get('query'), " ");
                return view('media.items', compact('medias'))->render();
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
    }

    public function getMediaModal(Request $request){
        try {
            if ($request->ajax()) {
                $image = ['gif', 'png', 'jpg', 'jpeg', 'raw', 'webp',];

                $media = new Media();
                $medias = $media->getMediaAjaxType($request->get('query'), $image);

                return view('media.modal-insert', compact('medias'))->render();
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
    }
}
