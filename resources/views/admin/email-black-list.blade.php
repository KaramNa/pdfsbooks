@extends("adminlte::page")

@section('title', 'black-list-emails')

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
                <form action="{{ route('block.email') }}" method="POST">
                    @csrf

                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" focus>
                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-2" name="blockEmailForm">Add</button>
                </form>

            </div>
        </div>
        @php
            $heads = ['id', 'Email Or Name', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
            
            $data = [];
            foreach ($emails as $email) {
                $btnDelete =
                    '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' .
                    $email->id .
                    ')"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
                $recored = [$email->id, $email->email, '<nobr>' . $btnDelete . '</nobr>'];
                array_push($data, $recored);
            }
            $config = [
                'data' => $data,
                'order' => [[0, 'DESC']],
                'columns' => [null, null, ['orderable' => false]],
            ];
        @endphp


        {{-- Compressed with style options / fill data using the plugin config --}}
        <div class="py-5">
            <x-adminlte-datatable id="table2" :heads="$heads" head-theme="light" :config="$config" class="mb-5"
                striped hoverable bordered compressed />
        </div>
        {{-- Minimal --}}

        <x-adminlte-modal id="deleteModal" title="Delete email">
            Do You really want to remove this email?
            <x-slot name="footerSlot">
                <form id="deleteForm" action="#" method="post">
                    @csrf
                    <x-adminlte-button class="mr-auto" theme="danger" label="Yes" type="submit" name="deleteForm" />
                    <x-adminlte-button theme="success" label="No" data-dismiss="modal" />
                </form>
            </x-slot>
        </x-adminlte-modal>
        <script>
            function showDeleteModal(id) {
                $("#deleteModal").modal("show");
                var route = "{{ route('destroy.email') }}/" + id;
                $("#deleteForm").attr('action', route);
            }
        </script>
    </div>
@stop