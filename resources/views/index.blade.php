@extends('layouts.app')

@section('book_url', \Request::fullUrl())
@section('canonical_url', \Request::fullUrl())

@if ($currentCategory)
    @section('page_title', 'PDFs Books - Free download ' . $currentCategory . ' books')
@endif

@section('content')
    <div class="title">
        <h1 class="text-uppercase">PDFsBooks the best online ebooks Library</h1>
        <h2>Free download PDF books</h2>
        <div class="soc">
            {!! $shareComponent !!}
        </div>
        <x-telegram />
        <div class="fb-page mb-2" data-href="https://www.facebook.com/FreeBooks/" data-tabs="" data-width="" data-height=""
            data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
            <blockquote cite="https://www.facebook.com/FreeBooks/" class="fb-xfbml-parse-ignore"><a
                    href="https://www.facebook.com/FreeBooks/">E-Books</a></blockquote>
        </div>
        <div class="category mt-3">
            <div x-data="{ show: false }">
                <button class="py-2 px-5 rounded-pill small border-0 bg-dark text-white" @click="show = !show"
                    @click.away="show = false"><span
                        class="me-3">{{ isset($currentCategory) ? Str::headline($currentCategory) : 'Categories' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-width="20" height="20">
                        <g fill='#FFFFFF'>
                            <path
                                d="M18.2 7.6c-.4 0-.7.1-.9.4L13 12.6c-.5.5-1.4.5-1.9 0L6.8 8c-.3-.2-.6-.4-1-.4-1.1 0-1.7 1.3-.9 2.1l6.2 6.8c.5.6 1.4.6 1.9 0l6.2-6.8c.6-.8 0-2.1-1-2.1z">
                            </path>
                        </g>
                    </svg></button>

                <div x-show="show"
                    class="bg-dark text-white overflow-auto rounded py-3 text-left m-auto mt-2 position-absolute categories-list"
                    style="display: none">
                    <a href="{{ route('home') }}" class="d-block py-1 px-3 text-start">All Categories</a>


                    @foreach ($categories as $category)
                        <a href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category')) }}"
                            class="d-block py-1 px-3 text-start {{ isset($currentCategory) && $currentCategory === Str::lower($category->name) ? 'active' : '' }}">{{ Str::headline($category->name) }}</a>

                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <x-adsense></x-adsense>
    <div class="wrap index">
        <div class="col100">
            @if (count($books) > 0)
                <div class="grid">
                    @foreach ($books as $book)
                        @if ($loop->index % 6 == 0)
                            <div class="ads mb-3">
                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673"
                                                                crossorigin="anonymous"></script>
                                <ins class="adsbygoogle" style="display:block" data-ad-format="fluid"
                                    data-ad-layout-key="+1k+s6-1h-2r+au" data-ad-client="ca-pub-2052289648779673"
                                    data-ad-slot="1248211918"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </div>
                        @endif
                        <div class="item ribbonBox">
                            <span class="ribbon {{ strtolower($book->category_slug) }}">{{ $book->category }}</span>
                            <a href="{{ route('single.book', $book->slug) }}"
                                title="Free Download {{ $book->title }}"><img data-src="{{ $book->title }}"
                                    src="{{ $book->poster }}" class="img"
                                    alt="Free download PDF{{ $book->title }}" width="280" height="420"></a>
                            <div class="mt-3">
                                <a href="{{ route('single.book', $book->slug) }}"
                                    title="Free Download {{ $book->title }}"><span
                                        class="">{{ $book->title }}</span>
                                </a>
                            </div>
                            <div class="h">{{ $book->description }}</div>
                        </div>


                    @endforeach
                </div>
            @else
                <div class="shadow-lg p-3 border-raduis-12 my-5">
                    <h1 class="text-dark mt-3">Sorry, Nothing matches your criteria</h1>
                    <h1 class="text-dark mt-2">Please suggest the book you want for us, and we'll add it on our website ASAP
                        <a class="blink" href="{{ route('order.book') }}">Suggest a Book </a><svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="75" height="75">
                            <g fill='#800000'>
                                <path
                                    d="M12 3c-5 0-9 4-9 9s4 9 9 9 9-4 9-9-4-9-9-9zm3 5.5c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5-1.5-.7-1.5-1.5.7-1.5 1.5-1.5zm-6 0c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5-1.5-.7-1.5-1.5.7-1.5 1.5-1.5zm7.8 7C15.7 17 14 18 12 18s-3.7-1-4.8-2.5c-.5-.6 0-1.5.8-1.5.3 0 .6.1.8.4.7 1 1.9 1.6 3.2 1.6s2.5-.6 3.2-1.6c.2-.3.5-.4.8-.4.8 0 1.3.9.8 1.5z">
                                </path>
                            </g>
                        </svg>
                    </h1>
                </div>
            @endif

            {{ $books->withQueryString()->links() }}
        </div>

    </div>
    <div class="mt-5">
        @if (session()->has('subscribed_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="text-dark">{{ session('subscribed_success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @error('bad_email')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="text-dark">{{ $message }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @error('email_address')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="text-dark">{{ $message }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            <x-newsletter></x-newsletter>
            <x-adsense></x-adsense>

        </div>
    @stop
