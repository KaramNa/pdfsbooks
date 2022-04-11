@extends('layouts.app')

@section('book_url', \Request::fullUrl())
@section('canonical_url', \Request::fullUrl())

@if ($currentCategory)
    @section('page_title', 'PDFs Books - Free download ' . $currentCategory . ' books')
@endif

@section('content')
    @if (!request()->has('search') && !request()->has('category') && !request()->has('tag') && !request()->has('page') && !request()->has('language'))
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
                    <div class="social share-link">
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
                            </svg><span>Stay up to date with our activities, join us on:</span>
                        </h3>
                        <div>
                            <ul class="social">
                                <li>
                                    <a href="https://www.facebook.com/FreeBooks/" class="facebook" target="_blank"
                                        title="Facebook page link">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f"
                                            class="svg-inline--fa fa-facebook-f fa-w-10" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="30">
                                            <path fill="currentColor"
                                                d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://t.me/e_pdfsbooks" class="telegram" target="_blank"
                                        title="Telegram channel link">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fab"
                                            data-icon="telegram-plane" class="svg-inline--fa fa-telegram-plane fa-w-14"
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="35">
                                            <path fill="currentColor"
                                                d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/pdfsbooks_" class="twitter" target="_blank"
                                        title="Telegram channel link">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter"
                                            class="svg-inline--fa fa-twitter fa-w-16" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="35">
                                            <path fill="currentColor"
                                                d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/pdfsbooks_" class="instagram" target="_blank"
                                        title="Telegram channel link">
                                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img"
                                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 1536 1536" width="35">
                                            <path fill="currentColor"
                                                d="M1024 768q0-106-75-181t-181-75t-181 75t-75 181t75 181t181 75t181-75t75-181zm138 0q0 164-115 279t-279 115t-279-115t-115-279t115-279t279-115t279 115t115 279zm108-410q0 38-27 65t-65 27t-65-27t-27-65t27-65t65-27t65 27t27 65zM768 138q-7 0-76.5-.5t-105.5 0t-96.5 3t-103 10T315 169q-50 20-88 58t-58 88q-11 29-18.5 71.5t-10 103t-3 96.5t0 105.5t.5 76.5t-.5 76.5t0 105.5t3 96.5t10 103T169 1221q20 50 58 88t88 58q29 11 71.5 18.5t103 10t96.5 3t105.5 0t76.5-.5t76.5.5t105.5 0t96.5-3t103-10t71.5-18.5q50-20 88-58t58-88q11-29 18.5-71.5t10-103t3-96.5t0-105.5t-.5-76.5t.5-76.5t0-105.5t-3-96.5t-10-103T1367 315q-20-50-58-88t-88-58q-29-11-71.5-18.5t-103-10t-96.5-3t-105.5 0t-76.5.5zm768 630q0 229-5 317q-10 208-124 322t-322 124q-88 5-317 5t-317-5q-208-10-322-124T5 1085q-5-88-5-317t5-317q10-208 124-322T451 5q88-5 317-5t317 5q208 10 322 124t124 322q5 88 5 317z" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.pinterest.com/freepdfsbooks" class="pinterest" target="_blank"
                                        title="Telegram channel link">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="pinterest-p"
                                            class="svg-inline--fa fa-pinterest-p fa-w-12" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="35">
                                            <path fill="currentColor"
                                                d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="go-to-newsletter">
                            <a href="#mc_embed_signup" class="join-button newsletter-button">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="newspaper"
                                    class="svg-inline--fa fa-newspaper fa-w-18" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="30" height="30">
                                    <path fill="currentColor"
                                        d="M552 64H88c-13.255 0-24 10.745-24 24v8H24c-13.255 0-24 10.745-24 24v272c0 30.928 25.072 56 56 56h472c26.51 0 48-21.49 48-48V88c0-13.255-10.745-24-24-24zM56 400a8 8 0 0 1-8-8V144h16v248a8 8 0 0 1-8 8zm236-16H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm-208-96H140c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm208 0H348c-6.627 0-12-5.373-12-12v-8c0-6.627 5.373-12 12-12h152c6.627 0 12 5.373 12 12v8c0 6.627-5.373 12-12 12zm0-96H140c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h360c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12z">
                                    </path>
                                </svg>&nbsp;Subscribe to our Newsletter
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="#books" class="go-down">
                        <span>Scroll Down</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width='50'>
                            <g fill='#2196f3'>
                                <path
                                    d="M17.8 11.3c-.4 0-.7.1-.9.4l-4.3 4.6c-.5.5-1.4.5-1.9 0l-4.3-4.6c-.2-.3-.6-.4-.9-.4-1.1 0-1.7 1.3-.9 2.1l6.2 6.8c.5.6 1.4.6 1.9 0l6.2-6.8c.6-.8 0-2.1-1.1-2.1zM17.8 3.3c-.4 0-.7.1-.9.4l-4.3 4.6c-.5.5-1.4.5-1.9 0L6.5 3.7c-.3-.2-.6-.4-1-.4-1.1 0-1.7 1.3-.9 2.1l6.2 6.8c.5.6 1.4.6 1.9 0l6.2-6.8c.6-.8 0-2.1-1.1-2.1z">
                                </path>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <x-adsense />
    <div class="main-content" id="main-content">
        <div id="books" class="container books-filter">
            <div>
                <h2>Books Categories</h2>
                <x-categories :categories="$categories" :currentCategory="$currentCategory" />
            </div>
            <div>
                <h2>Books Tags</h2>
                <div id="tags" class="tags show-less">
                    @foreach ($tags as $tag)
                        @if ($tag->tag)
                            <a href="/?tag={{ $tag->tag }}&{{ http_build_query(request()->except(['tag', 'category', 'search', 'page'])) }}"
                                class="tag" title="{{ $tag->tag }} eBooks">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 442.688 442.688"
                                    style="enable-background:new 0 0 442.688 442.688;" xml:space="preserve" width="15">
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
                                </svg> {{ $tag->tag }}
                            </a>
                        @endif
                    @endforeach
                </div>
                <div>
                    <button onclick="showTags(this)" class="show-hide-tags-button">Show More</button>
                </div>
                <script>
                    function showTags(button) {
                        var tags = document.getElementById("tags");
                        if (button.innerText == "Show More") {
                            button.innerText = "Show Less";
                            tags.classList.remove('show-less');
                        } else if (button.innerText == "Show Less") {
                            button.innerText = "Show More";
                            tags.classList.add('show-less');

                        }
                    }
                </script>
            </div>
        </div>
        <div class="container">
            <div class="books">
                @if (count($books) > 0)
                    @foreach ($books as $book)
                        @if (in_array($loop->index, [3, 8]))
                            <x-kindle />
                        @endif
                        <div class="box">
                            @if ($book->draft == 0)
                                <div class='ribbon-wrapper-4'>
                                    <div class='ribbon-4'>Free</div>
                                </div>
                            @endif

                            <a href="{{ route('single.book', $book->slug) }}" title="Free Download {{ $book->title }}"
                                class="book-title">{{ $book->title }}</a>
                            <img data-src="{{ $book->title }}" src="{{ $book->poster }}" class="img"
                                alt="Free download PDF{{ $book->title }}" width="280" height="420"
                                onerror="this.src='/storage/no-cover.png';">
                            <div class="content">
                                <h5>Category: <a
                                        href="/?category={{ $book->category_slug }}&{{ http_build_query(request()->except(['category', 'tag', 'page'])) }}">{{ $book->category }}</a>
                                </h5>
                                <h5>Tag:
                                    <span class="tags">
                                        <a href="/?tag={{ $book->tag }}&{{ http_build_query(request()->except(['tag', 'category', 'search', 'page'])) }}"
                                            title="{{ $book->title }} eBooks">
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
                                <h5>Language: <a
                                        href="/?language={{ $book->language }}&{{ http_build_query(request()->except(['language', 'page'])) }}">{{ $book->language }}</a>
                                </h5>
                            </div>
                            <a href="{{ route('single.book', $book->slug) }}"
                                title="@if ($book->draft == 0) Free Download @endif {{ $book->title }}">
                                <div class="info">
                                    <span class="">
                                        @if ($book->draft == 0)
                                            Free Download
                                        @else
                                            Read More
                                        @endif
                                    </span>
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
    <x-adsense />
    <div class="container my-100">
        <x-newsletter />
    </div>
@stop
