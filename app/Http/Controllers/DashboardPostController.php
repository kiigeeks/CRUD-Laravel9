<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'title' => 'My Portal Berita',
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'title' => 'My Portal Berita',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'thumb' => 'image|file|max:1024',
            'desc' => 'required'
        ]);

        if($request->file('thumb')){
            $validateData['thumb'] = $request->file('thumb')->store('PostImage');
        }

        $validateData['user_id'] = auth()->user()->id;

        $result = Post::create($validateData);

        if ($result){
            return redirect('/dashboard/posts')->with('postAdd', 'Berhasil Tambahkan Post!');
        }else{
            return back()->with('postErr', 'Gagal Tambahkan Post!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->author->id !== auth()->user()->id) {
            abort(403);
        }
        return view('dashboard.posts.show',[
            'title' => 'Detail Portal Berita',
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->author->id !== auth()->user()->id) {
            abort(403);
        }
        return view('dashboard.posts.edit', [
            'post' => $post,
            'title' => 'My Portal Berita',
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'judul' => 'required|max:255',
            'category_id' => 'required',
            'thumb' => 'image|file|max:1024',
            'desc' => 'required'
        ];

        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }

        $validateData = $request->validate($rules);

        if($request->file('thumb')){
            if ($post->thumb){
                Storage::delete($post->thumb);
            }
            $validateData['thumb'] = $request->file('thumb')->store('PostImage');
        }

        $validateData['user_id'] = auth()->user()->id;

        $result = Post::where('id', $post->id)->update($validateData);

        if ($result){
            return redirect('/dashboard/posts')->with('postAdd', 'Berhasil Diupdate Post!');
        }else{
            return back()->with('postErr', 'Gagal Diupdate Post!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->thumb){
            Storage::delete($post->thumb);
        }

        $result = Post::destroy($post->id);

        if ($result){
            return redirect('/dashboard/posts')->with('postAdd', 'Post Berhasil Dihapus!');
        }else{
            return back()->with('postErr', 'Post Gagal Dihapus!');
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }

}
