<?php

namespace Modules\Courses\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Section;
use Illuminate\Contracts\Support\Renderable;
use Modules\Courses\Http\Requests\CreateSectionRequest;

class SectionsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:section.index', ['only' => ['index']]);
        $this->middleware('permission:section.create', ['only' => ['create','store']]);
        $this->middleware('permission:section.edit', ['only' => ['edit','update', 'active']]);
        $this->middleware('permission:section.show', ['only' => ['show']]);
        $this->middleware('permission:section.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('courses::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('courses::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateSectionRequest $request)
    {
        try {
            $section = Section::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
            ]);
            return response()->json(['status' => 'success', 'code' => 200, 'data' =>  $section, 'message' =>  __('courses::global.successfully_added')]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => "Error: " . $th->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('courses::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return response()->json(['status' => 'success', 'message' =>  $section]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->update([
                'title' => $request->title,
            ]);
            return response()->json(['status' => 'success', 'code' => 200, 'data' =>  $section, 'message' =>  __('courses::global.successfully_updated')]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'danger', 'message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            Section::where('id', $id)->delete();
            return response()->json(['status' => 'warning', 'message' =>  __('courses::global.successfully_destroy')]);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'danger', 'message' => $e->getMessage()]);
        }
    }
}
