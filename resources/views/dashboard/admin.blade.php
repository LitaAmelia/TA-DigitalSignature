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
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <h3 class="mb-4">Total User</h3>
              <p class="fs-30 mb-2">{{ $users }}</p>
              {{-- <p>10.00% (30 days)</p> --}}
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue">
            <div class="card-body">
              <h3 class="mb-4">Total Kategori</h3>
              <p class="fs-30 mb-2">{{ $categories }}</p>
              {{-- <p>22.00% (30 days)</p> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>    
  {{-- <h2>Selamat datang di Halaman Admin</h2> --}}
</div>
@endsection
