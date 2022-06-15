@extends('dashboard.layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title mb-3">Kelola Kategori</p>

          {{-- @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
          @endif --}}

          <div class="table-responsive">
            {{-- <a href="/category/create" class="btn btn-primary btn-sm mt-3">Tambah Kategori</a> --}}
            <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm mt-3">Tambah Kategori</a>
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kategoris as $kategori)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="font-weight-bold">{{ $kategori->nama }}</td>
                  <td>
                      <a href="/kategori/{{ $kategori->slug }}/edit" class="btn btn-warning btn-sm">Edit</a>
                      <form action="/kategori/{{ $kategori->slug }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger btn-sm kategori-delete-confirm" data-name="{{ $kategori->nama }}" type="submit">Hapus</button>
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