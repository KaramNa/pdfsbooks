<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="manifest" href="/manifest.json">
    <meta name="yandex-verification" content="aac0de0adfffbbb7" />

    <title>@yield("page_title", "PDFs Books - Free Download PDF,EPUB e-Books No Registration")</title>
    <link rel="alternate" hreflang="en-us" href="@yield("page_url", "https://pdfsbooks.com" )" />
    <meta name="description" content="@yield("
        page_description", "pdfsbooks offers Free download PDF, EPUB, MOBI textbooks, articles, eBooks, All categories Medical, Computer science, IELTS, Programming, learning, mathmaticsm children's no limits, online library website search enging finder."
        )">

    <meta property="og:site_name" content="pdfsbooks.com">
    <meta property="og:title" content="@yield("book_title", "PDFsBOOks" )">
    <meta property="og:description" content="Free download (PDF) @yield("book_desc")">
    <meta property="og:url" content="@yield("book_url", "https://pdfsbooks.com" )">
    <meta property="og:image" content="@yield("share_image", asset('storage/thumbnail.jpg'))" />
    <meta property="og:type" content="website">

    <meta name="thumbnail" content="@yield("share_image", asset('storage/thumbnail.jpg'))">

    <link rel="canonical" href="@yield("canonical_url", "https://pdfsbooks.com" )">

    <link rel="alternate" type="application/rss+xml" title="pdfsbooks.com" href="https://pdfsbooks.com/feed">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('storage/favicon/favicon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/favicon/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/favicon/favicon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('storage/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="100x100" href="{{ asset('storage/favicon.png') }}">
    @yield('style')
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&#038;display=swap" rel="stylesheet" />
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pdfsbooks.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.5.1/dist/cdn.min.js"></script>
    <script src="{{ asset('js/pdfsbooks.js') }}"></script>

</head>

<body>
    <div class="header" id="header">
        <div class="container">
            <a href="{{ route('home') }}" title="pdfsbooks.com" rel="home" class="pdfsbooks logo"><img
                    src="{{ asset('storage/logo.png') }}" width="200" height="84" alt="pdfsbooks"></a>
            <span class="menu-button" id="nav-toggler" onclick="showMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="35" height="35">
                    <g fill='#0255CC'>
                        <path
                            d="M19 14H5c-1.1 0-2-.9-2-2s.9-2 2-2h14c1.1 0 2 .9 2 2s-.9 2-2 2zM19 7H5c-1.1 0-2-.9-2-2s.9-2 2-2h14c1.1 0 2 .9 2 2s-.9 2-2 2zM19 21H5c-1.1 0-2-.9-2-2s.9-2 2-2h14c1.1 0 2 .9 2 2s-.9 2-2 2z">
                        </path>
                    </g>
                </svg>
            </span>
            <x-search-form />
        </div>
        <div class="container">
            <ul class="main-nav" id="main-nav">
                <li>
                    <a aria-current="page" class="home" href="{{ route('home') }}">Home<span></span></a>
                </li>
                {{-- <li>
                    <a aria-current="page" href="https://blog.pdfsbooks.com" class="blog-link">Blog <x-new/></a>
                </li> --}}
                <li>
                    <a href="{{ route('order.book') }}">Suggest a book</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">Contact Us</a>
                </li>
                <li>
                    <a href="{{ route('how.to.download') }}">How to download!</a>
                </li>
                <li>
                    <a href="{{ route('ebooks.formats') }}">eBook Apps</a>
                </li>
                <li>
                    <a href="#">About</a>
                    <div class="mega-menu">
                        <ul class="links">
                            <li>
                                <a href="{{ route('about') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('privay.policy') }}">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="{{ route('dcma.show') }}">DCMA</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @auth
                    <li>
                        <a href="{{ route('admin.panel') }}">Admin</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
