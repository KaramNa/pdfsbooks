@extends("adminlte::page")

@section('title', 'Show All Books')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            @section('content')
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-white">{{ session('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('admin.update.password', auth()->user()) }}" method="post" class="p-5">
                    @csrf
                    <x-adminlte-input name="password" type="password" label="New Password" />
                    <x-adminlte-input name="password_confirmation" type="password" label="Confirm Your New Password" />
                    <x-adminlte-button label="Update" theme="primary" icon="fas fa-key" type="submit" />
                </form>
            </div>
        </div>
    </div>
@stop
