@extends('dashboard.layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title mb-3">Kelola Dokumen</p>

          {{-- @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
          @endif --}}
          <div class="table-responsive">
            <a href="/dokumen/create" class="btn btn-primary btn-sm mt-3">Tambah Dokumen</a>
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Judul Dokumen</th>
                  <th>Kategori</th>
                  <th>Aksi</th>
                </tr>  
              </thead>
              <tbody>
                @foreach ($dokumens as $dokumen)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="font-weight-bold">{{ $dokumen->judul }}</td>
                  <td>{{ $dokumen->kategori->nama }}</td>
                  <td>
                    <a href="/qrcode/{{ $dokumen->slug }}/create" class="btn btn-info btn-sm">Generate QR Code</a>
                    <a href="/dokumen/{{ $dokumen->slug }}" class="btn btn-success btn-sm">Detail</a>
                    <a href="/dokumen/{{ $dokumen->slug }}/edit" class="btn btn-warning btn-sm">Edit</a>
                      <form action="/dokumen/{{ $dokumen->slug }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger btn-sm dokumen-delete-confirm" data-name="{{ $dokumen->judul }}" type="submit">Hapus</button>
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