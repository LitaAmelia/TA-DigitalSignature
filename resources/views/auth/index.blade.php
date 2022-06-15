@extends('dashboard.layouts.main');

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title mb-3">Kelola Users</p>
          <div class="table-responsive">
            <table class="table table-striped table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>NPM</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>  
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="font-weight-bold">{{ $user->nama }}</td>
                  <td>{{ $user->npm }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->is_active == 1 ? 'Aktif' : 'Nonaktif' }}</td>
                  <td>
                      <form action="{{ route('user.action', $user->id) }}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="is_accept" value="1">
                        <button type="submit" class="btn btn-success btn-sm show-alert-aktif-box" @if ($user->is_active == 1) disabled @endif data-name="{{ $user->nama }}">Aktif</button>
                      </form>
                      <form action="{{ route('user.action', $user->id) }}" method="post" class="d-inline">
                          @csrf
                          <input type="hidden" name="is_accept" value="0">
                          <button class="btn btn-danger btn-sm show-alert-nonaktif-box" @if ($user->is_active == 0) disabled @endif data-name="{{ $user->nama }}">Nonaktif</button>
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