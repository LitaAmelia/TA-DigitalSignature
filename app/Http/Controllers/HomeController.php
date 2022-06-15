<?php

namespace App\Http\Controllers;

use App\Models\Qrcodes;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function index(Qrcodes $qrcodes)
    {
        // $qrcodes = Qrcodes::whereHash($hashCode)->first();
        return view('index', [
            'title' => 'Digital Signature',
            'qrcodes' => $qrcodes
        ]);
    }

    public function dashboard()
    {
        return view('dashboard.index', [
            'categories' => Kategori::withCount([
                'dokumens' => function ($query) {
                    $query->whereUserId(Auth::user()->id);
                }
            ])->get(),
            'title' => 'Dashboard'
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

    public function coba() {
        return view('coba', [
            'title' => 'Pencarian',
        ]);
    }

    public function cobacari(Request $request) {

        $search = $request->search;
        
        $qrcodes = Qrcodes::where('hash', 'LIKE', "%{$search}%")->first();
        return view('coba2',[
            'title' => 'Pencarian',
            'qrcodes' => $qrcodes
        ]);

    }
}
