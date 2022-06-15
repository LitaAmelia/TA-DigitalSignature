<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\Kategori;
use  Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dokumen.index', [
            'title' => 'Dokumen',
            'dokumens' => Dokumen::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dokumen.create', [
            'title' => 'Tambah Dokumen',
            'kategoris' => Kategori::all()
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
            'judul' => 'required|max:255',
            'slug' => 'required|unique:dokumens',
            'kategori_id' => 'required',
            'file' => 'required|file|mimes:pdf|max:1024'
        ],
        [
            'judul.required' => 'Judul harus diisi!',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'slug.required' => 'Slug harus diisi!',
            'slug.unique' => 'SLug sudah ada!',
            'kategori_id.required' => 'Kategori harus diisi!',
            'file.required' => 'File harus diisi',
            'file.mimes' => 'Format file harus pdf!',
            'file.max' => 'Ukuran file tidak boleh lebih dari 1024kb!'
        ]);

        if($request->file('file')) {
            $rules['file'] = $request->file('file')->store('dokumen');
        }

        $rules['user_id'] = auth()->user()->id;

        Dokumen::create($rules);

        return redirect('/dokumen')->with('success', 'Dokumen baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumen $dokumen)
    {
        return view('dokumen.show', [
            'title' => 'Detail Dokumen',
            'dokumen' => $dokumen
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumen $dokumen)
    {
        return view('dokumen.edit', [
            'title' => 'Edit Dokumen',
            'dokumen' => $dokumen,
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumen $dokumen)
    {
        $rules = [
            'judul' => 'required|max:255',
            'kategori_id' => 'required',
            'file' => 'file|mimes:pdf|max:1024'
        ];

        if($request->slug != $dokumen->slug) {
            $rules['slug'] = 'required|unique:dokumen';
        }

        $validatedData = $request->validate($rules);

        if($request->file('file')) {
            if($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['file'] = $request->file('file')->store('dokumen');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Dokumen::where('id', $dokumen->id)
            ->update($validatedData);

        return redirect('/dokumen')->with('success', 'Data telah berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumen $dokumen)
    {
        if($dokumen->file) {
            Storage::delete($dokumen->file);
        }

        Dokumen::destroy($dokumen->id);
        return redirect('/dokumen')->with('success', 'Data telah berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Dokumen::class, 'slug', $request->judul);
        return response()->json(['slug'=>$slug]);
    }
}
