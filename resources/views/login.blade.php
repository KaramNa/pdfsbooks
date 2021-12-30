@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-6">
                <form action="{{ route('login') }}" method="post" class="rounded border border-dark p-5 mt-5 shadow-lg">
                    @csrf
                    <h2>Login</h2>
                    @if (session('failed'))
                        <div class="bg-wine text-white text-center rounded mt-2 py-2">
                            <div>
                                {{ session('failed') }}
                            </div>
                        </div>
                    @endif
                    <input type="text" class="form-control mt-3" name="name" placeholder="name">
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="password" class="form-control mt-3" name="password" placeholder="Password">
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn text-white bg-wine mt-3">Login</button>
                </form>

            </div>
        </div>
    </div>
@stop
