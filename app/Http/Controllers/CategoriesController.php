<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $cat = new Categories();

        $cat->name = $request->name_cat;

        $cat->save();

        return redirect()->route('admin.categories');
    }

    public function show($id)
    {
        $cat = Categories::find($id)->name;
        $posts = Post::where('cat_id', $id)->latest()->paginate(5);
        return view('category.show')->with(['posts'=> $posts, 'cat' => $cat]);
    }

    
}
