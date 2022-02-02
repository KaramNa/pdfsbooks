<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="manifest" href="/manifest.json">
    <meta name="yandex-verification" content="aac0de0adfffbbb7" />

    <title>@yield("page_title", "PDFs Books - Free Download PDF,EPUB e-Books No Registration")</title>
    <link rel="alternate" hreflang="en-us" href="@yield("page_url", "https://pdfsbooks.com")" />
    <meta name="description"
        content="@yield("page_description", "pdfsbooks offers Free download PDF, EPUB, MOBI textbooks, articles, eBooks, All categories Medical, Computer science, IELTS, Programming, learning, mathmaticsm children's no limits, online library website search enging finder.")">

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
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css?v=9') }}">

    <script defer src="https://unpkg.com/alpinejs@3.5.1/dist/cdn.min.js"></script>
</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId=4435731113156551&autoLogAppEvents=1"
        nonce="fwhpdSvT"></script>
    <header class="pt-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark pt-0">
            <div class="container-fluid">
                <a href="{{ route('home') }}" title="pdfsbooks.com" rel="home" class="logo me-5 pt-3"><img
                        src="{{ asset('storage/logo-white.png') }}" width="200" height="84" alt="pdfsbooks"></a>
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
                            <a class="nav-link" href="{{ route('order.book') }}">Suggest a book</a>
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.panel') }}">Admin</a>
                            </li>
                        @endauth
                    </ul>
                    <x-search-form color="white" />
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

    <script src="{{ asset('js/app.min.js') }}"></script>

    <script>
        try {
            var url = "pdfsbooks.com" + location.pathname;
            document.querySelector('a[href=' + CSS.escape(url) + ']').classList.add(
                'active');
        } catch {}
        if (location.pathname == "/")
            var home = document.getElementsByClassName("home")[0].classList.add("active");
    </script>

    <script>
        var nowDate = new Date();
        var date = nowDate.getDate() + '/' + (nowDate.getMonth() + 1) + '/' + nowDate.getFullYear();


        function hideAds() {
            localStorage.setItem("date", date);
            window.location.reload();
        }

        var prevDate = localStorage.getItem("date");
        if (!prevDate || prevDate != date) {
            var ads = Array.prototype.slice.call(document.getElementsByClassName('ads'))
            ads.forEach(ad => {
                ad.classList.remove("d-none");
            });
        } else {}
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

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-214406203-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-214406203-1 ');
    </script>
    <!-- Google Analytics end   -->
    <script defer src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673"
        crossorigin="anonymous"></script>
</body>

</html>
