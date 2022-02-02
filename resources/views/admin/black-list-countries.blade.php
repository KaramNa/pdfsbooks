@extends("adminlte::page")

@section('title', 'black-list-countries')

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
                <form action="{{ route('block.country') }}" method="POST">
                    @csrf

                    <label for="country">IP Address</label>
                    <input type="text" class="form-control" name="country" focus>
                    @error('country')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-2" name="blockCountryForm">Add</button>
                </form>

            </div>
        </div>
        @php
            $heads = ['id', 'Country', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
            
            $data = [];
            foreach ($countries as $country) {
                $btnDelete =
                    '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' .
                    $country->id .
                    ')"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
                $recored = [$country->id, $country->country, '<nobr>' . $btnDelete . '</nobr>'];
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

        <x-adminlte-modal id="deleteModal" title="Delete country">
            Do You really want to delete this country?
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
                var route = "{{ route('destroy.country') }}/" + id;
                $("#deleteForm").attr('action', route);
            }
        </script>
    </div>
@stop