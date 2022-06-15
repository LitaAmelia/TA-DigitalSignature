<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index', [
            'title' => 'Kategori',
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create', [
            'title' => 'Tambah Kategori',
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
        
        $rules = $request->validate([
            'nama' => 'required|max:255',
            'slug' => 'required|unique:kategoris'
        ],
        [
            'nama.required' => 'Nama Kategori harus diisi!',
            'nama.max' => 'Nama Kategori harus kurang dari 255 karakter',
            'slug.required' => 'Slug harus diisi!',
            'slug.unique' => 'Slug sudah ada!'
        ]);

        Kategori::create($rules);

        // return dd($request);
        return redirect('/kategori')->with('success', 'Kategori baru telah ditambahkan!');
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
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', [
            'title' => 'Edit Kategori',
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $rules = [
            'nama' => 'required|max:255',
        ];

        if($request->slug != $kategori->slug) {
            $rules['slug'] = 'required:unique:kategoris';
        }

        $validatedData = $request->validate($rules);

        Kategori::where('id', $kategori->id)->update($validatedData);

        return redirect('/kategori')->with('success', 'Kategori telah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        // Kategori::destroy($kategori->id);
        $kategori->delete();
        return redirect('/kategori')->with('success', 'Data telah berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kategori::class, 'slug', $request->nama);
        return response()->json(['slug'=>$slug]);
    }
}
