@extends('dashboard.layouts.main')

@section('content')
<div class="container">
    <div class="row my-4">
        <div class="col-lg-8">
            <h3 class="mb-3">{{ $dokumen->judul }}</h3>
            
            <div>
                <a href="/dokumen" class="btn btn-info mb-3 btn-sm"><span data-feather="arrow-left"></span>Kembali</a>
                <a href="/qrcode/{{ $dokumen->slug }}/create" class="btn btn-info mb-3 btn-sm"><span data-feather="arrow-left"></span> Generate QR Code</a>
            </div>
            <div>
                <iframe src="{{ asset('storage/' . $dokumen->file) }}" width="600" height="400"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

