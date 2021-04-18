<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesFormRequest;

class CategoriesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category.index', ['only' => ['index']]);
        $this->middleware('permission:category.create', ['only' => ['create','store']]);
        $this->middleware('permission:category.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category.show', ['only' => ['show']]);
        $this->middleware('permission:category.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the categories.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('categories.index');
    }

    /**
     * Show the form for creating a new category.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a new category in the storage.
     *
     * @param App\Http\Requests\CategoriesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CategoriesFormRequest $request)
    {
        try {
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);
            return redirect()->route('categories.index')->with('success', __('global.successfully_added'));
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', "Error: " . $e->getMessage());
        }
    }

    /**
     * Display the specified category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\CategoriesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CategoriesFormRequest $request)
    {
        try {
            $category = Category::findOrFail($id);

            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'is_active' => $request->is_active,
            ]);

            return redirect()->route('categories.index')->with('success', __('global.successfully_updated'));
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('danger', "Error: ". $e->getMessage());
        }
    }

    /**
     * Remove the specified category from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return response()->json(['status' => 'warning', 'message' => __('global.successfully_destroy')]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    public function ajaxIndex(){
        $data = Category::select('id', 'name', 'is_active', 'updated_at')->orderBy("updated_at", 'desc');

        return Datatables::of($data)
        ->addColumn('is_active', function($data){
            $is_active = $data->is_active ? __('global.active') : __('global.inactive');
            return $is_active;
        })
        ->addColumn('updated_at', function($data){
            $updated_at = Carbon::parse($data->updated_at)->diffForHumans();
            return $updated_at;
        })
        ->addColumn('action', 'categories.actions' )
        ->rawColumns(['is_active', 'updated_at', 'action'])->make(true);
    }
}
