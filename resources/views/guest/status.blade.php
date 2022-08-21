@extends('guest.main')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="row mt-5">
    <div class="col-10 col-sm-8 col-md-8 col-lg-4 mx-auto position-relative">

      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if(session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <div class="row rounded p-4 login-page" style="background-color:#FFFFFF">
        <p class="text-center fs-3 mt-4">Cek Status Draft</p>
        <form action="/searchstatus" method="post">
          @csrf
          <div class="mt-4 form-input">
            <i class="fa-solid fa-envelope icon"></i>
            <input type="email" class="form-control input @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="emailHelp" placeholder="Email" value="{{ old('email') }}" autofocus>
          </div>
          <div>
            @error('email')
            <div class="text-danger">
              <small>{{ $message }}</small>
            </div>
            @enderror
          </div>

          <div class="text-center mt-5">
            <button class="btn btn-warning rounded-pill text-white fw-bold px-4" type="submit">sign in</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection