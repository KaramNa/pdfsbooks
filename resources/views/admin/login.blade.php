@extends('layouts.app')

@section('content')

    <div class="container form login">
        <h1>Login</h1>
        <div>
            <form action="{{ route('login') }}" method="post">
                @csrf
                @if (session('failed'))
                    <div class="alert alert-danger">
                        <span class="text-dark">{{ session('failed') }}</span>
                    </div>
                @endif
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="name" class="form-control"
                        placeholder="Enter username">
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Enter password">
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <div>
                        <input type="checkbox" value="" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            Remember me
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

            </form>
        </div>
    </div>
@stop
