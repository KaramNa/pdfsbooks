@extends('layouts.app')

@section('share_image', "$book->poster")
@section('book_url', request()->url())
@section('book_desc', "$book->title")
@section('page_title', "$book->title")
@section('book_title', "$book->title")

@section('content')
    <div class="wrap">
        <div class="col100">
            <h1 class="wine-color">{{ $book->title }}</h1>
            <h2 class="mt-3">{{ $book->qoute }}</h2>
            <p><b>{{ $book->author }}</b></p>
            <p class="label-color h4">Scroll down until you find <span class="wine-color blink fw-bold">&gt;&gt;</span> "Free
                Download Link" <span class="wine-color blink fw-bold">&lt;&lt;</span></p>
        </div>
        <div class="col300 action">
            @auth
                <div>
                    @if ($book->draft)
                        <form action="{{ route('publish', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-down mt-3 text-start"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="25" height="25">
                                    <g fill='#FFFFFF'>
                                        <path
                                            d="M5 11c.8.8 2.1.8 2.8 0L10 8.8V17c0 1.1.9 2 2 2s2-.9 2-2V8.8l2.2 2.1c.8.8 2.1.8 2.8 0 .8-.8.8-2 0-2.8l-5.6-5.6C13 2.2 12.5 2 12 2c-.5 0-1 .2-1.4.6L5 8.1c-.8.8-.8 2.1 0 2.9zM21 16c-.5 0-1 .5-1 1v3H4v-3c0-.5-.5-1-1-1s-1 .5-1 1v4c0 .5.5 1 1 1h18c.5 0 1-.5 1-1v-4c0-.5-.5-1-1-1z">
                                        </path>
                                    </g>
                                </svg> Publish</button>
                        </form>
                    @else
                        <form action="{{ route('draft', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-down mt-3 text-start"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="25" height="25">
                                    <g fill='#FFFFFF'>
                                        <path
                                            d="M13 13V4h2c.6 0 1-.4 1-1V2c0-.6-.4-1-1-1H9c-.6 0-1 .4-1 1v1c0 .6.4 1 1 1h2v9H6v4l6 6 6-6v-4h-5zM9.5 3c-.3 0-.5-.2-.5-.5s.2-.5.5-.5h5c.3 0 .5.2.5.5s-.2.5-.5.5h-5z">
                                        </path>
                                    </g>
                                </svg>Draft</button>
                        </form>
                    @endif
                </div>
                <div>
                    <a href="{{ route('edit.book', $book) }}" class="btn-down mt-3 text-start"><svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                            <g fill='#FFFFFF'>
                                <path d="M2 17l-2 7 7-2zM3 16L16 3l5 5L8 21zM22 7l1-1c2-2-3-7-5-5l-1 1 5 5z"></path>
                            </g>
                        </svg> Edit</a>
                </div>
                <div x-data="{ show: false}">
                    <div>
                        <button type="button" class="btn-down mt-3 text-start" @click="show = true"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30">
                                <g fill='#FFFFFF'>
                                    <path
                                        d="M16 5s-1-2-4-2-4 2-4 2H5l.4 2h13.3l.3-2h-3zM9.4 5S10 4 12 4s2.6 1 2.6 1H9.4zM8 21h8l2.4-13H5.6z">
                                    </path>
                                </g>
                            </svg> Delete</button>
                    </div>
                    <div x-show="show" style="display:none">
                        <p class="mb-0 mt-3">Do You really want to delete this book?!</p>
                        <form action="{{ route('delete.book', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger mt-3 text-start">Yes</button>
                            <button type="button" class="btn btn-primary mt-3 text-start" @click="show = false">No</button>
                        </form>
                    </div>
                </div>
            @endauth

        </div>
    </div>
    <div class="wrap mt30">
        <div class="col300 center"> <img src="{{ $book->poster }}" alt="Remote Sensing of Plant Biodiversity"
                class="img" width="277.5" height="417.167">
            <div class="soc">
                {!! $shareComponent !!}
            </div>
            <div class="fb-page mb-2" data-href="https://www.facebook.com/FreeBooks/" data-tabs="" data-width=""
                data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                data-show-facepile="false">
                <blockquote cite="https://www.facebook.com/FreeBooks/" class="fb-xfbml-parse-ignore"><a
                        href="https://www.facebook.com/FreeBooks/">E-Books</a></blockquote>
            </div>

        </div>
        <div class="col100 txt mt-4 mt-sm-0 position-relative">
            <a href="#description" id="a_description" onclick="return tab('description')" class="btn-menu active"
                title="Book Description">
                <span class="mobi1">Description</span>
                <span class="mobi2"></span>
            </a>
            <a href="#details" id="a_details" onclick="return tab('details')" class="btn-menu" title="Book Details">
                <span class="mobi1">Details</span>
                <span class="mobi2"></span>
            </a>
            <div class="tabin">
                <a id="description"></a>
                <div id="t_description" class="tab active">
                    {{ $book->description }}
                </div> <a id="details"></a>
                <div id="t_details" class="tab">
                    <h3>Book Details</h3>
                    <div>
                        <span class="info1">Category: </span>
                        <span class="info2">{{ $book->category }}</span>
                    </div>
                    <div>
                        <span class="info1">Publisher: </span>
                        <span class="info2">{{ $book->publisher }}</span>
                    </div>
                    <div>
                        <span class="info1">Published: </span>
                        <span class="info2">{{ $book->published }}</span>
                    </div>
                    <div>
                        <span class="info1">Pages: </span>
                        <span class="info2">{{ $book->pages }}</span>
                    </div>
                    <div>
                        <span class="info1">Language: </span>
                        <span class="info2">{{ $book->language }}</span>
                    </div>
                    <div>
                        <span class="info1">PDF Size: </span>
                        <span class="info2">{{ $book->PDF_size }}</span>
                    </div>
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

            <h3 class="text-dark">Related Books</h3>
            <div class="grid m">
                @foreach ($relatedBooks as $relatedBook)
                    <div class="item"><a href="{{ route('single.book', $relatedBook->slug) }}"
                            title="{{ $relatedBook->title }}"><img data-src="{{ $relatedBook->poster }}"
                                src="{{ $relatedBook->poster }}" class="img"
                                alt="{{ $relatedBook->title }}" width="277.5" height="417.167"></a>
                        <div class="pad"><a href="{{ route('single.book', $relatedBook->slug) }}"
                                title="{{ $relatedBook->title }}">{{ $relatedBook->title }}</a></div>
                        <div class="h">{{ $relatedBook->description }}</div>
                    </div>
                @endforeach
            </div>
            <x-adsense></x-adsense>
            <div class="mb-5">
                <strong>Disclaimer:</strong><br>
                <strong>This site complies with DMCA Digital Copyright Laws.</strong> Please bear in mind that we do not own
                copyrights to
                this book/software. We are not hosting any copyrighted contents on our servers, it’s a catalog of links that
                already found on the internet. <br><strong>pdfsbooks.com</strong> doesn’t have any material hosted on the
                server of this
                page, only links to books that are taken from other sites on the web are published and these links are
                unrelated to the book server.<br> Moreover <strong>pdfsbooks.com</strong> server does not store any type of
                book, guide,
                software, or images. No illegal copies are made or any copyright © and / or copyright is damaged or
                infringed since all material is free on the internet. If you feel that we have
                violated your copyrights, then please contact us immediately. <br>We’re sharing this with our audience ONLY
                for
                educational purpose and we highly encourage our visitors to purchase original licensed software/Books. If
                someone with copyrights wants us to remove this software/Book, please contact us. immediately.
            </div>
            <div class="text-center">
                <div class="p-3 mb-3 border-raduis-12 text-start" style="background-color: #cde1f1">
                    <p>
                        If you have any troubles while downloading, Please visit <a class="text-decoration-underline"
                            href="{{ route('how.to.download') }}">How to download</a> page.
                    </p>
                    <p>Please visit <a class="text-decoration-underline" href="{{ route('ebooks.formats') }}">eBook
                            Readers</a> page to know about ebooks formats and programs you need to open them.</p>
                    <p class="text-danger">PLEASE NOTE THAT ALL BOOKS YOU DOWNLOAD FROM THIS WEBSITE ARE IN "PDF" OR
                        "EPUB" FORMAT DON'T DOWNLOAD
                        ANYTHING LIKE "EXE" OR "APK" OR ANY OTHER FORMAT</p>
                </div>

                <div class="box1 my-3">
                    <div class="d-flex justify-content-around align-items-center">
                        <span class="blink h1 wine-color"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="75" height="75">
                                <g fill='#800000'>
                                    <path
                                        d="M11 5.8c0 .4.1.7.4.9L16 11c.5.5.5 1.4 0 1.9l-4.6 4.3c-.3.2-.4.6-.4.9 0 1.1 1.3 1.7 2.1.9l6.8-6.2c.6-.5.6-1.4 0-1.9l-6.8-6.2c-.8-.5-2.1.1-2.1 1.1zM3 5.8c0 .4.1.7.4.9L8 11.1c.5.5.5 1.4 0 1.9l-4.6 4.3c-.3.2-.4.5-.4.9 0 1.1 1.3 1.7 2.1.9l6.8-6.2c.6-.5.6-1.4 0-1.9L5.1 4.9c-.8-.7-2.1-.1-2.1.9z">
                                    </path>
                                </g>
                            </svg></span>
                        <a href="{{ route('get.the.link', $book->slug) }}" class="h2">Free Download Link</a>
                        <span class="blink h1 wine-color"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="75" height="75">
                                <g fill='#800000'>
                                    <path
                                        d="M12.4 18.2c0-.4-.1-.7-.4-.9L7.4 13c-.5-.5-.5-1.4 0-1.9L12 6.8c.3-.2.4-.6.4-.9 0-1.1-1.3-1.7-2.1-.9l-6.8 6.2c-.6.5-.6 1.4 0 1.9l6.8 6.2c.8.5 2.1-.1 2.1-1.1zM20.4 18.2c0-.4-.1-.7-.4-.9L15.4 13c-.5-.5-.5-1.4 0-1.9L20 6.8c.3-.2.4-.6.4-.9 0-1.1-1.3-1.7-2.1-.9l-6.8 6.2c-.6.5-.6 1.4 0 1.9l6.8 6.2c.8.5 2.1-.1 2.1-1.1z">
                                    </path>
                                </g>
                            </svg></span>
                    </div>
                </div>
                <x-adsense></x-adsense>

                <div class="mt-5">
                    @if (session()->has('subscribed_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="text-dark">{{ session('subscribed_success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
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
                    </div>
                </div>
                <section>
                    <form action="{{ route('comment') }}" method="Post" class="p-4 border shadow-lg border-raduis-12 mt-5">
                        @csrf
                        <input type="hidden" name="dd" value="{{ $book->id }}">
                        <input type="hidden" name="link" value="{{ request()->url() }}">

                        <h4 class="text-dark">Leave a reply</h4>
                        <p>Your email address will not be published.</p>
                        <div class="mt-2">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <textarea id="comment" name="comment" class="form-control">{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input id="email" type="text" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="avatar">Choose your avatar</label>
                            <input type="hidden" id="avatar" name="avatar" value="/storage/avatars/avatar1.svg">
                            <div class="row flex-row flex-nowrap  pb-4 pt-2 ps-2 h-scroll">
                                @foreach ($avatars as $avatar)
                                    <img src="/storage/avatars/{{ $avatar }}" alt="user avatar for comments" width="100"
                                        height="100"
                                        class="avatar {{ $avatar == 'avatar1.svg' ? 'selected' : '' }} 
                                    w-100px mx-1 px-0 position-relative"
                                        onclick="selectAvatar(this)" />
                                @endforeach
                            </div>
                        </div>
                        <button class="btn btn-dark mt-3">Post comment</button>
                    </form>
                    <script>
                        function selectAvatar(element) {
                            document.getElementsByClassName('selected')[0].classList.remove('selected');
                            element.classList.add('selected');
                            document.getElementById("avatar").value = element.getAttribute('src');
                        }
                    </script>
                    @foreach ($book->comments as $comment)
                        <article class="d-flex p-3 border justify-content-between shadow-lg border-raduis-12 mt-5">
                            <div class="d-flex">
                                <div>
                                    <img src="{{ $comment->avatar }}" alt="" class="border-raduis-12 me-3" width="70"
                                        height="70">
                                </div>
                                <div>
                                    <div>
                                        <h5 class="fw-bold text-left mb-0 text-dark">{{ ucwords($comment->name) }}</h4>
                                            <p class="text-xs">
                                                Posted
                                                <time>{{ $comment->created_at->diffForHumans(null, true) . ' ago' }}</time>
                                            </p>
                                    </div>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            </div>
                            @auth
                                <div>
                                    <div x-data="{ show: false}">
                                        <div>
                                            <button type="button" class="bg-transparent border-0" @click="show = true"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30">
                                                    <g fill='#800000'>
                                                        <path
                                                            d="M16 5s-1-2-4-2-4 2-4 2H5l.4 2h13.3l.3-2h-3zM9.4 5S10 4 12 4s2.6 1 2.6 1H9.4zM8 21h8l2.4-13H5.6z">
                                                        </path>
                                                    </g>
                                                </svg></button>
                                        </div>
                                        <div x-show="show" style="display: none">
                                            <form action="{{ route('delete.comment', $comment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-transparent border-0 text-danger">Yes</button>
                                                <button type="button" class="bg-transparent border-0 text-primary"
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
            <script id="mcjs">
                ! function(c, h, i, m, p) {
                    m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m,
                        p)
                }(document, "script",
                    "https://chimpstatic.com/mcjs-connected/js/users/6504840845cc7babf43e5e51c/df32158795c8b46b17fe1b9e3.js");
            </script>

            {{-- Look inside content --}}
            <div class="d-none">
                <div itemscope itemtype="https://schema.org/Book" itemid="https://pdfsbooks.com/book/{{ $book->slug }}">
                    <img itemprop="image" src="{{ asset($book->poster) }}" alt="cover art: {{ $book->title }}" />
                    <h1><span itemprop="name">{{ $book->title }}</span></h1>
                    <div>Author: <span itemprop="author" itemtype="https://schema.org/Person">{{ substr($book->author, 3) }}</span></div>
                    <div>Language:
                        <meta itemprop="inLanguage" content="en" />English
                    </div>
                    <div>Subject: <span itemprop="about">{{ $book->category }}</span></div>
                    <span itemprop="numberOfPages">{{ $book->pages }}</span> pages
                    Publisher: <span itemprop="publisher">{{ $book->publisher }}</span>
                    <meta itemprop="datePublished" content="{{ $book->published }}">{{ $book->published }}
                </div>
            </div>
        @stop
