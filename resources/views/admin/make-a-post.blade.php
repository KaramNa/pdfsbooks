@extends("adminlte::page")

@section('title', 'Make a post')
@section('plugins.Select2', true)

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
            @section('content')
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-white">{{ session('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="py-3">
                    <label for="tag">Book Tag</label>
                    <x-adminlte-select2 id="tagsSelect" name="tag" class="form-control bg-white">
                        <option value="" selected>Choose tag</option>
                        @foreach ($tags as $tag)
                            @if ($tag->tag)
                                <option value="{{ $tag->tag }}" {{ old('tag') == $tag->tag ? 'selected' : '' }}>
                                    {{ $tag->tag }}
                                </option>
                            @endif
                        @endforeach
                    </x-adminlte-select2>
                </div>
            </div>
            <p><button id='makeCollage' class='btn btn-primary ml-2' type='button' disabled>Make collage</button></p>
            <div id="books_covers">
            </div>
        </div>
        <form id="telegramForm" action="#" method="post">
            <x-adminlte-modal id="telegramModal" title="Post to Telegram">
                @csrf
                <div class="mt-3">
                    <label for="book_link" class="h6">Post Text:</label>
                    <textarea type="text" id="post_text" name="post_text" class="form-control"></textarea>
                </div>
                <div class="mt-3">
                    <label for="collection_url" class="h6">link:</label>
                    <input type="text" id="collection_url" name="collection_url" class="form-control">
                </div>
                <input type="hidden" id="collage_name" name="collage_name">
                <x-slot name="footerSlot">
                    <x-adminlte-button class="mr-auto" theme="primary" label="Send" type="button"
                        id="telegram_button" />
                    <x-adminlte-button theme="danger" label="Cancel" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-modal>
        </form>
        {{-- <form id="facebookForm" action="#" method="post">
            <x-adminlte-modal id="facebookModal" title="Post to Facebook">
                @csrf
                <div class="mt-3">
                    <label for="book_link" class="h6">Post Text:</label>
                    <textarea type="text" id="post_facebook_text" name="post_facebook_text" class="form-control"></textarea>
                </div>
                {{-- <div class="mt-3">
                    <label for="collection_url" class="h6">link:</label>
                    <input type="text" id="collection_url" name="collection_url" class="form-control">
                </div> --}}
                <x-slot name="footerSlot">
                    <x-adminlte-button class="mr-auto" theme="primary" label="Send" type="button"
                        id="facebook_button" />
                    <x-adminlte-button theme="danger" label="Cancel" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-modal>
        </form> --}}

    </div>
    <style>
        .selected-cover {
            border: 5px solid var(--blue);
            opacity: .4;
        }

    </style>
@stop
@section('js')
    <script>
        $('#tagsSelect').on("change", (function(event) {
            let tag = $('#tagsSelect').val();
            if (tag != "") {
                $.ajax({
                    url: "{{ route('get.books.covers') }}",
                    type: "GET",
                    data: {
                        tag: tag,
                    },
                    success: function(response) {
                        if (response) {
                            $("#books_covers").html("");
                            $('#books_covers').append(
                                "<p>Select covers you want to use to make a collage, number of selected covers must be in [1,2,3,4,6,8,9]</p>"
                            );
                            response.forEach(element => {
                                let i = 0;
                                $('#books_covers').append(
                                    "<img src='" +
                                    element['poster'] +
                                    "'class='m-2' width=220 height=370 onclick='selectCover(this)'>"
                                );
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        }));
        var selectedCovers = [];

        function selectCover(element) {
            element.classList.toggle('selected-cover');
            var arr = $('.selected-cover');
            selectedCovers = [];
            for (let index = 0; index < arr.length; index++) {
                selectedCovers.push(arr[index].src);
            }
            if ([1, 2, 3, 4, 6, 8, 9].indexOf(selectedCovers.length) > -1)
                $("#makeCollage").prop("disabled", false);
            else
                $("#makeCollage").prop("disabled", true);

        }

        $("#makeCollage").click(function(event) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('make.collage') }}",
                type: "POST",
                data: {
                    covers: JSON.stringify(selectedCovers),
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        $("#books_covers").html(
                            "<p><img src='https://pdfsbooks.com/public/storage/collage/" +
                            response +
                            "'></p><p><a class='btn btn-success' href='https://pdfsbooks.com/public/storage/collage/" +
                            response +
                            "' download>Download collage</a><button type='button' class='btn btn-primary mx-4' onclick='showFacebookModal()'>Post to Facebook</button><button type='button' class='btn btn-warning' onclick='showTelegramModal()'>Post to Telegram</button></p>"
                        );
                        $("#makeCollage").prop("disabled", true);
                        $("#collage_name").val(response);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        function showTelegramModal() {
            $("#telegramModal").modal("show");
            $("#collection_url").val("https://pdfsbooks.com?tag=" + $('#tagsSelect').val());
        }

        function showFacebookModal() {
            $("#facebookModal").modal("show");
        }
    </script>
    <script>
        $("#telegram_button").click(function(event) {
            event.preventDefault();
            let url = $("#collection_url").val();
            let post_text = $("#post_text").val();
            let collage_name = $("#collage_name").val();
            let _token = $('meta[name="csrf-token"]').attr('content');;
            $.ajax({
                url: "{{ route('make.telegram.post') }}",
                type: "POST",
                data: {
                    _token: _token,
                    post_text: post_text,
                    collage_name: collage_name,
                    collection_url: url
                },
                success: function(response) {
                    if (response) {
                        $("#telegramModal").modal("hide");
                        if (response.success) {
                            $('.alert>span').text(response.success);
                            $('.alert').removeClass('alert-danger');
                            $('.alert').addClass('alert-success');
                        }

                        if (response.failed) {
                            $('.alert>span').text(response.failed);
                            $('.alert').removeClass('alert-success');
                            $('.alert').addClass('alert-danger');
                        }
                        $('.alert').removeClass('d-none');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
   
@stop
