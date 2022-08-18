<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    public function index()
    {
        $header = "";
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $header = "in " . $category->nama;
        }

        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $header = "by " . $author->name;
        }

        return view('posts', [
            'title' => 'Portal Berita',
            'headerPage' => 'All Post '.$header,
            'Navcategories' => Category::all(),
            'posts' => Post::latest()->cari(request(['search', 'category', 'author']))
            ->paginate(7)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('post',[
            'title' => 'Portal Berita',
            'headerPage' => '',
            'Navcategories' => Category::all(),
            "post" => $post
        ]);
    }
}
