@extends("adminlte::page")

@section('title', 'DCMA Notes')
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
        $heads = ['id', 'Name', 'email', 'Book URL', 'Description', 'Message', ['label' => 'Actions', 'no-export' => true, 'width' => 3]];
        $data = [];
        foreach ($dcma_notes as $note) {
            $btnDelete =
                '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' .
                $note->id .
                ')">
                                                                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                                                                        </button>';
            if ($note->status == 1) {
                $btnWaiting = '';
                $btnDone = '<i class="mx-1 btn-sm btn-default text-success fa fa-lg fas fa-check-circle"></i>';
            } else {
                $btnDone = '';
                $btnWaiting =
                    ' <form action="' .
                    route('dcma.update', $note->id) .
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
                $note->id .
                ')">
                                                                                        <i class="fa fa-lg far fa-envelope"></i>
                                                                                        </button>';
            $recored = [$note->id, $note->name, $note->email, '<a href="' . $note->infringing_url . '" target="_blank">Visit</a>', $note->description, $note->message, '<nobr>' . $btnEmail . $btnDone . $btnWaiting . $btnDelete . '</nobr>'];
            array_push($data, $recored);
        }
        $config = [
            'data' => $data,
            'order' => [[0, 'DESC']],
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
            Do You really want to delete this note?
            <x-slot name="footerSlot">
                <form id="deleteForm" action="#" method="post">
                    @csrf
                    <x-adminlte-button class="mr-auto" theme="danger" label="Yes" type="submit" />
                    <x-adminlte-button theme="success" label="No" data-dismiss="modal" />
                </form>
            </x-slot>
        </x-adminlte-modal>
        <x-adminlte-modal id="EmailModal" title="Send an Email">
            <x-slot name="footerSlot">
                <form id="EmailForm" action="#" method="post">
                    @csrf
                    <x-adminlte-button class="mr-auto" theme="danger" label="Send" type="submit" />
                    <x-adminlte-button theme="success" label="Cancel" data-dismiss="modal" />
                </form>
            </x-slot>
        </x-adminlte-modal>
        <script>
            function showDeleteModal(id) {
                $("#deleteModal").modal("show");
                var route = "{{ route('dcma.destroy') }}/" + id;
                $("#deleteForm").attr('action', route);
            }
            function showEmailModal(id) {
                $("#EmailModal").modal("show");
                var route = "{{ route('dcma.reply.mail') }}/" + id;
                $("#EmailForm").attr('action', route);
            }
        </script>
    </div>

@stop
