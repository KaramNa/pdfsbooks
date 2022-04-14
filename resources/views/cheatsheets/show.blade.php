@extends('layouts.app')

@section('page_title', 'Free - ' . $cheatsheet->title)
@if ($cheatsheet->subtitle)
    @section('page_description', $cheatsheet->subtitle)
@else
    @section('page_description', 'Free - ' . $cheatsheet->title))
@endif
@section('canonical_url', \Request::fullUrl())

@section('page_url', \Request::fullUrl())
@section('style')
    <link href="{{ asset('css/cheatsheet.css?v=1') }}" rel="stylesheet">
@stop
@section('content')
    <div class=" cheatsheet container">
        <x-adsense />

        <h1 class="title">{{ $cheatsheet->title }}</h1>
        <h2 class="subtitle">{{ $cheatsheet->subtitle }}</h2>
        <p class="subject"><strong>Subject:</strong> {{ $cheatsheet->subject }}</p>
        <p class="tag"><strong>tag:</strong> {{ $cheatsheet->tag }}</p>
        <p class="date"><strong>Created at:</strong> {{ $cheatsheet->created_at->format('d m Y') }} @if ($cheatsheet->updated_at)
                <strong>updated at:</strong> {{ $cheatsheet->updated_at->format('d m Y') }}
            @endif
        </p>
        <p class="downloads"><strong>downloads:</strong> {{ $cheatsheet->downloads }}</p>
        <p class="pages"><strong>Pages:</strong> {{ $cheatsheet->pages }}</p>

        <a class="download-button" href="/storage/cheatsheets/{{ $cheatsheet->download_link }}" download>download</a>
        <button class="download-button" type="button" onclick="view()">View</button>
        <div id="view" class="hidden">
            <embed class="view-pdf" src="/storage/cheatsheets/{{ $cheatsheet->download_link }}"
                type="application/pdf" width="100%" height="800px" />
        </div>
        <x-adsense />
    </div>

    <script>
        function view(){
            document.getElementById("view").classList.remove('hidden'); 
        }
    </script>
@stop
