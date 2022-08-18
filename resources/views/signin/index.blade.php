@extends('layouts.main')

@section('container')
    <h1 class="mb-3 mt-3 text-center">{{ $headerPage }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-5">

            @if (session()->has('regis_sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('regis_sukses') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin w-100 m-auto">
                <form method="post" action="{{ route('sign.auth') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('username') is-invalid @enderror " name="username"
                            id="username" placeholder="Username" required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
                </form>
                <small class="d-block text-center mt-5">
                    New account? <a href="/signup">Sign Up</a>
                </small>
            </main>
        </div>
    </div>
@endsection
