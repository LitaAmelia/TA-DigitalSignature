@extends('dashboard.layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title mb-3">QR Code</p>

          {{-- @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
          @endif --}}

          <div class="table-responsive">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Judul Dokumen</th>
                  <th>Kategori Dokumen</th>
                  <th>QR Code</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($qrcodes as $qrcode)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="font-weight-bold">{{ $qrcode->dokumen->judul }}</td>
                  <td class="font-weight-bold">{{ $qrcode->dokumen->kategori->nama }}</td>
                  <td><img style="border-radius: 0%; width: 100px; height: 100px" src="{{ asset('storage' . $qrcode->image) }}"></td>
                  <td>
                    <a href="/cetak/{{ $qrcode->hash }}" class="btn btn-info btn-sm">Cetak</a>
                      <form action="/qrcode/{{ $qrcode->id }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger btn-sm qrcode-delete-confirm">Hapus</button>
                      </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection