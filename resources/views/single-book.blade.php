@extends('layouts.app')

@section('page_url', \Request::fullUrl())
@php
if ($book->draft == 0) {
    $book_title = 'Free Download ' . $book->title;
} else {
    $book_title = $book->title;
}
@endphp
@section('page_title', "$book_title")
@section('page_description', "$book->description")
@section('canonical_url', \Request::fullUrl())

@section('share_image', "$book->poster")
@section('book_url', request()->url())
@section('book_desc', substr($book->description, 0, strpos($book->description, '.')))
@section('book_title', "$book_title")

@section('content')
    <div itemscope itemtype="https://schema.org/Book" itemid="https://pdfsbooks.com/book/{{ $book->slug }}"
        class="container my-100 single-book">
        <div class="wrap">
            <div>
                <h1 itemprop="name">{{ $book->title }}</h1>
                <p>{{ $book->qoute }}</p>
                <h2 itemprop="author" itemtype="https://schema.org/Person">Authors: {{ $book->author }}</h2>
                @auth
                    <div class="edit-button">
                        <div>
                            <a href="{{ route('edit.book', $book) }}" class=""><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                    <g fill='#FFFFFF'>
                                        <path d="M2 17l-2 7 7-2zM3 16L16 3l5 5L8 21zM22 7l1-1c2-2-3-7-5-5l-1 1 5 5z"></path>
                                    </g>
                                </svg> Edit</a>
                        </div>
                    </div>
                    <div x-data="{ show: false }">
                        <div>
                            <button type="button" class="delete-button" @click="show = true">Delete</button>
                        </div>
                        <div x-show="show" style="display: none">
                            <form action="{{ route('delete.book', $book) }}" method="post">
                                @csrf
                                <label>Delete this book?</label>
                                <button type="submit" name="delete_book" class="button text-red">Yes</button>
                                <button type="button" class="button text-green" @click="show = false">No</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        <div class="wrap content">
            <div class="left-section">
                <div>
                    @if ($book->draft == 0)
                        <div class='ribbon-wrapper-4'>
                            <div class='ribbon-4'>Free</div>
                        </div>
                    @endif
                    <img itemprop="image" data-src="{{ $book->title }}" src="{{ $book->poster }}" class="img"
                        alt="Free download PDF{{ $book->title }}" width="280" height="420"
                        onerror="this.src='/storage/no-cover.png';">
                </div>
                <div class="share-section">
                    <h3><span class="sharing-is-caring">
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
                    </div>
                </div>

                <x-amazon-audioBook />
            </div>

            <div class="right-section">
                <div>
                    <a href="#description" id="a_description" onclick="return tab('description')" class="btn-menu active"
                        title="Book Description">
                        <span>Description</span>
                    </a>
                    <a href="#details" id="a_details" onclick="return tab('details')" class="btn-menu"
                        title="Book Details">
                        <span>Details</span>
                    </a>
                </div>
                <div class="details form">
                    <a id="description"></a>
                    <div id="t_description" class="tab active">
                        {!! stripslashes($book->description) !!}
                    </div>
                    <a id="details"></a>
                    <div id="t_details" class="tab">
                        <div>
                            <span class="info1">Category: </span>
                            <span itemprop="about"><a href="/?category={{ $book->category_slug }}"
                                    title="{{ $book->category }} Books">{{ $book->category }}</a></span>
                        </div>
                        @if ($book->tag)
                            <div>
                                <span class="info1">Tag: </span>
                                <span itemprop="about"><a href="/?tag={{ $book->tag }}"
                                        title="{{ $book->title }} Books">{{ $book->tag }}</a></span>
                            </div>
                        @endif
                        <div>
                            <span class="info1">Publisher: </span>
                            <span itemprop="publisher">{{ $book->publisher }}</span>
                        </div>
                        <div>
                            <span class="info1">Published: </span>
                            <span itemprop="datePublished" content="{{ $book->published }}"><a
                                    href="/?published={{ $book->published }}"
                                    title="published in {{ $book->published }}">{{ $book->published }}</a></span>
                        </div>
                        <div>
                            <span class="info1">Pages: </span>
                            <span itemprop="numberOfPages">{{ $book->pages }}</span>
                        </div>
                        <div>
                            <span class="info1">Language: </span>
                            <span itemprop="inLanguage" content="en"><a href="/?language={{ $book->language }}"
                                    title="language in {{ $book->language }}">{{ $book->language }}</a></span>
                        </div>
                        @if ($book->PDF_size)
                            <div>
                                <span class="info1">PDF Size: </span>
                                <span>{{ $book->PDF_size }}</span>
                            </div>
                        @endif
                    </div>
                    <script>
                        function tab(a) {
                            a = a.replace("#", "");
                            if (!['description', 'details'].includes(a)) {
                                return false;
                            }
                            var menuElements = document.getElementsByClassName('btn-menu');
                            for (var i = 0; i < menuElements.length; i++) {
                                menuElements[i].classList.remove('active');
                                var id = menuElements[i].getAttribute('id');
                                id = id.replace("a_", "t_");
                                document.getElementById(id).classList.remove('active');
                            }
                            document.getElementById("a_" + a).classList.add('active');
                            document.getElementById("t_" + a).classList.add('active');
                            return false;
                        }
                        if (window.location.hash) {
                            tab(window.location.hash);
                        }
                    </script>
                </div>
                <x-adsense></x-adsense>
                <h2>Related Books</h3>
                    <div class="related-books">
                        @foreach ($relatedBooks as $relatedBook)
                            <div>
                                @if ($relatedBook->draft == 0)
                                    <div class='ribbon-wrapper-4'>
                                        <div class='ribbon-4'>Free</div>
                                    </div>
                                @endif
                                <a href="{{ route('single.book', $relatedBook->slug) }}"
                                    title="{{ $relatedBook->title }}">
                                    <img data-src="{{ $relatedBook->title }}" src="{{ $relatedBook->poster }}"
                                        class="img" alt="Free download PDF{{ $relatedBook->title }}"
                                        width="280" height="420" onerror="this.src='/storage/no-cover.png';">
                                </a>
                                <a href="{{ route('single.book', $relatedBook->slug) }}"
                                    title="{{ $relatedBook->title }}"
                                    class="book-title">{{ $relatedBook->title }}</a>
                            </div>
                        @endforeach
                    </div>
                    <x-adsense />
                    <x-related-post :book='$book' />
                    @if (($book->download_link || $book->download_link2 || $book->download_link3) && $book->paid_download_link)
                        <div class="disclaimer form">
                            <strong>Disclaimer:</strong><br>
                            <strong>This site complies with DMCA Digital Copyright Laws.</strong> Please bear in mind
                            that
                            we do
                            not
                            own
                            copyrights to
                            this book. We are not hosting any copyrighted contents on our servers, it’s a catalog of
                            links
                            that
                            already found on the internet. <br><strong>pdfsbooks.com</strong> doesn’t have any material
                            hosted
                            on
                            the
                            server of this
                            page, only links to books that are taken from other sites on the web are published and these
                            links
                            are
                            unrelated to the book server.<br> Moreover <strong>pdfsbooks.com</strong> server does not
                            store
                            any
                            type
                            of
                            book, guide,
                            software, or images. No illegal copies are made or any copyright © and / or copyright is
                            damaged
                            or
                            infringed since all material is free on the internet. If you feel that we have
                            violated your copyrights, and you want us to remove this Book, please contact us. immediately.
                            <br>We’re
                            sharing this with our
                            audience
                            ONLY
                            for
                            educational purpose and we highly encourage our visitors to purchase original licensed
                            Books.<br>
                            <span class="text-red">
                                Please don't use the free download link unless you can't afford this book and you need
                                it for your education,
                                otherwise please support the authors and buy this book form the paid link.
                            </span>
                        </div>
                        <x-adsense></x-adsense>
                    @endif
                    <div class="download-buttons">
                        @if ($book->download_link || $book->download_link2 || $book->download_link3)
                            <div class="download-button">
                                <a href="{{ route('get.the.link', $book->slug) }}">Free Download
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width='30'>
                                        <g fill='#FFFFFF'>
                                            <path
                                                d="M11 5.8c0 .4.1.7.4.9L16 11c.5.5.5 1.4 0 1.9l-4.6 4.3c-.3.2-.4.6-.4.9 0 1.1 1.3 1.7 2.1.9l6.8-6.2c.6-.5.6-1.4 0-1.9l-6.8-6.2c-.8-.5-2.1.1-2.1 1.1zM3 5.8c0 .4.1.7.4.9L8 11.1c.5.5.5 1.4 0 1.9l-4.6 4.3c-.3.2-.4.5-.4.9 0 1.1 1.3 1.7 2.1.9l6.8-6.2c.6-.5.6-1.4 0-1.9L5.1 4.9c-.8-.7-2.1-.1-2.1.9z">
                                            </path>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        @endif
                        @if ($book->paid_download_link)
                            <div class="download-button amazon">
                                <a href="{{ $book->paid_download_link }}" target="_blank"
                                    title="Amazon {{ $book->title }}">Paid Download
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width='30'>
                                        <g fill='#FFFFFF'>
                                            <path
                                                d="M11 5.8c0 .4.1.7.4.9L16 11c.5.5.5 1.4 0 1.9l-4.6 4.3c-.3.2-.4.6-.4.9 0 1.1 1.3 1.7 2.1.9l6.8-6.2c.6-.5.6-1.4 0-1.9l-6.8-6.2c-.8-.5-2.1.1-2.1 1.1zM3 5.8c0 .4.1.7.4.9L8 11.1c.5.5.5 1.4 0 1.9l-4.6 4.3c-.3.2-.4.5-.4.9 0 1.1 1.3 1.7 2.1.9l6.8-6.2c.6-.5.6-1.4 0-1.9L5.1 4.9c-.8-.7-2.1-.1-2.1.9z">
                                            </path>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="form">
                        <p>
                            If you have any troubles while downloading, Please visit <a class="text-decoration-underline"
                                href="{{ route('how.to.download') }}">How to
                                download</a> page.
                        </p>
                        <p>Please visit <a class="text-decoration-underline" href="{{ route('ebooks.formats') }}">eBook
                                Readers</a> page to know about ebooks formats and programs you need to open them.</p>
                        <p class="text-red">PLEASE NOTE THAT ALL BOOKS YOU DOWNLOAD FROM THIS WEBSITE ARE IN "PDF"
                            OR
                            "EPUB" OR "MOBI" FORMAT DON'T DOWNLOAD
                            ANYTHING LIKE "EXE" OR "APK" OR ANY OTHER FORMAT</p>
                    </div>
                    <x-kindle />
                    <div>
                        <x-newsletter />
                    </div>
                    <x-adsense />

                    <section>
                        <form action="{{ route('comment') }}" method="Post" class="form">
                            @csrf
                            <input type="hidden" name="dd" value="{{ $book->id }}">
                            <h4>Leave a reply</h4>
                            <p>Your email address will not be published.</p>
                            <div>
                                <label for="comment"><span class="text-red">*</span> Comment</label>
                                <textarea id="comment" name="comment" class="form-control">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div class="erorr">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="name"><span class="text-red">*</span> Name</label>
                                <input id="name" type="text" name="name" class="form-control"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="erorr">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="email"><span class="text-red">*</span> Email</label>
                                <input id="email" type="text" name="email" class="form-control"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="erorr">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label for="avatar">Choose your avatar</label>
                                <input type="hidden" id="avatar" name="avatar" value="/storage/avatars/avatar1.svg">
                                <div class="avatars">
                                    @foreach ($avatars as $avatar)
                                        <img src="/storage/avatars/{{ $avatar }}" alt="user avatar for comments"
                                            width="100" height="100"
                                            class="avatar {{ $avatar == 'avatar1.svg' ? 'selected' : '' }}"
                                            onclick="selectAvatar(this)" />
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-primary">Post comment</button>
                        </form>
                        <script>
                            function selectAvatar(element) {
                                document.getElementsByClassName('selected')[0].classList.remove('selected');
                                element.classList.add('selected');
                                document.getElementById("avatar").value = element.getAttribute('src');
                            }
                        </script>
                        @foreach ($book->comments as $comment)
                            <article class="comment-section form">
                                <div class="flex">
                                    <div>
                                        <img src="{{ $comment->avatar }}" alt="user avatar" width="70" height="70">
                                    </div>
                                    <div>
                                        <div>
                                            <h5 class="comment-user">{{ ucwords($comment->name) }}
                                                </h4>
                                                <p class="comment-time">
                                                    Posted
                                                    <time>{{ $comment->created_at->diffForHumans(null, true) . ' ago' }}</time>
                                                </p>
                                        </div>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                                @auth
                                    <div>
                                        <div x-data="{ show: false }">
                                            <div>
                                                <button type="button" class="button" @click="show = true"><svg
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30"
                                                        height="30">
                                                        <g fill='#2196f3'>
                                                            <path
                                                                d="M16 5s-1-2-4-2-4 2-4 2H5l.4 2h13.3l.3-2h-3zM9.4 5S10 4 12 4s2.6 1 2.6 1H9.4zM8 21h8l2.4-13H5.6z">
                                                            </path>
                                                        </g>
                                                    </svg></button>
                                            </div>
                                            <div x-show="show" style="display: none">
                                                <form action="{{ route('delete.comment', $comment->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="button text-red">Yes</button>
                                                    <button type="button" class="button text-green"
                                                        @click="show = false">No</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endauth
                            </article>
                        @endforeach
                    </section>
            </div>
        </div>
        <script id="mcjs">
            ! function(c, h, i, m, p) {
                m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m,
                    p)
            }(document, "script",
                "https://chimpstatic.com/mcjs-connected/js/users/6504840845cc7babf43e5e51c/df32158795c8b46b17fe1b9e3.js");
        </script>
    @stop
