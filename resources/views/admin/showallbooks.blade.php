@extends("adminlte::page")

@section('title', 'Show All Books')


@section('content')
    {{-- Setup data for datatables --}}
    <div class="container">
        <div class="alert alert-success alert-dismissible fade show d-none mt-3" role="alert">
            <span class="text-white"></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @php
            $heads = ['id', 'Title', 'Author', 'Status','Publisher', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
            $data = [];
            foreach ($books as $book) {
                $btnEdit = '<a href="' . route('edit.book', $book->id) . '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>';
                $btnTelegram = '<button class="btn btn-xs btn-default text-blue mx-1 shadow" title="Telegram Notification" onclick="showTelegramModal(' . $book->id . ')"><i class="fab fa-lg fab fa-telegram"></i></button>';
                $btnDetails =
                    '<a href="' .
                    route('single.book', $book->slug) .
                    '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details" target="_blank">
                      <i class="fa fa-lg fa-fw fa-eye"></i></a>';
                $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' . $book->id . ')"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
                if ($book->draft == 1) {
                    $btnDraft = '';
                    $btnPublish =
                        '<form action="' .
                        route('publish', $book->id) .
                        '" method="post" class="d-inline">
                                                                                                                                                                                    <input type="hidden" name="_token" value="' .
                        csrf_token() .
                        '">
                        <button class="btn btn-xs btn-default text-info mx-1 shadow" title="Publish" type="submit" name="publishForm">
                        <i class="fa fa-lg fas fa-upload"></i></button>
                        </form>';
                } else {
                    $btnPublish = '';
                    $btnDraft =
                        '<form action="' .
                        route('draft', $book->id) .
                        '" method="post" class="d-inline">
                                                                                                                                                                                <input type="hidden" name="_token" value="' .
                        csrf_token() .
                        '"><button class="btn btn-xs btn-default text-cyan mx-1 shadow" title="Draft" type="submit" name="draftForm">
                                                                                                                                                        <i class="fa fa-lg fas fa-eye-slash"></i></button></form>';
                }
                $record = [$book->id, $book->title, substr($book->author, 2), $book->draft == 1 ? 'Drafted' : 'Published', $book->publisher, '<nobr>' . $btnDraft . $btnPublish . $btnEdit . $btnDelete . $btnDetails . $btnTelegram . '</nobr>'];
                array_push($data, $record);
            }
            $config = [
                'data' => $data,
                'order' => [[0, 'DESC']],
                'columns' => [null, null, null, null,null, ['orderable' => false]],
            ];
        @endphp
        {{-- Compressed with style options / fill data using the plugin config --}}
        <div class="py-5">
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="light" :config="$config" class="mb-5"
                striped hoverable bordered compressed />
        </div>
        {{ $books->links() }}
        {{-- Minimal --}}
        <x-adminlte-modal id="deleteModal" title="Delete Book">
            Do You really want to delete this book?
            <x-slot name="footerSlot">
                <form id="deleteForm" action="#" method="post">
                    @csrf
                    <x-adminlte-button class="mr-auto" theme="danger" label="Yes" type="submit" name="deleteForm" />
                    <x-adminlte-button theme="success" label="No" data-dismiss="modal" />
                </form>
            </x-slot>
        </x-adminlte-modal>
        <x-adminlte-modal id="telegramModal" title="Telegram Notification">
            Do You really want to send a telegram notification about this book?
            <x-slot name="footerSlot">
                <form id="telegramForm" action="#" method="post">
                    @csrf
                    <x-adminlte-button class="mr-auto" theme="danger" label="Yes" type="button" id="telegram_button"
                        value='' />
                    <x-adminlte-button theme="success" label="No" data-dismiss="modal" />
                </form>
            </x-slot>
        </x-adminlte-modal>
        <script>
            function showDeleteModal(id) {
                $("#deleteModal").modal("show");
                var route = "{{ route('delete.book') }}/" + id;
                $("#deleteForm").attr('action', route);
            }

            function showTelegramModal(id) {
                $("#telegramModal").modal("show");
                $("#telegram_button").val(id);  
            }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $("#telegram_button").click(function(event) {
                event.preventDefault();
                let id = $("#telegram_button").val();
                let _token = $('meta[name="csrf-token"]').attr('content');;
                $.ajax({
                    url: "{{ route('telegram.notif') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(response) {
                        if (response) {
                            $("#telegramModal").modal("hide");
                            $('.alert>span').text(response.success);
                            $('.alert').removeClass('d-none');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        </script>

    </div>
@stop
