<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Media;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PagesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:page.index', ['only' => ['index']]);
        $this->middleware('permission:page.create', ['only' => ['create','store']]);
        $this->middleware('permission:page.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:page.show', ['only' => ['show']]);
        $this->middleware('permission:page.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media = Media::all();
        return view('page.create', compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required|unique:pages',
        ]);
        if ($validator->passes()) {
            $page = new Page();
            $page->title = $request->title;
            $page->content = $request->content;
            $page->user_id = Auth::id();
            $page->slug = Str::slug($request->title);
            $page->titleseo = $request->titleseo;
            $page->descseo = $request->descriptionseo;
            $page->keywordseo = $request->keywordseo;
            $save = $page->save();
            if ($save) {
                return redirect()->action('HomeController@page')->with('success', __('global.successfully_added'));
            }
        } else {
            return redirect()->route('page.create')->withErrors($validator)->withInput();
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
        $page = Page::find($id);
        $users = User::all()->pluck('name', 'id');
        $media = Media::all();
        if (!$page) {
            abort(404);
        }
        return view('page.edit',compact('page', 'media', 'users'));
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
        $page = Page::find($id);
        $validator = Validator::make(request()->all(), [
            'title' => ['required', Rule::unique('pages')->ignore($page->id)],
            'slug' => ['required', Rule::unique('pages')->ignore($page->id)],
        ]);
        if ($validator->passes()) {
            $page->title = $request->title;
            $page->content = $request->content;
            $page->user_id = $request->user_id;
            $page->slug = Str::slug($request->slug);
            $page->titleseo = $request->titleseo;
            $page->descseo = $request->descriptionseo;
            $page->keywordseo = $request->keywordseo;
            $save = $page->save();
            if ($save) {
                return redirect()->route('pages.index')->with('success', __('global.successfully_updated'));
            }
        } else {
            return redirect()->route('route.edit', $id)->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $page = Page::find($id);
            $page->delete();
            return response()->json(['status' => 'warning', 'message' => __('global.successfully_destroy')]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
        
    }

    public function mainPage($id){
        try {
            if ($id == setting('main_page')) {
                setting(['main_page' => ''])->save();
            } else {
                setting(['main_page' => $id])->save();
            }
            return response()->json(['status' => 'success', 'message' =>  __('global.successfully_updated')]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    public function ajaxIndex(){
        $data = Page::select('id', 'slug', 'user_id', 'title', 'updated_at');

        return Datatables::of($data)
        ->addColumn('author', function($data){
            $user = '<a href=" '. route('users.show', $data->user->id) . ' ">' .$data->user->name . '</a>';
            return $user;
        })
        ->addColumn('updated_at', function($data){
            $updated_at = Carbon::parse($data->updated_at)->diffForHumans();
            return $updated_at;
        })
        ->addColumn('status', function($data){
            $isMainPage = $data->id == setting('main_page') ? __('global.yes') : __('global.no');
            $btnMainPage = $data->id == setting('main_page') ? 'success' : 'primary';
            $iconMainPage = $data->id == setting('main_page') ? '<i class="far fa-check-circle"></i> ' : '<i class="fas fa-minus-circle"></i> ';

            $main_page = '<a class="btn btn-sm btn-'. $btnMainPage .'" href="javascript:void(0)" id="setMainPage" data-id="'. $data->id .'">'. $iconMainPage . $isMainPage .'</a>';
            return $main_page;
        })
        ->addColumn('action', 'page.actions' ) //add view actions
        ->rawColumns(['author', 'updated_at', 'status', 'action'])->make(true);
    }
}
