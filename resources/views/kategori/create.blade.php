@extends('dashboard.layouts.main')

@section('content')
<div class="col-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Form Tambah Kategori</h2>
        <form class="forms-sample" action="{{ route('kategori.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="nama">Nama Kategori</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Kategori" autofocus value="{{ old('nama') }}">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug" value="{{ old('slug') }}">
            @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>
          <a href="/kategori" class="btn btn-primary btn-sm mr-2"><span data-feather="arrow-left"></span>Kembali</a>
          <button type="submit" class="btn btn-primary btn-sm mr-2">Tambah Kategori</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    const nama = document.querySelector('#nama');
    const slug = document.querySelector('#slug');

    nama.addEventListener('change', function() {
        fetch('/kategori/checkSlug?nama=' + nama.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
  </script>
@endsection