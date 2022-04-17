<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredients;
use App\Models\Posts;
use App\Models\Tags;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Posts::paginate(10);
        return view('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $activetags = Ingredients::all();
        $category = Category::all();
        return view('admin.post.create', compact('category', 'tags', 'activetags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'namaproduk' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'gambar' => 'required',
            'ingrenot' => 'required',

        ]);

        $gambar = $request->gambar;
        $new_gambar = time() . $gambar->getClientOriginalName();

        $post = Posts::create([
            'namaproduk' => $request->namaproduk,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'gambar' => 'uploads/posts/' . $new_gambar,
            'ingrenot' => $request->ingrenot,
            'slug' => Str::slug($request->namaproduk),
            'users_id' => Auth::id()
        ]);

        $post->tags()->attach($request->tags);
        $post->ingredients()->attach($request->ingredients);
        $gambar->move('uploads/posts/', $new_gambar);
        return redirect('/post')->with('success', 'Produk Anda Berhasil Disimpan');
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
        $category = Category::All();
        $activetags = Ingredients::All();
        $tags = Tags::all();
        $post = Posts::findorfail($id);
        return view('admin.post.edit', compact('post', 'tags', 'category','activetags'));
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
        $this->validate($request, [
            'namaproduk' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'ingrenot' => 'required',

        ]);

        $post = Posts::findorfail($id);

        if ($request->has('gambar')) {
            $gambar = $request->gambar;
            $new_gambar = time() . $gambar->getClientOriginalName();
            $gambar->move('uploads/posts/', $new_gambar);

            $post_data = [
                'namaproduk' => $request->namaproduk,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'gambar' => 'uploads/posts/' . $new_gambar,
                'ingretn' => $request->ingrenot,
                'slug' => Str::slug($request->namaproduk)
            ];
        } else {
            $post_data = [
                'namaproduk' => $request->namaproduk,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'ingrenot' => $request->ingrenot,
                'slug' => Str::slug($request->namaproduk)
            ];
        }
        
        $post->tags()->sync($request->tags);
        $post->ingredients()->sync($request->ingredients);
        $post->update($post_data);


        return redirect('/post')->with('success', 'Produk Anda Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findorfail($id);
        $post->delete();

        return redirect('/post')->with('success', 'Produk Anda Berhasil Dihapus');
    }

    public function tampil_hapus()
    {
        $post = Posts::onlyTrashed()->paginate(10);
        return view('admin.post.hapus', compact('post'));
    }

    public function restore($id)
    {
        $post = Posts::withTrashed()->where('id', $id)->first();
        $post->restore();
        return redirect('/post')->with('success', 'Produk Anda Berhasil Direstore');
    }

    public function kill($id)
    {
        $post = Posts::withTrashed()->where('id', $id)->first();
        $post->forceDelete();

        return redirect('/post')->with('success', 'Produk Anda Berhasil Dihapus Permanen');
    }
}
