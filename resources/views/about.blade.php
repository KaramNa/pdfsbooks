@extends('layouts.app')

@section('page_title', 'About PDFsBOOKs.COM')
@section('page_description', 'Who we are and what we offer?!')
@section('canonical_url', \Request::fullUrl())

@section('page_url', \Request::fullUrl())

@section('content')
    <div class="container my-100 ebooks-readers about">
        <x-adsense />
        <div>
            <h1 class="text-center">About PDFsBOOKs.COM</h1>
            <h3>Who are we?</h3>
            <p>PDFsBOOKs.COM is an online ebooks library which contains links offer free download for thousands of eBooks and it doesn’t have any
                material hosted on the server of this server, only links to books that are taken from other sites on the web
                are published and these links are unrelated to our server.</p>
            <p> We’re sharing this with our audience ONLY for educational purpose and we highly encourage our visitors to
                purchase original licensed Books</p>
            <h3>Can I download books for free?</h3>
            <p>You can download ebooks on PDFsBOOKs.COM for free - without registration.</p>
            <h3>Where PDFsBOOKs.COM get books?</h3>
            <p>PDFsBOOKs.COM collects books from all resources available on the internet</p>
            <h3>Are books copyrighted?</h3>
            <p>All free books on PDFsBOOKs.COM are licensed under a Creative Commons license (CC BY, CC BY-NC, CC BY-NC-SA)
                or a GNU free documentation license (GNU FDL). These licenses allows you to share, copy, distribute and
                transmit the books.</p>
            <h3>Which is PDFsBOOKs.COM mission statement?</h3>
            <p>PDFsBOOKs.COM team are sure that books and education must be
                open, public and free.</p>
            <h3>I still have some questions.</h3>
            <p>You can <a href="{{ route('contact') }}">contact us.</a>
        </div>
    </div>
@stop
