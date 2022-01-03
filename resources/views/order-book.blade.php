@extends('layouts.app')

@section('content')
        {{-- <x-adsense></x-adsense> --}}

    <div class="text-center mt-5">
        <h1 class="wine-color">Order a book</h1>
        <h2>Suggest a book for PDFSBOOKS.COM</h2>
        <p class="mt-3">We are happy to help you finding the books you need, we'll do our best to find the book you order and we'll send the <span class="text-success">Free link</span> to your email as soon as possible.</p>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">{{ session("success") }}</div>
    @elseif (session()->has('failed'))
        <div class="alert alert-success mt-3">{{ session("success") }}</div>
    @endif
    <form action="{{ route('books.orders.store') }}" method="POST" class="mt-5 p-3 p-sm-5 border shadow-lg rounded">
        @csrf
        <div>
            <label for="book_name"><span class="text-danger">*</span> Book name</label>
            <input type="text" class="form-control" name="book_name" value="{{ old('book_name') }}">
            @error('book_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="book_url"><span class="text-danger">*</span> Book link(Amazon or other website)</label>
            <input type="text" class="form-control" name="book_url" value="{{ old('book_url') }}">
            @error('book_url')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="orderer_name"><span class="text-danger">*</span> Your name</label>
            <input type="text" class="form-control" name="orderer_name" value="{{ old('orderer_name') }}">
            @error('orderer_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="orderer_email"><span class="text-danger">*</span> Your Email</label>
            <input type="text" class="form-control" name="orderer_email" value="{{ old('orderer_email') }}">
            @error('orderer_email')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="book_name">Notes</label>
            <textarea name="notes" class="form-control rounded">{{ old('notes') }}</textarea>
        </div>
        <button class="btn btn-primary mt-3">Order now</button>
    </form>
        {{-- <x-adsense></x-adsense> --}}

@stop
