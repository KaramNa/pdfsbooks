@extends("adminlte::page")

@section('title', 'Admins Details')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mb-5">
                <x-adminlte-profile-widget name="Karam Nassar" desc="Administrator" theme="purple"
                    img="https://picsum.photos/id/1/100">
                </x-adminlte-profile-widget>
            </div>
            <div class="col-md-6">
                <x-adminlte-profile-widget name="Elie Hashesho" desc="Administrator" theme="teal"
                    img="https://picsum.photos/id/2/100">
                </x-adminlte-profile-widget>
            </div>
        </div>
    </div>
@stop
