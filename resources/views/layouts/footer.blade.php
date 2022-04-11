<div class="footer">
    <div class="container">
        <div class="box information">
            <h3>PDFsBOOKs</h3>
            <ul class="social">
                <li>
                    <a href="https://www.facebook.com/FreeBooks/" class="facebook" target="_blank"
                        title="Facebook page link">
                        <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f"
                            class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 320 512" width="25">
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
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="30">
                            <path fill="currentColor"
                                d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z">
                            </path>
                        </svg>
                    </a>
                </li>
            </ul>
            <p class="text">
                PDFsBOOKs Online eBooks library offers free download PDF, EPUB and MOBI ebooks for education purpose
                only.
            </p>
            <p class="text">
                PDFsBOOKs has also a Blog which contains Articles to explain how to pass exams and the books you need to
                success, and more useful topics
            </p>
        </div>
        <div></div>
        <div class="box">
            <ul class="links">
                <li>
                    <x-double-right-arrows /><a href="https://blog.pdfsbooks.com">Blog</a>
                </li>
                <li>
                    <x-double-right-arrows /><a href="{{ route('order.book') }}">Suggest a book</a>
                </li>
                <li>
                    <x-double-right-arrows /><a href="{{ route('ebooks.formats') }}">eBooks App</a>
                </li>
                <li>
                    <x-double-right-arrows /><a href="{{ route('how.to.download') }}">How to Download</a>
                </li>
                <li>
                    <x-double-right-arrows /><a href="{{ route('about') }}">About Us</a>
                </li>
                <li>
                    <x-double-right-arrows /><a href="{{ route('dcma.show') }}">DCMA</a>
                </li>
                <li>
                    <x-double-right-arrows /><a href="{{ route('privay.policy') }}">Privay Policy</a>
                </li>
                <li>
                    <x-double-right-arrows /><a href="{{ route('contact') }}">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
    <p class="copyright">Made With <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width='20'>
            <g fill='#EB0000'>
                <path d="M18,4c-4-1-6,3-6,3s-2-4-6-3s-4,6-2,8l8,8l8-8C22,10,22,5,18,4z"></path>
            </g>
        </svg> By PDFsBooks Team<br>All rights reserved PDFsBOOKs &copy; 2022</p>
</div>
{{-- 

<script>
    try {
        var url = "https://pdfsbooks.com" + location.pathname;
        document.querySelector('a[href=' + CSS.escape(url) + ']').classList.add(
            'active');
    } catch {}
    if (window.location.href.indexOf("free") > -1)
        var home = document.getElementsByClassName("free_books")[0].classList.add("active");
    else if (location.pathname == "/")
        var home = document.getElementsByClassName("home")[0].classList.add("active");
</script>

<script>
    var nowDate = new Date();
    var date = nowDate.getDate() + '/' + (nowDate.getMonth() + 1) + '/' + nowDate.getFullYear();


    function hideAds() {
        localStorage.setItem("date", date);
        window.location.reload();
    }

    function loadScript() {
        var newScript = document.createElement("script");
        newScript.type = "text/javascript";
        newScript.setAttribute("defer", "true");
        newScript.setAttribute("src",
            "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673");
        newScript.setAttribute("crossorigin", "anonymous");

        document.documentElement.firstChild.appendChild(newScript);
    }
    var prevDate = localStorage.getItem("date");
    if (!prevDate || prevDate != date) {
        var ads = Array.prototype.slice.call(document.getElementsByClassName('ads'))
        ads.forEach(ad => {
            ad.classList.remove("d-none");
            loadScript();
        });
    }
</script>

<!-- Default Statcounter code for Pdf http://Https://pdfsbooks.com -->
<!-- Default Statcounter code for pdf https://pdfsbooks.com -->
<script type="text/javascript">
    var sc_project = 12736308;
    var sc_invisible = 1;
    var sc_security = "d35d4988";
</script>
<script type="text/javascript" src="https://www.statcounter.com/counter/counter.js" async></script>
<noscript>
    <div class="statcounter"><a title="Web Analytics Made Easy -
Statcounter" href="https://statcounter.com/" target="_blank"><img class="statcounter"
                src="https://c.statcounter.com/12736308/0/d35d4988/1/" alt="Web Analytics Made Easy - Statcounter"
                referrerPolicy="no-referrer-when-downgrade"></a></div>
</noscript>
<!-- End of Statcounter Code -->
<!-- End of Statcounter Code -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script defer src="https://www.googletagmanager.com/gtag/js?id=UA-214406203-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-214406203-1 ');
</script>
<!-- Google Analytics end   -->
{{-- <div class="ads d-none" onclick="hideAds()">
    <script defer src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673"
        crossorigin="anonymous"></script>
</div> --}} --}}
</body>

</html>
