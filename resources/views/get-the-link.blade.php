@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                @if (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="text-dark">{{ session('failed') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-dark">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @error('email')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="text-dark">{{ $message }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                <div id="delayMsg" class="h3"></div>
                <x-adsense></x-adsense>

                <div id="link" class="d-none">
                    <div class="d-flex justify-content-around align-items-center">
                        <span class="blink h1 wine-color"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="100" height="100">
                                <g fill='#800000'>
                                    <path
                                        d="M11 5.8c0 .4.1.7.4.9L16 11c.5.5.5 1.4 0 1.9l-4.6 4.3c-.3.2-.4.6-.4.9 0 1.1 1.3 1.7 2.1.9l6.8-6.2c.6-.5.6-1.4 0-1.9l-6.8-6.2c-.8-.5-2.1.1-2.1 1.1zM3 5.8c0 .4.1.7.4.9L8 11.1c.5.5.5 1.4 0 1.9l-4.6 4.3c-.3.2-.4.5-.4.9 0 1.1 1.3 1.7 2.1.9l6.8-6.2c.6-.5.6-1.4 0-1.9L5.1 4.9c-.8-.7-2.1-.1-2.1.9z">
                                    </path>
                                </g>
                            </svg></span>
                        <div>
                            @if ($d_link)
                                <div class="bg-light p-3 rounded d-flex flex-column justify-content-center">
                                    <a href="<?php echo $d_link; ?>" target="_blank" class="h2">Free download
                                        link 1</a>
                                    <p><img src="{{ asset('storage\kaspersky.png') }}" alt="kaspersky icon"
                                            width="120" height="30"> Checked by Kaspersky. No virus detected</p>
                                </div>
                            @endif
                            @if ($d_link2)
                                <div class="bg-light p-3 mt-5 rounded d-flex flex-column justify-content-center">
                                    <a href="<?php echo $d_link2; ?>" target="_blank" class="h2">Free download
                                        link 2</a>
                                    <p><img src="{{ asset('storage\kaspersky.png') }}" alt="kaspersky icon"
                                            width="120" height="30"> Checked by Kaspersky. No virus detected</p>
                                </div>
                            @endif
                        </div>
                        <span class="blink h1 wine-color"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                width="100" height="100">
                                <g fill='#800000'>
                                    <path
                                        d="M12.4 18.2c0-.4-.1-.7-.4-.9L7.4 13c-.5-.5-.5-1.4 0-1.9L12 6.8c.3-.2.4-.6.4-.9 0-1.1-1.3-1.7-2.1-.9l-6.8 6.2c-.6.5-.6 1.4 0 1.9l6.8 6.2c.8.5 2.1-.1 2.1-1.1zM20.4 18.2c0-.4-.1-.7-.4-.9L15.4 13c-.5-.5-.5-1.4 0-1.9L20 6.8c.3-.2.4-.6.4-.9 0-1.1-1.3-1.7-2.1-.9l-6.8 6.2c-.6.5-.6 1.4 0 1.9l6.8 6.2c.8.5 2.1-.1 2.1-1.1z">
                                    </path>
                                </g>
                            </svg></span>
                    </div>
                    <div class="col-12 mt-4">Report the download link if there is any problem, click <button
                            type="button" class="border-0 bg-transparent text-primary text-decoration-underline fw-bold"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">Here</button> to report</div>
                </div>
                <x-adsense></x-adsense>

            </div>
        </div>
    </div>
    <script>
        var count = 0;
        var c = parseFloat("{{ $book_size }}");
        switch (true) {
            case c <= 5:
                count = 10;
                break;
            case (c > 5) && (c <= 10):
                count = 15;
                break;
            case (c > 10) && (c <= 15):
                count = 20;
                break;
            case (c > 15) && (c <= 20):
                count = 25;
                break;
            case c > 20:
                count = 30;
                break;
            default:
                count = 15;
                break;
        }
        document.getElementById('delayMsg').innerHTML =
            'Please wait while preparing the download link and checking for viruses, this process could take from <span class="wine-color">10</span> to <span class="wine-color">30</span> secondes depending on the file size <span id="countDown" class="wine-color fw-bold d-block display-1">' +
            count + '</span>';
        var timer = setInterval(function() {
            count--;
            document.getElementById('countDown').innerHTML = count;
            if (count == 0) {
                document.getElementById('link').classList.remove('d-none');
                clearInterval(timer);
            }
        }, 1000);
    </script>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('report.the.link', $slug) }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Report a link</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="email" class="h6">Enter your email if you would like to get the link
                                when we fix it</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mt-3">
                            <label for="report_message" class="h6">Write a report message (optional)(300
                                charecters maximum)</label>
                            <textarea name="report_message" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">Report</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
