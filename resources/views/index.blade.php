@extends('layouts.app')

@section('book_url', \Request::fullUrl())
@section('canonical_url', \Request::fullUrl())

@if ($currentCategory)
    @section('page_title', 'PDFs Books - Free download ' . $currentCategory . ' books')
@endif

@section('content')
    <div class="landing">
        <div class="container">
            <div class="text">
                <h1>PDFsBooks, Free online ebooks Library</h1>
                <h2>Here you can find all the books you need for free, No registration, No download limits.</h2>
                <br>
                <x-blog />
            </div>
            <div class="share-section">
                <h3>Always remember that <span class="sharing-is-caring">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width='20'>
                            <g fill='#EB0000'>
                                <path d="M18,4c-4-1-6,3-6,3s-2-4-6-3s-4,6-2,8l8,8l8-8C22,10,22,5,18,4z"></path>
                            </g>
                        </svg>
                        <span class="bold">Sharing is Caring</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width='20'>
                            <g fill='#EB0000'>
                                <path d="M18,4c-4-1-6,3-6,3s-2-4-6-3s-4,6-2,8l8,8l8-8C22,10,22,5,18,4z"></path>
                            </g>
                        </svg>
                    </span></h3>
                <h3>Help others to get the books they need</h3>
                <div class="social-links">
                    {!! $shareComponent !!}
                </div>
                <div class="follow-section">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width='20'>
                            <g fill='#EB0000'>
                                <path
                                    d="M12 21c1.7 0 3-1.3 3-3H9c0 1.7 1.3 3 3 3zm7-6.6c-3.2-2.6 1-7.1-5-9.4 0-3-4-3-4 0-6 2.4-1.8 6.9-5 9.4-1 1-.3 2.6 1 2.6h12c1.3 0 2-1.6 1-2.6z">
                                </path>
                            </g>
                        </svg><span>Stay up to date with our activities</span>
                    </h3>
                    <div class="join-us">
                        <x-telegram />
                        <x-facebook />
                    </div>
                    <div class="go-to-newsletter">
                        <a href="#mc_embed_signup" class="join-button newsletter-button">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="newspaper"
                                class="svg-inline--fa fa-newspaper fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512" width="30" height="30">
                                <path fill="currentColor"
                                    d="M552 64H88c-13.255 0-24 10.745-24 24v8H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h472c26.51 0 48-21.49 48-48V88c0-13.255-10.745-24-24-24zM56 400a8 8 0 0 1-8-8V144h16v248a8 8 0 0 1-8 8zm236-16H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm-208-96H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm0-96H140c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h360c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12z">
                                </path>
                            </svg>&nbsp;Subscribe to our Newsletter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-adsense />
    <div class="main-content" id="main-content">
        <div class="container books-filter">
            <div>
                <h2>Books Categories</h2>
                <x-categories :categories="$categories" :currentCategory="$currentCategory" />
            </div>
            <div>
                <h2>Books Tags</h2>
                <div class="tags">
                    @foreach ($tags as $tag)
                        @if ($tag->tag)
                            <a href="/?tag={{ $tag->tag }}" class="tag">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 442.688 442.688"
                                    style="enable-background:new 0 0 442.688 442.688;" xml:space="preserve" width="15">
                                    <g>
                                        <g>
                                            <path d="M442.666,178.822l-4.004-145.078c-0.447-16.222-13.504-29.279-29.727-29.728l-145.08-4.004
                                            c-8.475-0.237-16.493,2.97-22.468,8.945L8.954,241.391c-11.924,11.924-11.924,31.325,0,43.249l149.083,149.082
                                            c11.951,11.953,31.296,11.956,43.25,0.001L433.721,201.29C439.636,195.374,442.897,187.184,442.666,178.822z M376.238,139.979
                                            c-20.323,20.322-53.215,20.324-73.539,0c-20.275-20.275-20.275-53.265,0-73.539c20.323-20.323,53.215-20.324,73.539,0
                                            C396.512,86.714,396.512,119.704,376.238,139.979z" />
                                        </g>
                                    </g>
                                </svg> {{ $tag->tag }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container">
            <div class="books">
                @if (count($books) > 0)
                    @foreach ($books as $book)
                    @if (in_array($loop->index, [1, 5, 6, 11, 12, 17]))
                            <div class="ads d-none mb-4" onclick="hideAds()">
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
                        <div class="box">
                            <a href="{{ route('single.book', $book->slug) }}" title="Free Download {{ $book->title }}"
                                class="book-title">{{ $book->title }}</a>
                            <img data-src="{{ $book->title }}" src="{{ $book->poster }}" class="img"
                                alt="Free download PDF{{ $book->title }}" width="280" height="420"
                                onerror="this.src='/storage/no-cover.png';">
                            <div class="content">
                                <h5>Category: <a href="/?category={{ $book->category_slug }}">{{ $book->category }}</a>
                                </h5>
                                <h5>Tag:
                                    <span class="tags">
                                        <a href="/?tag={{ $book->tag }}" class="tag">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 442.688 442.688"
                                                style="enable-background:new 0 0 442.688 442.688;" xml:space="preserve"
                                                width="15">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M442.666,178.822l-4.004-145.078c-0.447-16.222-13.504-29.279-29.727-29.728l-145.08-4.004
                                                                        c-8.475-0.237-16.493,2.97-22.468,8.945L8.954,241.391c-11.924,11.924-11.924,31.325,0,43.249l149.083,149.082
                                                                        c11.951,11.953,31.296,11.956,43.25,0.001L433.721,201.29C439.636,195.374,442.897,187.184,442.666,178.822z M376.238,139.979
                                                                        c-20.323,20.322-53.215,20.324-73.539,0c-20.275-20.275-20.275-53.265,0-73.539c20.323-20.323,53.215-20.324,73.539,0
                                                                        C396.512,86.714,396.512,119.704,376.238,139.979z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            {{ $book->tag }}
                                        </a>
                                    </span>
                                </h5>
                            </div>
                            <a href="{{ route('single.book', $book->slug) }}"
                                title="Free Download {{ $book->title }}">
                                <div class="info">
                                    <span class="">Free Download</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                            <g fill='#2196f3'>
                                                <path
                                                    d="M12 4c-.8.8-.8 2.1 0 2.8l3.2 3.2H4c-1.1 0-2 .9-2 2s.9 2 2 2h11.2L12 17.2c-.8.8-.8 2.1 0 2.8.8.8 2 .8 2.8 0l6.6-6.6c.4-.4.6-.9.6-1.4 0-.5-.2-1-.6-1.4L14.8 4c-.7-.8-2-.8-2.8 0z">
                                                </path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </a>

                        </div>

                    @endforeach
                @else
                    <div class="container no-results">
                        <p class="text-dark mt-3">Sorry, Nothing matches your criteria</p>
                        <p class="text-dark mt-2">Please suggest the book you want for us, and we'll add it on our website
                            ASAP</p>

                        <x-suggestion-form />
                    </div>
                @endif
            </div>
            {{ $books->withQueryString()->links() }}
        </div>
    </div>
    <div>
        <x-adsense />
    </div>
    <div class="container my-100">
        <x-newsletter />
    </div>
@stop
