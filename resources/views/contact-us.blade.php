@extends('layouts.app')

@section('content')
    <div class="mt-3"> <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673" crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                         style="display:block; text-align:center;"
                         data-ad-layout="in-article"
                         data-ad-format="fluid"
                         data-ad-client="ca-pub-2052289648779673"
                         data-ad-slot="3036230486"></ins>
                <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-dark">Contact Us</h1>
                <form action="{{ route('contact') }}" class="mt-3 p-3 p-sm-5 shadow-lg rounded" method="POST">
                    @csrf
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session("success") }}
                        </div>
                    @endif
                    <input name="name" type="text" placeholder="Enter your name" class="form-control">
                    @error("name")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <input name="email" type="email" placeholder="Enter your email" class="form-control mt-3">
                     @error("email")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <textarea name="message" class="form-control mt-3" placeholder="Enter your message"></textarea>
                     @error("message")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-dark text-white mt-3">Send email</button>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-3"> <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2052289648779673" crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                         style="display:block; text-align:center;"
                         data-ad-layout="in-article"
                         data-ad-format="fluid"
                         data-ad-client="ca-pub-2052289648779673"
                         data-ad-slot="3036230486"></ins>
                <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
    </div>
@stop
