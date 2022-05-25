@extends('layouts.main')
@section('container')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
            <form action="/login" method="post">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">User Name / Email</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="email" placeholder="Masukkan username" required value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password" required value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
              <button class="w-10 btn btn-lg btn-primary mt-3" type="submit">Login</button>
            </form>
          </main>
    </div>
</div>
@endsection