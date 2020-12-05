<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();

        $posts=Post::paginate(5);
        $users=User::all();

        return view('user.index', compact( 'categories','posts','users'));
    }

    public function admin()
    {
        $categories = Category::all();

        $posts=Post::paginate(5);
        $users=User::all();

        return view('admin.index', compact( 'categories','posts','users'));
    }
}
