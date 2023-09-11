@extends('admin.auth.layouts.master')

@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
         <!-- Password Reset Token -->
         <input type="hidden" name="token" value="{{ $request->route('token') }}">
            {{-- EMAIL  --}}
            <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email',$request->email) }}" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
            <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password"id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="{{ route('admin.login') }}">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection
