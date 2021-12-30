<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("page_title", "PDFs Books - Free download books")</title>
    <meta name="description" content="Online Books library where you can find thousands of Free PDF,EPUB ebooks and download them for free, and if you can't find a Textbooks,Book you need you can order it on our website.">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:site_name" content="pdfsbooks.com">
    <meta property="og:title" content="@yield("book_title", "PDFsBOOks")">
    <meta property="og:description" content="Free download (PDF) @yield("book_desc")">
    <meta property="og:url" content="@yield("book_url", "https://pdfsbooks.com")">
    <meta name="thumbnail" content="@yield("share_image", asset('storage/thumbnail.jpg'))" >
    <meta property="og:image" content="@yield("share_image", asset('storage/thumbnail.jpg'))" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta property="og:type" content="website">
    <link rel="canonical" href="@yield("book_url", "https://pdfsbooks.com")">
    <link rel="alternate" type="application/rss+xml" title="pdfsbooks.com"
        href="https://feeds.feedburner.com/pdfsbooks">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset("storage/favicon.png") }}">
    <link rel="apple-touch-icon" sizes="100x100" href="{{ asset("storage/favicon.png") }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="{{ asset('css/style.css?v=').time() }}">
    <meta name="theme-color" content="#fff">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.5.1/dist/cdn.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-192921243-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-192921243-1');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KRY9G4D4WQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-PBFEB4TVQS');
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673"
     crossorigin="anonymous"></script>
</head>

<body>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId=4435731113156551&autoLogAppEvents=1" nonce="fwhpdSvT"></script>
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
                            <a class="nav-link" href="{{ route('ebooks.formats') }}">eBook Readers</a>
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('add.category') }}">Add Category</a></li>
                                    <li><a class="dropdown-item" href="{{ route('add.book') }}">Add a Book</a></li>
                                    <li><a class="dropdown-item" href="{{ route('books.orders') }}">Books Orders</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('drafted.books') }}">Drafted Books</a></li>
                                    <li><a class="dropdown-item" href="{{ route('reported.links') }}">Reported Links</a></li>

                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button id="logout" type="submit" rel="search" title="Search Books"
                                                class="border-0 bg-transparent dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown dropdown-notifications">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                       <span data-count="0" class="badge badge-danger ml-2 text-danger">{{ count(App\Models\Notification::get()->where("seen", 0)) }}</span>

                                    <i class="fas fa-bell"></i>
                                </a>
                                <ul class="dropdown-menu text-lowercase" aria-labelledby="navbarDropdown" style="width: 250px">
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
                    <form action="{{ route('home') }}" method="get" role="search" class="d-flex">
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input class="inp" name="search" autocomplete="off" placeholder="Search Books"
                            type="search" value="{{ request('search') }}" required><button aria-label="submit"
                            class="sbm" type="submit"><i class="fas fa-search"></i></button>
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
                <a href="https://www.facebook.com/FreeBooks" title="Follow us on Facebook" target="_blank"
                    rel="noreferrer">FOLLOW US ON FACEBOOK.COM
                </a>
            </div>
            <div class="col100">
                <div class="text-sm-end text-center"><small><b>pdfsbooks.com &copy; 2020-2021</b></small></div>
            </div>
        </div>
    </footer>
<script type="text/javascript">
    var adfly_id = 26088345;
    var adfly_advert = 'int';
    var popunder = true;
    var domains = [];
</script>
<script src="https://cdn.adf.ly/js/link-converter.js"></script> 

    
    <script src="{{ asset('js/app.js?v=').time()  }}"></script>
    
<script>
        $(document).ready(function() {
            $('.navbar-nav a.active').removeClass('active');
            $('.navbar-nav a[href="https://pdfsbooks.com' + location.pathname + '"]').addClass('active');
            if(location.pathname == "/")
            $(".navbar-nav a.home").addClass('active');
        });
    </script>

</body>

</html>
