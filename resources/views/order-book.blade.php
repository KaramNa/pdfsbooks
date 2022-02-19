@extends('layouts.app')

@section('page_title', 'Free PDFs - Suggest a book for PDFSBOOKS.COM')
@section('page_description', 'You can suggest a book for us to add on pdfsbooks.com so you can have it for free')
@section('canonical_url', \Request::fullUrl())
@section('page_url', \Request::fullUrl())

@section('content')
    <x-adsense/>
    <div class="container my-100 suggestions">
        <x-kindle />
        <div class="text-center">
            <h1>Suggest a book for PDFSBOOKS.COM</h1>
            <h4>We are happy to help you finding the books you need, we'll do our best to find the book you suggest for us
                and we'll send you the <span style="color: var(--main-color);">Free link</span> by email as soon as
                possible.</h4>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" onclick="closeDiv(this)">X</button>
            </div>
        @elseif (session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('failed') }}
                <button type="button" class="btn-close" onclick="closeDiv(this)">X</button>
            </div>
        @endif
        <x-suggestion-form />
        <x-adsense />
        <x-newsletter />
    </div>

@stop
