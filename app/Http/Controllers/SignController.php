<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
 
class SignController extends Controller
{
	public function index()
	{
    		// mengambil data dari table pegawai
		$qrcodes = DB::table('qrcodes')->paginate(10);
 
    		// mengirim data pegawai ke view index
		return view('sign',['qrcodes' => $qrcodes]);
 
	}
 
	public function search(Request $request)
	{
		// menangkap data pencarian
		$search = $request->search;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$qrcodes = DB::table('qrcodes')
		->where('hash','like',"%".$search."%")
		->paginate();
 
    		// mengirim data pegawai ke view index
		return view('sign',['qrcodes' => $qrcodes]);
 
	}
 
}