@extends('layouts.app')

@section('content')
    
    <h1 class="wine-color">How to download?</h1>
    <h4 class="text-dark text-start mt-3">Some of our visitors complain that they are unable to download or unable to
        understand how to download books from our site.</h4>
            <x-adsense></x-adsense>

    <div>
        <p class="mt-4 h5 mb-3"><span class="text-danger fw-bold">Step 1:</span> After you visit the link of the book you want, scroll down to find the <span
                class="text-primary">Free Download Link</span> button and click on it. (see image below) </p>
        <div class="text-center"><img class="img-fluid" src="{{ asset('storage/1.jpg') }}" alt="find download link"></div>
    </div>
          <x-adsense></x-adsense>

    <div>
        <p class="mt-4 h5"><span class="text-danger fw-bold">Step 2:</span> You will see a count down timer on the top of the page. please wait for it to
            finish and the download link will appear automatically. (see image below).</p>
        <div class="text-center"><img class="img-fluid mt-4" src="{{ asset('storage/2.jpg') }}" alt="find download link"></div>
    </div>
  
@stop
