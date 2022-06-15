@extends('dashboard.layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          {{-- <h3 class="font-weight-bold">Welcome {{ auth()->user()->nama }}</h3> --}}
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
</div>
@endsection
