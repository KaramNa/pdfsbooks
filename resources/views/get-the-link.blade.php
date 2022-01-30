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
                <x-telegram />
                <x-adsense></x-adsense>

                <div id="link" class="d-none">
                    <div class="d-flex justify-content-around align-items-center">
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
