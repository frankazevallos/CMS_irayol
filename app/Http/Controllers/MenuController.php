<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu.index');
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|min:2|max:30'
        ]);

        $menu = new Menu();
        $menu->title = $request->title;
        $menu->remark = $request->remark;
        $menu->save();

        return redirect()->back()->with('success', __('global.successfully_added'));
    }

    public function edit($id)
    {
        $menuId = $id;
        $menuItems          = MenuItem::with(['children'])->where('parent', null)->where('menu_id', $id)->orderBy('order', 'asc')->get();
        $categories         = Category::orderBy('id', 'ASC')->get();
        $pages              = Page::all();
        $posts              = Blog::orderBy('id', 'desc')->get();

        return view('menu.edit', compact('menuItems', 'categories', 'pages', 'posts', 'menuId'));
    }


    public function update(Request $request){
        Validator::make($request->all(), [
            'title'     => 'required|min:2|max:30',
            'menu_id'   => 'required'
        ])->validate();

        $menu = Menu::find($request->menu_id);
        $menu->title = $request->title;
        $menu->remark = $request->remark;
        $menu->save();

        return redirect()->back()->with('success', __('global.successfully_updated'));
    }

    public function destroy($id){
        try {
            $menu = Menu::find($id);
            $menu->delete();
            return response()->json(['status' => 'warning', 'message' => __('global.successfully_destroy')]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    public function mainMenu($id)
    {
        try {
            if ($id == setting('main_menu')) {
                setting(['main_menu' => ''])->save();
            } else {
                setting(['main_menu' => $id])->save();
            }
            
            return response()->json(['status' => 'success', 'message' =>  __('global.successfully_updated')]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
    }

    public function ajaxIndex(Request $request)
    {
        $data = Menu::select('id', 'title', 'updated_at')->orderBy("updated_at", 'desc');

        return Datatables::of($data)
        ->addColumn('updated_at', function($data){
            $updated_at = Carbon::parse($data->updated_at)->diffForHumans();
            return $updated_at;
        })
        ->addColumn('status', function($data){
            $isMainMenu = $data->id == setting('main_menu') ? __('global.yes') : __('global.no');
            $btnMainMenu = $data->id == setting('main_menu') ? 'success' : 'primary';
            $iconMainMenu = $data->id == setting('main_menu') ? '<i class="far fa-check-circle"></i> ' : '<i class="fas fa-minus-circle"></i> ';

            $main_menu = '<a class="btn btn-sm btn-'. $btnMainMenu .'" href="javascript:void(0)" id="setMainMenu" data-id="'. $data->id .'">'. $iconMainMenu . $isMainMenu .'</a>';
            return $main_menu;
        })
        ->addColumn('action', 'menu.actions' )
        ->rawColumns(['title', 'status', 'updated_at', 'action'])->make(true);
    }

}
