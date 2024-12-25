<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index')->with(['users' => User::all(), 'posts' => Post::all(), 'categories' => Categories::all()]);
    }


    public function posts() {
        $posts = Post::paginate(10);
        $users = new User();

        return view('admin.posts')->with(['posts' => $posts, 'users' => $users]);
    }

    public function categories() {
        $categories = Categories::all();

        return view('admin.categories')->with(['categories' => $categories]);
    }

    public function users() {
        $users = User::all();

        return view('admin.users')->with(['users' => $users]);
    }
}
