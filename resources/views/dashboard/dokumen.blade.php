@extends('dashboard.layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Welcome {{ auth()->user()->nama }}</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card card-dark-blue-bg">
        <div class="card-people mt-auto">
          <img src="{{ asset('') }}assets/images/dashboard/coba.svg" alt="people">
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin transparent">
      <div class="row">
        @foreach ($categories as $category)
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-tale">
            <div class="card-body">
              <p class="mb-4">{{ $category->nama }}</p>
              <p class="fs-30 mb-2">{{ $category->dokumens_count }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card position-relative">
        <div class="card-body">
            <form action="{{ route('home.store') }}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="mb-3">              
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
                <label for="file" class="form-label">Dokumen</label>
                <div class="needsclick dropzone" id="document-dropzone"></div>
            </div>
            <div>
              <button type="submit" class="btn btn-primary btn-sm mr-2">Tambah Dokumen</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body" id="dokumen_show">
          <p class="card-title mb-0">Top Dokumen</p>
          <div class="table-responsive">
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
                  <td class="font-weight-bold">{{ $dokumen->kategori->nama }}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary btn-sm">Aksi</button>
                      <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                        <a class="dropdown-item" href="/qrcode/{{ $dokumen->slug }}/create">Generate QR Code</a>
                        <a class="dropdown-item" href="/dokumen/{{ $dokumen->slug }}">Detail</a>
                        <a class="dropdown-item" href="/dokumen/{{ $dokumen->slug }}/edit">Edit</a>
                        <form action="/dokumen/{{ $dokumen->slug }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="dropdown-item dokumen-delete-confirm" data-name="" type="submit">Hapus</button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>    
</div>
@endsection

@section('myscript')
  <script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
       url: '{{ route('home.storeMedia') }}',
       maxFilesize: 50, // MB
       addRemoveLinks: true,
       acceptedFiles: ".pdf",
       headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
       },
       success: function(file, response) {
        console.log(response.original_name);
        console.log(response.nama_string);
        var no = 1;
          $('form').append('<input type="hidden" name="dokumen[]" value="' + response.original_name + '">' + `<input type="hidden" name="nama_file_[]" value="` + response.nama_string + '">' )
          $('form').append()
       },
       removedfile: function(file) {
          file.previewElement.remove()
          var name = ''
          if (typeof file.file_name !== 'undefined') {
             name = file.file_name
          } else {
             name = uploadedDocumentMap[file.name]
          }
          $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
       }
    }
 </script>
@endsection

