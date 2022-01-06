@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4"><img src="storage/404.jpg" alt="a crying girl" class="img-fluid"></div>
            <div class="col-md-1"></div>
            <div class="col-md-7 text-center">
                <h1 class="text-dark display-2 fw-bold mb-5">Awww...Don’t Cry.</h1>
                <p class="text-center h4">It's just a 404 Error! <br>What you’re looking for may
                    have been misplaced in Long Term Memory.<br><br>&nbsp;</p>
                <a href="{{ route('home') }}" class="d-flex align-items-center justify-content-center"><spam class="me-2">BACK TO HOME </spam>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30">
                        <g fill='#000'>
                            <path
                                d="M12 20c.8-.8.8-2.1 0-2.8L8.9 14H20c1.1 0 2-.9 2-2s-.9-2-2-2H8.9L12 6.8c.8-.8.8-2.1 0-2.8-.8-.8-2-.8-2.8 0l-6.6 6.6c-.4.4-.6.9-.6 1.4 0 .5.2 1 .6 1.4L9.2 20c.7.8 2 .8 2.8 0z">
                            </path>
                        </g>
                    </svg></a>
            </div>
        </div>
    </div>
@stop
