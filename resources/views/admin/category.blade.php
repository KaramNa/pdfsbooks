@extends("adminlte::page")

@section('title', 'Categories')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-white">{{ session('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('add.category') }}" method="POST">
                    @csrf

                    <label for="Category">Category</label>
                    <input type="text" class="form-control" name="category" focus>
                    @error('category')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-2" name="addForm">Add</button>
                </form>

            </div>
        </div>
        @php
            $heads = ['id', 'Category', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
            
            $data = [];
            foreach ($categories as $category) {
                $btnEdit =
                    '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Delete" onclick="showEditModal(' .
                    $category->id .
                    ',\'' .
                    $category->name .
                    '\')">
                                                                                                                                                                                                          <i class="fa fa-lg fa-fw fa-pen"></i>
                                                                                                                                                                                                      </button>';
                $btnDelete =
                    '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' .
                    $category->id .
                    ')">
                                                                                                                                                                                                          <i class="fa fa-lg fa-fw fa-trash"></i>
                                                                                                                                                                                                      </button>';
                $recored = [$category->id, $category->name, '<nobr>' . $btnEdit . $btnDelete . '</nobr>'];
                array_push($data, $recored);
            }
            $config = [
                'data' => $data,
                'order' => [[1, 'asc']],
                'columns' => [null, null, ['orderable' => false]],
            ];
        @endphp


        {{-- Compressed with style options / fill data using the plugin config --}}
        <div class="py-5">
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="light" :config="$config" class="mb-5"
                striped hoverable bordered compressed />
        </div>
        {{-- Minimal --}}

        <x-adminlte-modal id="deleteModal" title="Delete Category">
            Do You really want to delete this Category?
            <x-slot name="footerSlot">
                <form id="deleteForm" action="#" method="post">
                    @csrf
                    <x-adminlte-button class="mr-auto" theme="danger" label="Yes" type="submit" name="deleteForm" />
                    <x-adminlte-button theme="success" label="No" data-dismiss="modal" />
                </form>
            </x-slot>
        </x-adminlte-modal>
        <form action="#" method="post" id="editForm">
            @csrf
            <x-adminlte-modal id="EditModal" title="Edit Category">
                <div class="form-group">
                    <label for="category">Category Name:</label>
                    <input id="category_name" type="text" name="category_name" class="form-control">
                    @error('category_name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button class="mr-auto" theme="danger" label="Update" type="submit" name="editForm" />
                    <x-adminlte-button theme="success" label="Cancel" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-modal>
        </form>
        <script>
            function showEditModal(id, category_name) {
                $("#EditModal").modal("show");
                $("#category_name").val(category_name);
                var route = "{{ route('update.category') }}/" + id;
                $("#editForm").attr('action', route);
            }

            function showDeleteModal(id) {
                $("#deleteModal").modal("show");
                var route = "{{ route('destroy.category') }}/" + id;
                $("#deleteForm").attr('action', route);
            }
        </script>
    </div>
@stop
