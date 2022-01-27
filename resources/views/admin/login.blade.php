@extends('layouts.app')

@section('content')

    <div class="row d-flex justify-content-center align-items-center h-100 shadow-lg border-raduis-12 p-3 mt-5">
        <h1 class="text-center text-primary mb-lg-0 mb-3 pt-3 fw-bold display-3">Login</h1>
        <div class="col-md-9 col-lg-6 col-xl-6 my-lg-5 py-lg-5">
            <img src="{{ asset('storage/thumbnail.jpg') }}" class="img-fluid border-raduis-12" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-5 offset-xl-1 my-lg-5 py-lg-5">
            <form action="{{ route('login') }}" method="post">
                @csrf
                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="text-dark">{{ session('failed') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="form-outline mb-4 mt-5 mt-lg-0">
                    <label class="form-label" for="username" style="margin-left: 0px;">Username</label>
                    <input type="text" id="username" name="name" class="form-control form-control-lg"
                        placeholder="Enter a valid email address">
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-outline mb-3">
                    <label class="form-label" for="password" style="margin-left: 0px;">Password</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg"
                        placeholder="Enter password">
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" value="" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                </div>

            </form>
        </div>
    </div>
@stop
