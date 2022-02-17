@extends('layouts.app')

@section('page_title', 'Free PDFs - How to download books')
@section('page_description', 'Learn how to download books for free from pdfsbooks.com')
@section('canonical_url', \Request::fullUrl())

@section('page_url', \Request::fullUrl())

@section('content')

    <div class="container my-100 how-to-download">
        <div class="mb-100">
            <h1 class="text-center">How to download?</h1>
            <h3>Some of our visitors complain that they are unable to download or unable to
                understand how to download books from our site.</h3>
            <h3>Please follow those two steps.</h3>
            <x-adsense />
            <div>
                <p><span class="text-red">Step 1:</span> After you visit the link of the book you want, scroll down to
                    find the <span>Free Download</span> button and click on it. (see image below) </p>
                <div class="text-center"><img src="{{ asset('storage/1.jpg') }}"
                        alt="find download link"></div>
            </div>
            <x-adsense />
            <div>
                <p><span class="text-red">Step 2:</span> You will see a count down timer on the top of the page. please
                    wait for it to
                    finish and the download link will appear automatically. (see image below).</p>
                <div class="text-center"><img src="{{ asset('storage/2.jpg') }}"
                        alt="find download link"></div>
            </div>
        </div>
        <x-adsense />

        <x-newsletter />
    </div>

@stop
