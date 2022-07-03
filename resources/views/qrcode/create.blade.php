@extends('dashboard.layouts.main')

@section('content')
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Form Generate QR Code</p>
          <form class="forms-sample" action="{{ route('qrcode.store') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="dokumen_id">Judul Dokumen</label>
              <input type="text" class="form-control" id="dokumen_judul" name="dokumen_judul" readonly value="{{ $dokumen->judul }}">
              <input type="hidden" class="form-control" id="dokumen_id" name="dokumen_id" value="{{ $dokumen->id }}">
            </div>
            <div class="form-group">
              <label for="kategori_id">kategori</label>
              <input type="text" class="form-control" id="kategori_id" name="kategori_id" readonly value="{{ $dokumen->kategori->nama }}">
            </div>
            <div class="form-group">
              <label for="hash">Digital Signature</label>
              <div class="input-group col-xs-12">
                <input type="text" class="form-control @error('hash') is-invalid @enderror" id="hash" name="hash">
                <span class="input-group-append">
                  <button class="btn btn-primary" onclick="generateString(8)" type="button">Generate String</button>
                </span>
              </div>
              @error('hash')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <a href="/dokumen" class="btn btn-primary btn-sm mr-2"><span data-feather="arrow-left"></span>Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm mr-2">Tambah QR Code</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    function generateString(length) {
        let result = '';
        const charactersLength = characters.length;
        for ( let i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        const hash = document.getElementById('hash');
        hash.value = result;
    }
  </script>
@endsection
