<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Media;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BlogsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:blog.index', ['only' => ['index']]);
        $this->middleware('permission:blog.create', ['only' => ['create','store']]);
        $this->middleware('permission:blog.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:blog.show', ['only' => ['show']]);
        $this->middleware('permission:blog.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blogs.index');
    }

    public function create()
    {
        $media = Media::all();
        $categories = Category::where('is_active', 1)->get();
        return view('blogs.create', compact('media', 'categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs',
        ]);

            $blog = new Blog();
            $blog->title = $request->title;
            $blog->content = $request->input('content');
            $blog->user_id = Auth::id();
            $blog->slug = Str::slug($request->title);
            $blog->titleseo = $request->titleseo;
            $blog->descseo = $request->descriptionseo;
            $blog->keywordseo = $request->keywordseo;
            $blog->visibility = $request->visibility;
            $blog->main_image = $request->main_image;
            $blog->published_at = Carbon::parse($request->published_at);
            $blog->save();

            $blog->categories()->attach($request->category);

            return redirect()->back()->with('success', __('global.successfully_added'));

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
        $media = Media::all();
        $categories = Category::where('is_active', 1)->get()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        $blog = Blog::find($id);

        if (!$blog) {
            abort(404);
        }
        return view('blogs.edit', compact('blog','media', 'categories', 'users'));
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
        $blog = Blog::find($id);

        $request->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('blogs')->ignore($blog->id)],
        ]);

        $blog->title = $request->title;
        $blog->content = $request->input('content');
        $blog->user_id = $request->user_id;
        $blog->slug = Str::slug($request->slug);
        $blog->titleseo = $request->titleseo;
        $blog->descseo = $request->descriptionseo;
        $blog->keywordseo = $request->keywordseo;
        $blog->visibility = $request->visibility;
        $blog->main_image = $request->main_image;
        $blog->published_at = Carbon::parse($request->published_at);
        $blog->save();

        $blog->categories()->sync($request->category);

        return redirect()->route('blogs.index')->with('success', __('global.successfully_updated'));

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
            $blog = Blog::find($id);
            $blog->delete();
            return response()->json(['status' => 'warning', 'message' => __('global.successfully_destroy')]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => "Error: " . $th->getMessage()]);
        }
    }

    public function ajaxIndex (){
        $data = Blog::with('categories', 'user')->orderBy("updated_at", 'desc');

        return Datatables::of($data)
        ->addColumn('author', function($data){
            $user = '<a href=" '. route('users.show', $data->user->id) . ' ">' .$data->user->name . '</a>';
            return $user;
        })
        ->addColumn('updated_at', function($data){
            $updated_at = $data->updated_at->format('Y/m/d');
            return $updated_at;
        })
        ->addColumn('action', 'blogs.actions' ) //add view actions
        ->rawColumns(['author', 'updated_at', 'category', 'action'])->make(true);
    }

}
