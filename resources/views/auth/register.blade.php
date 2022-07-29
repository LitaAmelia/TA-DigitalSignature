@extends('auth.layouts.main')

@section('content')
<div class="row w-100 mx-0">
    <div class="col-lg-4 mx-auto">
      <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
          <img src="{{ asset('') }}assets/images/logo.svg" alt="logo">
        </div>
        <h2 class="font-weight-light">Form Register</h2>
        <form class="pt-3" action="/register" method="post">
            @csrf
          <div class="form-group">
            <input type="text" name="nama" class="form-control form-control-lg @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Lengkap" required value="{{ old('nama') }}">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>
          <div class="form-group">
            <input type="number" name="npm" class="form-control form-control-lg @error('npm') is-invalid @enderror" id="npm" placeholder="NIP/NIK/NPM" required value="{{ old('npm') }}">
            @error('npm')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>
          <div class="form-group">
            <input type="text" name="username" class="form-control form-control-lg @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" placeholder="Email" required value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
          </div>
          <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">REGISTER</button>
          </div>
          <div class="text-center mt-4 font-weight-light">
            Already have an account? <a href="/login" class="text-primary">Login</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection