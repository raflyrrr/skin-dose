<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;
use illuminate\support\Str;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activetag = Ingredients::paginate(10);
        return view('admin.activetag.index', compact('activetag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.activetag.create');
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
            'name' => 'required|min:3'

        ]);
        Ingredients::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect('/activetag')->with('success', 'Active Ingredients berhasil Disimpan');
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
        $activetags = Ingredients::findorfail($id);
        return view('admin.activetag.edit', compact('activetags'));
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
            'name' => 'required|min:3'

        ]);
        $activetag_data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];
        Ingredients::whereid($id)->update($activetag_data);

        return redirect()->route('activetag.index')->with('success', 'Active Ingredients berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activetag = Ingredients::findorfail($id);
        $activetag->delete();
        return redirect('/activetag')->with('success', 'Active Ingredients berhasil Dihapus!');
    }
}
