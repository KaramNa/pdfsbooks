@extends("adminlte::page")

@section('title', 'Books Orders')
@section('content')

    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="text-white">{{ session('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @php
        $heads = ['id', 'Book Name', 'Book URL', 'Orderer Name', 'Orderer Email', 'Notes', ['label' => 'Actions', 'no-export' => true, 'width' => 3]];
        $data = [];
        foreach ($suggestions as $suggestion) {
            $btnDelete =
                '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' .
                $suggestion->id .
                ')">
                                                                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                                                                        </button>';
            if ($suggestion->status == 1) {
                $btnWaiting = '';
                $btnDone = '<i class="mx-1 btn-sm btn-default text-success fa fa-lg fas fa-check-circle"></i>';
            } else {
                $btnDone = '';
                $btnWaiting =
                    ' <form action="' .
                    route('order.done', $suggestion->id) .
                    '" method="POST"
                                                                            class="text-center d-inline">
                                                                            <input type="hidden" name="_token" value="' .
                    csrf_token() .
                    '">
                                                                            <button type="submit" class="btn btn-xs btn-default text-warning mx-1 shadow" title="Done">
                                                                                    <i class="fa fa-lg far fa-clock"></i>
                                                                                    </button>
                                                                        </form>';
            }
            $btnEmail =
                '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Send Email" onclick="showEmailModal(' .
                $suggestion->id .
                ')">
                                                                                        <i class="fa fa-lg far fa-envelope"></i>
                                                                                        </button>';
            $recored = [$suggestion->id, $suggestion->book_name, '<a href="' . $suggestion->book_url . '" target="_blank">Visit</a>', $suggestion->orderer_name, $suggestion->orderer_email, $suggestion->notes, '<nobr>' . $btnEmail . $btnDone . $btnWaiting . $btnDelete . '</nobr>'];
            array_push($data, $recored);
        }
        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null, null, ['orderable' => false]],
        ];
        @endphp
        {{-- Compressed with style options / fill data using the plugin config --}}
        <div class="py-5">
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="light" :config="$config" class="mb-5"
                striped hoverable bordered compressed />
        </div>
        {{-- Minimal --}}
        <x-adminlte-modal id="deleteModal" title="Delete Book">
            Do You really want to delete this order?
            <x-slot name="footerSlot">
                <form id="deleteForm" action="#" method="post">
                    @csrf
                    <x-adminlte-button class="mr-auto" theme="danger" label="Yes" type="submit" />
                    <x-adminlte-button theme="success" label="No" data-dismiss="modal" />
                </form>
            </x-slot>
        </x-adminlte-modal>
        <form id="EmailForm" action="#" method="post">
            <x-adminlte-modal id="EmailModal" title="Send an Email">
                @csrf
                <div class="mt-3">
                    <label for="book_link" class="h6">Book link:</label>
                    <input type="text" name="book_url" class="form-control">
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="mr-auto" theme="danger" label="Send" type="submit" />
                    <x-adminlte-button theme="success" label="Cancel" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-modal>
        </form>
        <script>
            function showDeleteModal(id) {
                $("#deleteModal").modal("show");
                var route = "{{ route('delete.order') }}/" + id;
                $("#deleteForm").attr('action', route);
            }
            function showEmailModal(id) {
                $("#EmailModal").modal("show");
                var route = "{{ route('order.reply.mail') }}/" + id;
                $("#EmailForm").attr('action', route);
            }
        </script>
    </div>

@stop
