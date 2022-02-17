@extends("adminlte::page")

@section('title', 'Rerported links')

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
            $heads = ['id', 'Reported Link', 'email', 'message', ['label' => 'Actions', 'no-export' => true, 'width' => 3]];
            $data = [];
            foreach ($reports as $report) {
                $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' . $report->id . ')"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
                $btnEmail = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Send Email" onclick="showEmailModal(' . $report->id . ')"><i class="fa fa-lg far fa-envelope"></i></button>';
                $recored = [$report->id, '<a href="' . $report->reported_link . '" target="_blank">Visit</a>', $report->email, $report->message, '<nobr>' . $btnEmail . $btnDelete . '</nobr>'];
                array_push($data, $recored);
            }
            $config = [
                'data' => $data,
                'order' => [[0, 'DESC']],
                'columns' => [null, null, null, null, ['orderable' => false]],
            ];
        @endphp
        {{-- Compressed with style options / fill data using the plugin config --}}
        <div class="py-5">
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="light" :config="$config" class="mb-5"
                striped hoverable bordered compressed />
        </div>
        {{-- Minimal --}}
        <x-adminlte-modal id="deleteModal" title="Delete Book">
            Do You really want to delete this Report?
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
                var route = "{{ route('delete.report') }}/" + id;
                $("#deleteForm").attr('action', route);
            }

            function showEmailModal(id) {
                $("#EmailModal").modal("show");
                var route = "{{ route('reports.reply.mail') }}/" + id;
                $("#EmailForm").attr('action', route);
            }
        </script>
    </div>
@stop
