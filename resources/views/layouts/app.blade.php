<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("page_title", "PDFs Books - Free download books")</title>
    <meta name="description"
        content="Online Books library where you can find thousands of Free PDF,EPUB ebooks and download them for free, and if you can't find a Textbooks,Book you need you can order it on our website.">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:site_name" content="pdfsbooks.com">
    <meta property="og:title" content="@yield(" book_title", "PDFsBOOks" )">
    <meta property="og:description" content="Free download (PDF) @yield(" book_desc")">
    <meta property="og:url" content="@yield(" book_url", "https://pdfsbooks.com" )">
    <meta name="thumbnail" content="@yield(" share_image", asset('storage/thumbnail.jpg'))">
    <meta property="og:image" content="@yield(" share_image", asset('storage/thumbnail.jpg'))" />
    <meta name="yandex-verification" content="aac0de0adfffbbb7" />
    <link rel="alternate" hreflang="en-us" href="https://pdfsbooks.com" />
    <meta property="og:type" content="website">
    <link rel="canonical" href="@yield(" book_url", "https://pdfsbooks.com" )">
    <link rel="alternate" type="application/rss+xml" title="pdfsbooks.com" href="https://pdfsbooks.com/feed">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('storage/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="100x100" href="{{ asset('storage/favicon.png') }}">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="{{ asset('css/style.css?v=2') }}">
    <meta name="theme-color" content="#fff">
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.5.1/dist/cdn.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KRY9G4D4WQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-PBFEB4TVQS');
    </script>
    <!-- test  -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=UA-214406203-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-214406203-1 ');
    </script>
    <!-- end test  -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673"
        crossorigin="anonymous"></script>

</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId=4435731113156551&autoLogAppEvents=1"
        nonce="fwhpdSvT"></script>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a href="{{ route('home') }}" title="pdfsbooks.com" rel="home" class="logo me-5"><img
                        src="{{ asset('images/logo.png') }}" width="200" alt="pdfsbooks"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase">
                        <li class="nav-item">
                            <a class="nav-link home" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.book') }}">Order a book</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('how.to.download') }}">How to download!</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ebooks.formats') }}">eBook Apps</a>
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('add.category') }}">Add Category</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('add.book') }}">Add a Book</a></li>
                                    <li><a class="dropdown-item" href="{{ route('books.orders') }}">Books Orders</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('drafted.books') }}">Drafted Books</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('reported.links') }}">Reported Links</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('search.results') }}">Search Results</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button id="logout" type="submit" rel="logout" title="logout"
                                                class="border-0 bg-transparent dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown dropdown-notifications">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span data-count="0"
                                        class="badge badge-danger ml-2 text-danger">{{ count(App\Models\Notification::get()->where('seen', 0)) }}</span>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30px"
                                        hieght="30px   ">
                                        <g fill='#FFFFFF'>
                                            <path
                                                d="M12 21c1.7 0 3-1.3 3-3H9c0 1.7 1.3 3 3 3zm7-6.6c-3.2-2.6 1-7.1-5-9.4 0-3-4-3-4 0-6 2.4-1.8 6.9-5 9.4-1 1-.3 2.6 1 2.6h12c1.3 0 2-1.6 1-2.6z">
                                            </path>
                                        </g>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu text-lowercase" aria-labelledby="navbarDropdown"
                                    style="width: 300px">
                                    @foreach (App\Models\Notification::latest()->get() as $notif)
                                        <li class="p-2 notif-hover"><a href="{{ route('notif.seen', $notif->id) }}"
                                                class="text-dark">
                                                <div class="d-flex justify-content-between">
                                                    <div>{{ $notif->username }}
                                                        @if ($notif->notif_type == 'comment')
                                                            left a comment
                                                        @elseif ($notif->notif_type == 'order')
                                                            ordered a book
                                                        @else
                                                            reported a link
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('delete.notif', $notif->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="bg-transparent border-0">X</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div><span
                                                        class="text-xs">{{ $notif->created_at->diffForHumans() }}</span>
                                                    <span
                                                        class="text-xs text-primary">{{ $notif->seen == 1 ? 'seen' : 'unseen' }}</span>
                                                </div>
                                            </a></li>
                                        <hr class="m-0">
                                    @endforeach
                                </ul>
                            </li>
                        @endauth
                    </ul>
                    <form action="{{ route('home') }}" method="get" role="search">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <div>
                            <div class="ms-2">
                                <input id="exact_search" type="checkbox" name="exact_search"
                                    {{ request('exact_search') == 'on' ? 'checked' : '' }}>
                                <label for="exact_search" class="text-white">Exact Search</label>
                            </div>
                            <div class="d-flex">
                                <input class="inp" name="search1" autocomplete="off"
                                    placeholder="Search By Title or Author" type="search"
                                    value="{{ request('search1') }}" required><button aria-label="submit"
                                    class="sbm" type="submit"><svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <g fill='#FFFFFF'>
                                            <path
                                                d="M22.1 20.1l-4.8-4.8C18.4 13.8 19 12 19 10c0-5-4-9-9-9s-9 4-9 9 4 9 9 9c2 0 3.8-.6 5.3-1.7l4.8 4.8c.6.6 1.4.6 2 0 .5-.6.5-1.5 0-2zM10 16.5c-3.6 0-6.5-2.9-6.5-6.5S6.4 3.5 10 3.5s6.5 2.9 6.5 6.5-2.9 6.5-6.5 6.5z">
                                            </path>
                                        </g>
                                    </svg></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <script>
        function nav(a) {
            if (a) {
                document.getElementById("menu").classList.add('active');
                document.getElementById("overlay").style.display = "block";
            } else {
                document.getElementById("menu").classList.remove('active');
                document.getElementById("overlay").style.display = "none";
            }
        }
    </script>
    <main>
        <div class="main">
            @yield("content")
        </div>
    </main>
    <footer>
        <div class="main wrap">
            <div class="col100">
                <div class="text-sm-end text-center"><small><b>pdfsbooks.com &copy; 2020-2021</b></small></div>
            </div>
        </div>
    </footer>

    <script>
        try {
            var url = "pdfsbooks.com" + location.pathname;
            document.querySelector('a[href=' + CSS.escape(url) + ']').classList.add(
                'active');
        } catch {}
        if (location.pathname == "/")
            var home = document.getElementsByClassName("home")[0].classList.add("active");
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script>
        var nowDate = new Date();
        var date = nowDate.getDate() + '/' + (nowDate.getMonth() + 1) + '/' + nowDate.getFullYear();

        jQuery(function($) {
            $('.ads').on('click', function() {
                localStorage.setItem("date", date);
                window.location.reload();
            });
        });

        $(document).ready(function() {
            var prevDate = localStorage.getItem("date");
            if (!prevDate || prevDate != date) {
                $('.ads').show();
            } else {}
        });
    </script>

    <!-- Default Statcounter code for Pdfsbooks https://pdfsbooks.com/ -->
    <script type="text/javascript">
        var sc_project = 12696715;
        var sc_invisible = 1;
        var sc_security = "addf9e34";
    </script>
    <script type="text/javascript" src="https://www.statcounter.com/counter/counter.js" async></script>
    <noscript>
        <div class="statcounter"><a title="Web Analytics Made Easy -
Statcounter" href="https://statcounter.com/" target="_blank"><img class="statcounter"
                    src="https://c.statcounter.com/12696715/0/addf9e34/1/" alt="Web Analytics Made Easy - Statcounter"
                    referrerPolicy="no-referrer-when-downgrade"></a></div>
    </noscript>
    <!-- End of Statcounter Code -->

</body>

</html>
