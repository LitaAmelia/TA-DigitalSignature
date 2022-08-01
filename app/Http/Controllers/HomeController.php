<?php

namespace App\Http\Controllers;

use App\Models\Qrcodes;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function index()
    {
        // $qrcodes = Qrcodes::whereHash($hashCode)->first();
        return view('index', [
            'title' => 'Digital Signature',
        ]);
    }

    public function dashboard()
    {
        return view('dashboard.dokumen', [
            'categories' => Kategori::withCount([
                'dokumens' => function ($query) {
                    $query->whereUserId(Auth::user()->id);
                }
            ])->get(),
            'title' => 'Dashboard',
            'kategoris' => Kategori::all(),
            'dokumens' => Dokumen::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function store(Request $request)
    {
        $no = 0;
        if (!$request->input('dokumen', [])) {
            return redirect('/dashboard')->with('warning', 'File is null');
        }
        foreach ($request->input('dokumen', []) as $file) {

            $judul = substr($file, 0, -4);
            $slug = Str::slug($judul);
            $namaFile = $request->input('nama_file_', []);
            $data = [
                'user_id' => auth()->user()->id,
                'kategori_id' => $request->input('kategori_id'),
                'judul' => $judul,
                'slug' => $slug,
                'file' => $namaFile[$no++],
            ];
            Dokumen::create($data);
        }
        return redirect('/dashboard#dokumen_show')->with('success', 'Dokumen baru berhasil ditambahkan!');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('dokumen');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $nama_string = $file->store('dokumen');

        return response()->json([
            'original_name' => $file->getClientOriginalName(),
            'nama_string' => $nama_string
        ]);
    }

    public function admin()
    {
        return view('dashboard.admin', [
            'title' => 'Dashboard Admin',
            'categories' => Kategori::count(),
            'users' => User::count()
        ]);
    }

    public function verifikasi($hashCode)
    {
        $qrcodes = Qrcodes::whereHash($hashCode)->first();
        return view('verifikasi', [
            'title' => 'Halaman Verifikasi',
            'qrcodes' => $qrcodes
        ]);
    }

    public function search(Request $request) {

        $search = $request->search;
        
        $qrcodes = Qrcodes::where('hash', 'LIKE', "%{$search}%")->first();
        return view('verifikasi',[
            'title' => 'Pencarian',
            'qrcodes' => $qrcodes
        ]);
    }
}
