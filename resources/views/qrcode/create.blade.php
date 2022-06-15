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
              <input type="text" class="form-control @error('hash') is-invalid @enderror" id="hash" name="hash">
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
    {{-- <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
         <div class="d-flex justify-content-between">
          <p class="card-title">QR Code</p>
          <a href="#" class="text-info">View all</a>
         </div>
         <img src="{{ asset('') }}img/qrcode.jpg">
          <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
          <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
          <canvas id="sales-chart"></canvas>
        </div>
      </div>
    </div> --}}
  </div>
  
@endsection
