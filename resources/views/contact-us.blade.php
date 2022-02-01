@extends('layouts.app')

@section('page_title', 'Free PDFs - Contact us')
@section('page_description', 'Feel Free to contact us for any problem or any feedback')
@section('page_url', \Request::fullUrl())
@section('canonical_url', \Request::fullUrl())

@section('content')
    <x-adsense></x-adsense>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="wine-color">Contact Us</h1>
                <form action="{{ route('contact') }}" class="mt-3 p-3 p-sm-5 shadow-lg border-raduis-12" method="POST">
                    @csrf
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                        </div>
                    @endif
                    <input name="name" type="text" placeholder="Enter your name" class="form-control">
                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <input name="email" type="email" placeholder="Enter your email" class="form-control mt-3">
                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <textarea name="message" class="form-control mt-3" placeholder="Enter your message"></textarea>
                    @error('message')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-dark text-white mt-3">Send email</button>
                </form>
            </div>
        </div>
    </div>
    <x-adsense></x-adsense>

@stop
