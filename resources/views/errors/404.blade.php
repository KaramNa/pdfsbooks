@extends('layouts.app')

@section('content')
    <div class="container my-100 page-404">
        <div class="flex">
            <div><img src="/storage/404.jpeg" alt="a crying girl" class="img-fluid"></div>
            <div></div>
            <div class="text-center">
                <h1>Awww ... Don’t Cry.</h1>
                <p class="text-center">It's just a 404 Error! <br>What you’re looking for may
                    have been misplaced in Long Term Memory.<br>
                    <a href="{{ route('home') }}" class="">
                        <span>BACK TO HOME </span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30">
                            <g fill='#000'>
                                <path
                                    d="M12 20c.8-.8.8-2.1 0-2.8L8.9 14H20c1.1 0 2-.9 2-2s-.9-2-2-2H8.9L12 6.8c.8-.8.8-2.1 0-2.8-.8-.8-2-.8-2.8 0l-6.6 6.6c-.4.4-.6.9-.6 1.4 0 .5.2 1 .6 1.4L9.2 20c.7.8 2 .8 2.8 0z">
                                </path>
                            </g>
                        </svg>
                    </a>
                </p>
                <p class="text-center">Or try searching for something else, we have alot of books to choose from</p>
                <x-search-form />
            </div>
        </div>
    </div>
@stop
