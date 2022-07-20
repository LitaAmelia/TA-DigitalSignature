@extends('dashboard.layouts.main')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Form Edit Dokumen</h2>
        <form method="post" action="/dokumen/{{ $dokumen->slug }}" class="forms-sample" enctype="multipart/form-data">
          @method('put')
          @csrf
          <div class="mb-3">
                <label for="judul" class="form-label">Judul Dokumen</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" autofocus value="{{ old('judul', $dokumen->judul) }}">
                @error('judul')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                  <label for="slug" class="form-label">Slug</label>
                  <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $dokumen->slug) }}">
                  @error('slug')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="kategori_id" class="form-label">Kategori</label>
                  <select class="form-control" name="kategori_id">
                      @foreach ($kategoris as $kategori)
                          @if(old('kategori_id', $dokumen->kategori_id) == $kategori->id) 
                              <option value="{{ $kategori->id }}" selected>{{ $kategori->nama }}</option>
                          @else
                              <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                          @endif
                      @endforeach
                  </select>
              </div>
              <div class="mb-3">
                  <label for="file" class="form-label">Dokumen</label>
                  <input type="hidden" name="oldFile" value="{{ $dokumen->file }}"/>
                  @if($dokumen->file)
                    <iframe src="{{ asset('storage/' .  $dokumen->file) }}" class="file-preview" width="300"></iframe>
                  @else
                    <iframe class="file-preview"></iframe>
                  @endif
                  <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file" onchange="previewFile()">
                  @error('file')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <a href="/dashboard" class="btn btn-primary btn-sm mr-2"><span data-feather="arrow-left"></span>Kembali</a>
              <button type="submit" class="btn btn-primary btn-sm mr-2">Update Data</button>
          {{-- <button class="btn btn-light">Cancel</button> --}}
        </form>
      </div>
    </div>
  </div>

  <script>
    const judul = document.querySelector('#judul');
    const slug = document.querySelector('#slug');

    judul.addEventListener('change', function() {
        fetch('/document/makeSlug?judul=' + judul.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    function previewFile() {
            const file = dokumen.querySelector('#file');
            const filePreview = dokumen.querySelector('.file-preview');

            filePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsdataURL(file.files[0]);

            oFReader.onload - function(oFREvent) {
                filePreview.src = oFREvent.target.result;
            }
    }
  </script>
@endsection