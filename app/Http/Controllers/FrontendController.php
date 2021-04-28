<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //main home
    public function index()
    {
        if (setting('main_page')) {
            $page = Page::findOrFail(setting('main_page'));
            return view('home.index', compact('page'));
        }
        return view('home.default');
    }

    //show blog pages
    public function showblog($slug)
    {
        $setting = '';
        $blog = Blog::where('slug', '=', $slug)->first();
        if (!$blog) {
            abort(404);
        }
        return view('blog.show',compact('blog', 'setting'));
    }

    public function blog()
    {
        $blogs = Blog::with('categories', 'user')->orderBy("created_at", 'desc')->paginate();
        return view('blog.index', compact('blogs'));
    }

    //show blog pages
    public function showpage($slug)
    {
        $setting = '';
        $page = Page::where('slug', '=', $slug)->first();
        if (!$page) {
            abort(404);
        }
        return view('page.show', compact('page', 'setting'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->with('blogs')->first();
        $blogs = $category->blogs()->paginate(14);
        return view('category.show', compact('category', 'blogs'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        dd($page);
    }

    public function post($slug)
    {
        $post = Blog::where('slug', $slug)->first();
        dd($post);
    }

    public function search(Request $request){
        $search = $request->input('search');
        $blogs = Blog::query()->where('title', 'LIKE', "%{$search}%")->orWhere('content', 'LIKE', "%{$search}%")->paginate();
        return view('blog.search', compact('blogs', 'search'));
    }
}
