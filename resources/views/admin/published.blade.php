@extends("adminlte::page")

@section('title', 'Show All Books')


@section('content')
    <div class="container">
        <form action="{{ route('draft.published.books') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-dark mt-4">Draft</button>
            @if (session()->has('status'))
                <div class="text-danger">
                    {{ session('status') }}
                </div>
            @endif
            {{-- Setup data for datatables --}}
            @php
                $heads = [['label' => '<input type="checkbox" id="selectAll" onclick="toggle(this)"><span class="fw-bold"> Check all</span>', 'width' => 10], 'id', 'Title', 'Author', 'Status', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
        
                $data = [];
                foreach ($books as $book) {
                    $btnEdit =
                        '<a href="' .
                        route('edit.book', $book->id) .
                        '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                                                                                                                                                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                                                                                                                                                                    </a>';
                    $btnDetails =
                        '<a href="' .
                        route('single.book', $book->slug) .
                        '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details" target="_blank">
                                                                                                                                                                                           <i class="fa fa-lg fa-fw fa-eye"></i>
                                                                                                                                                                                       </a>';
                    $btnDelete =
                        '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showModal(' .
                        $book->id .
                        ')">
                                                                                                                                                          <i class="fa fa-lg fa-fw fa-trash"></i>
                                                                                                                                                      </button>';
                    if ($book->draft == 1) {
                        $btnDraft = '';
                        $btnPublish =
                            '<form action="' .
                            route('publish', $book->id) .
                            '" method="post" class="d-inline">
                                                                                                                    <input type="hidden" name="_token" value="' .
                            csrf_token() .
                            '">
                                                                                                                    <button class="btn btn-xs btn-default text-info mx-1 shadow" title="Publish" type="submit">
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
                            '">
                                                                                                                <button class="btn btn-xs btn-default text-cyan mx-1 shadow" title="Draft" type="submit">
                                                                                                                <i class="fa fa-lg fas fa-eye-slash"></i></button>
                                                                                                                </form>';
                    }
                    $recored = ['<input type="checkbox" name="published[]" value="' . $book->id . '">', $book->id, $book->title, substr($book->author, 2), $book->draft == 1 ? 'Drafted' : 'Published', '<nobr>' . $btnDraft . $btnPublish . $btnEdit . $btnDelete . $btnDetails . '</nobr>'];
                    array_push($data, $recored);
                }
                $config = [
                    'data' => $data,
                    'order' => [[1, 'asc']],
                    'columns' => [['orderable' => false], null, null, null, null, ['orderable' => false]],
                ];
            @endphp
            {{-- Compressed with style options / fill data using the plugin config --}}
            <div class="py-3">
                <x-adminlte-datatable id="table1" :heads="$heads" head-theme="light" :config="$config" class="mb-5"
                    striped hoverable bordered compressed />
            </div>
            {{-- Minimal --}}
            <x-adminlte-modal id="deleteModal" title="Delete Book">
                Do You really want to delete this book?
                <x-slot name="footerSlot">
                    <form id="deleteForm" action="<?php echo route('delete.book', 3); ?>" method="post">
                        @csrf
                        <x-adminlte-button class="mr-auto" theme="danger" label="Yes" type="submit" />
                        <x-adminlte-button theme="success" label="No" data-dismiss="modal" />
                    </form>
                </x-slot>
            </x-adminlte-modal>
        </form>
        <script>
            function showModal(id) {
                $("#deleteModal").modal("show");
                var route = "{{ route('delete.book') }}/" + id;
                $("#deleteForm").attr('action', route);
            }
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != source)
                        checkboxes[i].checked = source.checked;
                }
            }
        </script>
    </div>
@stop
