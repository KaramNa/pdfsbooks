@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.min.js') }}"></script>

@endsection

@section('content')
    <div class="container my-100 get-the-link">
        <div class="text-center">
            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" onclick="closeDiv(this)">X</button>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" onclick="closeDiv(this)">X</button>
                </div>
            @endif
            @error('email')
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" onclick="closeDiv(this)">X</button>
                </div>
            @enderror
            <div id="preparing_file"></div>
            <div class="follow-section">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width='20'>
                        <g fill='#EB0000'>
                            <path
                                d="M12 21c1.7 0 3-1.3 3-3H9c0 1.7 1.3 3 3 3zm7-6.6c-3.2-2.6 1-7.1-5-9.4 0-3-4-3-4 0-6 2.4-1.8 6.9-5 9.4-1 1-.3 2.6 1 2.6h12c1.3 0 2-1.6 1-2.6z">
                            </path>
                        </g>
                    </svg><span>Join us on:</span>
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
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="telegram-plane"
                                    class="svg-inline--fa fa-telegram-plane fa-w-14" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="35">
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
                                    class="svg-inline--fa fa-twitter fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512" width="35">
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
            </div>
            <x-related-post :book="$book" />
            <x-kindle />
            <x-adsense />

            <div id="link" class="d-none">
                <div>
                    <div>
                        @if ($d_link)
                            <div class="form">
                                <a href="<?php echo $d_link; ?>" target="_blank"><span class="arrow">&gt;&gt;</span>
                                    Free download
                                    link 1 <span class="arrow">&lt;&lt;</span></a>
                                <p><img src="{{ asset('storage\kaspersky.png') }}" alt="kaspersky icon" width="120"
                                        height="30"> Checked by Kaspersky. No virus detected</p>
                            </div>
                        @endif
                        @if ($d_link2)
                            <div class="form">
                                <a href="<?php echo $d_link2; ?>" target="_blank"><span class="arrow">&gt;&gt; </span>
                                    Free download
                                    link 2 <span class="arrow"> &lt;&lt;</span></a>
                                <p><img src="{{ asset('storage\kaspersky.png') }}" alt="kaspersky icon" width="120"
                                        height="30"> Checked by Kaspersky. No virus detected</p>
                            </div>
                        @endif
                    </div>
                </div>
                <p class="report">Report the download link if there is any problem, click <button type="button"
                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal">Here</button> to
                    report</p>
            </div>
            @if ($relatedBooks)
                <h2>You maybe like these</h2>
                <div class="related-books">
                    @foreach ($relatedBooks as $relatedBook)
                        <div class="book">
                            @if ($relatedBook->draft == 0)
                                <div class='ribbon-wrapper-4'>
                                    <div class='ribbon-4'>Free</div>
                                </div>
                            @endif
                            <a href="{{ route('single.book', $relatedBook->slug) }}" title="{{ $relatedBook->title }}">
                                <img data-src="{{ $relatedBook->title }}" src="{{ $relatedBook->poster }}"
                                    class="img" alt="Free download PDF{{ $relatedBook->title }}" width="280"
                                    height="420" onerror="this.src='/storage/no-cover.png';">
                            </a>
                            <a href="{{ route('single.book', $relatedBook->slug) }}" title="{{ $relatedBook->title }}"
                                class="book-title">{{ $relatedBook->title }}</a>
                        </div>
                    @endforeach
                </div>
            @endif

            <x-adsense />

        </div>
    </div>
    <script>
        var count = 10;
        // var c = parseFloat("{{ $book_size }}");
        // switch (true) {
        //     case c <= 5:
        //         count = 10;
        //         break;
        //     case (c > 5) && (c <= 10):
        //         count = 15;
        //         break;
        //     case (c > 10) && (c <= 15):
        //         count = 20;
        //         break;
        //     case (c > 15) && (c <= 20):
        //         count = 25;
        //         break;
        //     case c > 20:
        //         count = 30;
        //         break;
        //     default:
        //         count = 15;
        //         break;
        // }
        //this process could take from <span class="text-red">10</span> to <span class="text-red">30</span> secondes depending on the file size 
        window.onload = function() {
            var ad = document.querySelector("ins.adsbygoogle");
            if (ad && ad.innerHTML.replace(/\s/g, "").length == 0) {
                document.getElementById('preparing_file').innerHTML =
                    "<div class='adblock-alter'>Ads Help us to keep this service up and free, please disable your ad blocker to get the free download link, Thanks for your understanding</div>";
            } else {
                document.getElementById('preparing_file').innerHTML =
                    'Please wait while preparing the download link and checking for viruses <span id="countDown">' +
                    count + '</span>';
                var timer = setInterval(function() {
                    count--;
                    document.getElementById('countDown').innerHTML = count;
                    if (count == 0) {
                        document.getElementById("countDown").innerHTML =
                            "<span class='scroll-down'>Scroll Down</span>";
                        document.getElementById('link').classList.remove('d-none');
                        clearInterval(timer);
                    }
                }, 1000);
            }
        };
    </script>

    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <form action="{{ route('report.the.link', $slug) }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Report a link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="email" class="h6">Enter your email if you would like to get the link
                                when we fix it</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="report_message" class="h6">Write a report message (optional)(300
                                charecters maximum)</label>
                            <textarea name="report_message" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Report</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
