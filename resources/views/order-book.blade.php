@extends('layouts.app')

@section('page_title', 'Free PDFs - Suggest a book for PDFSBOOKS.COM')
@section('page_description', 'You can suggest a book for us to add on pdfsbooks.com so you can have it for free')
@section('canonical_url', \Request::fullUrl())
@section('page_url', \Request::fullUrl())

@section('content')
        <x-adsense></x-adsense>

    <div class="text-center mt-5">
        <h1 class="wine-color">Suggest a book for PDFSBOOKS.COM</h1>
        <p class="mt-3">We are happy to help you finding the books you need, we'll do our best to find the book you suggest for us and we'll send the <span class="text-success">Free link</span> to you by email as soon as possible.</p>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">{{ session("success") }}</div>
    @elseif (session()->has('failed'))
        <div class="alert alert-success mt-3">{{ session("success") }}</div>
    @endif
    <form action="{{ route('books.orders.store') }}" method="POST" class="mt-5 p-3 p-sm-5 border shadow-lg border-raduis-12">
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
            <label for="book_url"><span class="text-danger">*</span> Please search Amazon or Goodreads for the book you need, then copy the link and paste it here so we know which book exactly you are looking for</label>
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
        <button class="btn btn-primary mt-3">Suggest</button>
    </form>
        <x-adsense></x-adsense>

@stop
