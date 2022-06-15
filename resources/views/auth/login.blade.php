@extends('auth.layouts.main')

@section('content')
<div class="row w-100 mx-0">
  
<div class="col-lg-4 mx-auto">
  <div class="auth-form-light text-left py-5 px-4 px-sm-5">
    @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          {{-- <button type="button"  data-bs-dismiss="alert" aria-label="Close"></button> --}}
      </div>
   @endif

  @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError') }}
          {{-- <button type="button"  data-bs-dismiss="alert" aria-label="Close"></button> --}}
      </div>
  @endif
    <div class="brand-logo">
      <img src="{{ asset('') }}assets/images/logo.svg" alt="logo">
    </div>
    <h2 class="font-weight-light">Form Login</h2>
    <form class="pt-3" action="/login" method="post">
      @csrf
      <div class="form-group">
        <input type="text" name="username" class="form-control form-control-lg @error('username') is-invalid @enderror" id="username" placeholder="Username" autofocus value="{{ old('username') }}">
        @error('username')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control @error('username') is-invalid @enderror form-control-lg" id="password" placeholder="Password">
        @error('password')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mt-3">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
      </div>
      <div class="text-center mt-4 font-weight-light">
        Don't have an account? <a href="/register" class="text-primary">Create</a>
      </div>
    </form>
  </div>
</div>
</div>
@endsection