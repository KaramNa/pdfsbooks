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
                    <div x-data="{ show: false}">
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
                <div class="social-buttons">
                    {!! $shareComponent !!}
                    <div class="fb-telg">
                        <x-telegram />
                        <x-facebook />
                    </div>
                </div>
                @if ($book->draft == 1)
                    <div class="download-button amazon">
                        <a href="{{ $book->paid_download_link }}" target="_blank" title="Amazon {{ $book->title }}">Get
                            your
                            copy from Amazon
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
                <div class="form">
                    <a id="description"></a>
                    <div id="t_description" class="tab active">
                        {!! $book->description !!}
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
                            <span itemprop="inLanguage" content="en">{{ $book->language }}</span>
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
                    <x-adsense></x-adsense>
                    <div class="disclaimer">
                        <strong>Disclaimer:</strong><br>
                        <strong>This site complies with DMCA Digital Copyright Laws.</strong> Please bear in mind that we do
                        not
                        own
                        copyrights to
                        this book. We are not hosting any copyrighted contents on our servers, it’s a catalog of
                        links
                        that
                        already found on the internet. <br><strong>pdfsbooks.com</strong> doesn’t have any material hosted
                        on
                        the
                        server of this
                        page, only links to books that are taken from other sites on the web are published and these links
                        are
                        unrelated to the book server.<br> Moreover <strong>pdfsbooks.com</strong> server does not store any
                        type
                        of
                        book, guide,
                        software, or images. No illegal copies are made or any copyright © and / or copyright is damaged or
                        infringed since all material is free on the internet. If you feel that we have
                        violated your copyrights, then please contact us immediately. <br>We’re sharing this with our
                        audience
                        ONLY
                        for
                        educational purpose and we highly encourage our visitors to purchase original licensed
                        Books.
                        If
                        someone with copyrights wants us to remove this Book, please contact us. immediately.
                    </div>
                    <div class="note">
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
                    <x-adsense />
                    <x-related-post :book='$book' />
                    @if ($book->draft == 0)
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
                                <textarea id="comment" name="comment"
                                    class="form-control">{{ old('comment') }}</textarea>
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
                                        <div x-data="{ show: false}">
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
