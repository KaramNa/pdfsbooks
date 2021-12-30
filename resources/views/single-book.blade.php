
@extends('layouts.app')

@section('share_image', "$book->poster")
@section('book_url', request()->url())
@section('book_desc', "$book->title")
@section('page_title', "$book->title")
@section('book_title', "$book->title")

@section('content')
    {{-- <div style="width:100%;margin-bottom:10px">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3490904183682637" crossorigin="anonymous"></script><ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-3490904183682637" data-ad-slot="5374661124" data-ad-format="auto" data-full-width-responsive="true"></ins>
            </div> --}}

    <div class="wrap">
        <div class="col100">
            <h1 class="wine-color">{{ $book->title }}</h1>
            <h2 class="mt-3">{{ $book->qoute }}</h2>
            <p><b>{{ $book->author }}</b></p>
        </div>
        <div class="col300 action">
            @auth
                <div>
                    @if ($book->draft)
                        <form action="{{ route('publish', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-down mt-3 text-start"><i
                                    class="fas fa-upload text-white me-4"></i>Publish</button>
                        </form>
                    @else
                        <form action="{{ route('draft', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-down mt-3 text-start"><i
                                    class="fas fa-drafting-compass text-white me-4"></i>Draft</button>
                        </form>
                    @endif
                </div>
                <div>
                    <a href="{{ route('edit.book', $book) }}" class="btn-down mt-3"><i class="far fa-edit text-white me-4"></i>
                        Edit</a>
                </div>
                <div x-data="{ show: false}">
                    <div>
                        <button type="button" class="btn-down mt-3 text-start" @click="show = true"><i
                                class="fas fa-trash text-white me-4"></i>Delete</button>
                    </div>
                    <div x-show="show" style="display:none">
                        <p class="mb-0 mt-3">Do You really want to delete this book?!</p>
                        <form action="{{ route('delete.book', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger mt-3 text-start"><i
                                    class="fas fa-check text-white me-4"></i>Yes</button>
                            <button type="button" class="btn btn-primary mt-3 text-start" @click="show = false"><i
                                    class="fas fa-times text-white me-4"></i>No</button>
                        </form>
                    </div>
                </div>
            @endauth

        </div>
    </div>
    <div class="wrap mt30">
        <div class="col300 center"> <img src="{{ $book->poster }}" alt="Remote Sensing of Plant Biodiversity"
                class="img">
            <div class="soc">
                {!! $shareComponent !!}
            </div>
             <div class="fb-page mb-2" data-href="https://www.facebook.com/FreeBooks/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/FreeBooks/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/FreeBooks/">E-Books</a></blockquote>
             </div>

        </div>
        <div class="col100 txt mt-4 mt-sm-0">
            <a href="#description" id="a_description" onclick="return tab('description')" class="btn-menu active"
                title="Book Description">
                <span class="mobi1">Description</span>
                <span class="mobi2"><i class="icon-book"></i></span>
            </a>
            <a href="#details" id="a_details" onclick="return tab('details')" class="btn-menu" title="Book Details">
                <span class="mobi1">Details</span>
                <span class="mobi2"><i class="icon-info"></i></span>
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
            <!--<div style="width:100%;margin-bottom: 10px"><ins class="adsbygoogle" style="display:block"-->
            <!--        data-ad-client="ca-pub-3490904183682637" data-ad-slot="7831952431" data-ad-format="auto"-->
            <!--        data-full-width-responsive="true"></ins></div>-->
            <!--<script>-->
            <!--    [].forEach.call(document.querySelectorAll('.adsbygoogle'), function() {-->
            <!--        (adsbygoogle = window.adsbygoogle || []).push({});-->
            <!--    });-->
            <!--</script>-->
            <div> <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-2052289648779673"
     data-ad-slot="3036230486"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
            <h3 class="text-dark">Related Books</h3>
            <div class="grid m">
                @foreach ($relatedBooks as $relatedBook)
                    <div class="item"><a href="{{ route('single.book', $relatedBook->slug) }}"
                            title="{{ $relatedBook->title }}"><img data-src="{{ $relatedBook->poster }}"
                                src="{{ $relatedBook->poster }}" class="lazyload img"
                                alt="{{ $relatedBook->title }}"></a>
                        <div class="pad"><a href="{{ route('single.book', $relatedBook->slug) }}"
                                title="{{ $relatedBook->title }}">{{ $relatedBook->title }}</a></div>
                        <div class="h">{{ $relatedBook->description }}</div>
                    </div>
                @endforeach
            </div>
            <div class="mb-5">
                <strong>Disclaimer:</strong><br>
                <strong>This site complies with DMCA Digital Copyright Laws.</strong> Please bear in mind that we do not own copyrights to
                this book/software. We are not hosting any copyrighted contents on our servers, it’s a catalog of links that
                already found on the internet. <br><strong>pdfsbooks.com</strong> doesn’t have any material hosted on the server of this
                page, only links to books that are taken from other sites on the web are published and these links are
                unrelated to the book server.<br> Moreover <strong>pdfsbooks.com</strong> server does not store any type of book, guide,
                software, or images. No illegal copies are made or any copyright © and / or copyright is damaged or
                infringed since all material is free on the internet. If you feel that we have
                violated your copyrights, then please contact us immediately. <br>We’re sharing this with our audience ONLY for
                educational purpose and we highly encourage our visitors to purchase original licensed software/Books. If
                someone with copyrights wants us to remove this software/Book, please contact us. immediately.
            </div>
             <div class="text-center">
                   <div class="p-3 mb-3 border-raduis-12 text-start" style="background-color: #cde1f1">
                    <p>
                        If you have any troubles while downloading, Please visit <a class="text-decoration-underline"
                            href="{{ route('how.to.download') }}">How to download</a> page.
                    </p>
                    <p>Please visit <a class="text-decoration-underline" href="{{ route('ebooks.formats') }}">eBook Readers</a> page to know about ebooks formats and programs you need to open them.</p>
                    <p class="text-danger">PLEASE NOTE THAT ALL BOOKS YOU DOWNLOAD FROM THIS WEBSITE ARE IN "PDF" OR "EPUB" FORMAT DON'T DOWNLOAD
                        ANYTHING LIKE "EXE" OR "APK" OR ANY OTHER FORMAT</p>
                </div>

                <div class="box1 my-3">
                      <div class="d-flex justify-content-around ">
                        <span class="blink h1 wine-color"><i class="fas fa-angle-right"></i><i class="fas fa-angle-right"></i></span>
                         <a href="{{ route('get.the.link', $book->slug) }}" class="h2">Get the link</a>
                        <span class="blink h1 wine-color"><i class="fas fa-angle-left"></i><i class="fas fa-angle-left"></i></span>
                    </div>
                </div>
                <div> <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-2052289648779673"
     data-ad-slot="3036230486"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script></div>
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @error('email_address')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="text-dark">{{ $message }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @enderror
                    <form action="{{ route("newsletter") }}" method="POST" class="border shadow-lg p-4 border-raduis-12">
                        @csrf
                        <p>Subscribe to our newsletters to stay up to date with our activities</p>
                        <div class="d-flex">
                            <input class="inp" name="email_address" autocomplete="off"
                                placeholder="Subscribe to newsletter, Enter your email" type="email" required>
                            <button aria-label="submit" class="subscribe" type="submit">Subscribe</button>
                        </div>
                    </form>
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
                        <textarea name="comment" class="form-control">{{ old('comment') }}</textarea>
                        @error('comment')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="avatar">Choose your avatar</label>
                        <input type="hidden" id="avatar" name="avatar" value="/storage/avatars/avatar1.jpg">
                        <div class="row flex-row flex-nowrap  pb-4 pt-2 ps-2 h-scroll">
                            @foreach ($avatars as $avatar)
                                <img src="/storage/avatars/{{ $avatar }}" width="100" height="100"
                                    class="avatar {{ $avatar == 'avatar1.jpg' ? 'selected' : '' }} 
                                    w-100px mx-1 px-0 position-relative" />
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-dark mt-3">Post comment</button>
                </form>
                <script>
                    $('.avatar').on("click", function() {
                        $('.avatar').removeClass('selected');
                        $(this).addClass('selected');
                        $("#avatar").val($(this).first()[0].getAttribute('src'));

                    });
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
                                        <button type="button" class="bg-transparent border-0" @click="show = true"><i
                                                class="fas fa-trash"></i></button>
                                    </div>
                                    <div x-show="show" style="display: none">
                                        <form action="{{ route('delete.comment', $comment->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-transparent border-0"><i
                                                    class="fas fa-check text-danger"></i></button>
                                            <button type="button" class="bg-transparent border-0" @click="show = false"><i
                                                    class="fas fa-times text-primary"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth

                    </article>
                @endforeach
            </section>
        </div>
    @stop
