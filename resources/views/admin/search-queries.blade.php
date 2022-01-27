@extends("adminlte::page")

@section('title', 'Search Queries')

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
            $heads = ['id', 'Query', 'Status', 'Number of searches', ['label' => 'Actions', 'no-export' => true, 'width' => 3]];
            $data = [];
            foreach ($queries as $query) {
                $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' . $query->id . ')"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
                $recored = [$query->id, $query->query, $query->result == 1 ? 'Found' : 'Not Found' , $query->num_of_searches, '<nobr>' . $btnDelete . '</nobr>'];
                array_push($data, $recored);
            }
            $config = [
                'data' => $data,
                'order' => [[1, 'asc']],
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
            Do You really want to delete this Query?
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
                var route = "{{ route('delete.query') }}/" + id;
                $("#deleteForm").attr('action', route);
            }
        </script>
    </div>
@stop
