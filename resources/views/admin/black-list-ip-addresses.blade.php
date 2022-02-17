@extends("adminlte::page")

@section('title', 'black-list-ip-addresses')

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
                <form action="{{ route('block.ipAddress') }}" method="POST">
                    @csrf

                    <label for="ipAddress">IP Address</label>
                    <input type="text" class="form-control" name="ipAddress" focus>
                    @error('ipAddress')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-2" name="blockIpForm">Add</button>
                </form>

            </div>
        </div>
        @php
            $heads = ['id', 'Ip Address', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
            
            $data = [];
            foreach ($ipAddresses as $ipAddress) {
                $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="showDeleteModal(' . $ipAddress->id . ')"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
                $recored = [$ipAddress->id, $ipAddress->ip, '<nobr>' . $btnDelete . '</nobr>'];
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

        <x-adminlte-modal id="deleteModal" title="Delete Category">
            Do You really want to delete this Ip address?
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
                var route = "{{ route('destroy.ipAddress') }}/" + id;
                $("#deleteForm").attr('action', route);
            }
        </script>
    </div>
@stop
