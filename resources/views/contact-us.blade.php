@extends('layouts.app')

@section('page_title', 'Free PDFs - Contact us')
@section('page_description', 'Feel Free to contact us for any problem or any feedback')
@section('page_url', \Request::fullUrl())
@section('canonical_url', \Request::fullUrl())

@section('content')
    <x-adsense />
    <div class="container my-100">
        <x-kindle />
        <div>
            <h1 class="text-center">Contact Us</h1>
            <form action="{{ route('contact') }}" class="form" method="POST">
                @csrf
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" onclick="closeDiv(this)">X</button>
                    </div>
                @endif
                <div>
                    <label for="name"><span class="text-red">*</span> Your Name</label>
                    <input name="name" type="text" placeholder="Enter your name" class="form-control" required>
                </div>
                @error('name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
                <div>
                    <label for="email"><span class="text-red">*</span> Your email</label>
                    <input name="email" type="email" placeholder="Enter your email" class="form-control mt-3" required>
                </div>
                @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
                <div>
                    <label for="message"><span class="text-red">*</span> Your message</label>
                    <textarea name="message" class="form-control mt-3" placeholder="Enter your message" required></textarea>
                </div>
                @error('message')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror
                <button type="submit" class="btn btn-primary">Send email</button>
            </form>
        </div>
        <x-adsense />
        <x-newsletter />
    </div>

@stop
