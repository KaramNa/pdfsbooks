@extends("adminlte::page")

@section('title', 'Comments')

@section('content')
    <div class="container mt-3">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="text-white">{{ session('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @php
        $heads = ['id', 'Comment', 'Commenter ', 'Commenter email', ['label' => 'Actions', 'no-export' => true, 'width' => 3]];
        $data = [];
        foreach ($comments as $comment) {
            $btnView = '<a href="https://pdfsbooks.com/book/' . $comment->book->slug . '" target="_blank" class="btn btn-xs btn-default text-teal mx-1 shadow" title="View"><i class="fa fa-lg fa fa-eye"></i></a>';
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' . $comment->id . ')"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
            $recored = [$comment->id, $comment->comment, $comment->name, $comment->email, '<nobr>' . $btnView . $btnDelete . '</nobr>'];
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
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="light" :config="$config" class="mb-5" striped
                hoverable bordered compressed />
        </div>
        {{-- Minimal --}}
        <x-adminlte-modal id="deleteModal" title="Delete Book">
            Do You really want to delete this comment?
            <x-slot name="footerSlot">
                <form id="deleteForm" action="#" method="post">
                    @csrf
                    <x-adminlte-button class="mr-auto" theme="danger" label="Yes" type="submit" />
                    <x-adminlte-button theme="success" label="No" data-dismiss="modal" />
                </form>
            </x-slot>
        </x-adminlte-modal>
        <script>
            function showDeleteModal(id) {
                $("#deleteModal").modal("show");
                var route = "{{ route('delete.comment') }}/" + id;
                $("#deleteForm").attr('action', route);
            }
        </script>
    </div>
@stop
