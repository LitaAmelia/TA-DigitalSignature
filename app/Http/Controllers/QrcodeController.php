<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Qrcodes;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    public function index()
    {
        return view('qrcode.index', [
            'title' => 'QR-Code',
            'qrcodes' => Auth::user()->qrcodes
        ]);
    }

    public function create(Dokumen $dokumen)
    {
        return view('qrcode.create', [
            'title' => 'Generate',
            'dokumen' => $dokumen
        ]);
    }

    public function store(Request $request)
    {
        $rules = $request->validate([
            'dokumen_id' => 'required',
            'hash' => 'required|unique:qrcodes'
        ],
        [
            'dokumen_id.required' => 'Dokumen harus diisi!',
            'hash.required' => 'Digital Signature harus diisi!',
            'hash.unique' => 'Digital Signature sudah ada!'
        ]);

        $salt = Str::random();

        $rules['hash'] = hash('sha256', $rules['hash'].$salt);
        //$rules['user_id'] = auth()->user()->id;

        $qr = QrCode::format('png')
        // ->merge('img/t.jpg', 0.1, true)
        ->size(100)->errorCorrection('H')
        // ->generate(route("verifikasi", $rules['hash']) . "?kode=" . $rules['hash']);    
        // ->generate(route("verifikasi") . "?kode=" . $rules['hash']);
        ->generate(route("search") . "?search=" . $rules['hash']);
        // ->generate(route("verifikasi", $rules['hash']) . "?kode=" . $rules['hash']);    

        $output_file = '/image/qr-code/img-' . time() . '.png';
        Storage::disk('public')->put($output_file, $qr);
        // dd($output_file);

        $data = [
            'dokumen_id' => $request->dokumen_id,
            'hash' => $rules['hash'],
            'image' => $output_file,
        ];

        Qrcodes::create($data);

        return redirect('/qrcode')->with('success', 'QR Code telah ditambahkan!');
    }

    public function print(Qrcodes $qrcode)
    {
        $file = base_path('public/storage/' . $qrcode->dokumen->file);
        $qr_code = 'storage' . $qrcode->image;

        //Set source PDF file
        $pdf = new Fpdi();
        if(file_exists($file)) {
            $pagecount = $pdf->setSourceFile($file);
        } else {
            die("File PDF not found!");
        }

        //Add QR Code to PDF
        for($i=1;$i<=$pagecount;$i++) {
            $tpl = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($tpl);
            $pdf->AddPage();
            $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);

            if($i == 1) {
                $x_final = ($size['width']-60);
                $y_final = ($size['height']-30);
                $pdf->image($qr_code, $x_final, $y_final, 0, 0, 'PNG');
            }
        }
        $pdf->Output();
    }

    public function destroy(Qrcodes $qrcode)
    {
        if($qrcode->image){
            Storage::delete($qrcode->image);
        }

        Qrcodes::destroy($qrcode->id);
        
        return redirect('/qrcode')->with('success', 'Data telah berhasil dihapus!');
    }


}
