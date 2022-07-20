@extends('dashboard.layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Form Tambah Dokumen</h2>
        <form method="post" action="{{ route('dokumen.store') }}" class="forms-sample" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
                <label for="judul" class="form-label">Judul Dokumen</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" autofocus value="{{ old('judul') }}">
                @error('judul')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                  <label for="slug" class="form-label">Slug</label>
                  <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                  @error('slug')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select class="form-control js-example-basic-single w-100" name="kategori_id">
                    @foreach ($kategoris as $kategori)
                        @if(old('kategori_id') == $kategori->id)
                            <option value="{{ $kategori->id }}" selected>{{ $kategori->nama }}</option>
                        @else
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endif
                    @endforeach
                </select>
              </div>
              <div class="mb-3">
                  <label for="file" class="form-label">Dokumen</label>
                  <img class="mb-3 col-sm-5">
                  <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file">
                  @error('file')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <a href="/dashboard" class="btn btn-primary btn-sm mr-2"><span data-feather="arrow-left"></span>Kembali</a>
              <button type="submit" class="btn btn-primary btn-sm mr-2">Tambah Dokumen</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    const judul = document.querySelector('#judul');
    const slug = document.querySelector('#slug');

    judul.addEventListener('change', function() {
        fetch('/dokumen/checkSlug?judul=' + judul.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
  </script>
@endsection