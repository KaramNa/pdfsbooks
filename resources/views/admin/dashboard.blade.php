@extends("adminlte::page")

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row py-5">
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 text-uppercase">
                <x-adminlte-small-box title="Admins" text="2" icon="fas fa-user" theme="teal" url="{{ route('admins.details') }}"
                    url-text="View details" />

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 text-uppercase">
                <x-adminlte-small-box title="Total Books" text="{{ count($books) }}" icon="fas fa-medal" theme="purple" url="{{ route('all.books') }}"
                    url-text="View details" />

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 text-uppercase">
                <x-adminlte-small-box title="Free Books" text="{{ count($books->where('draft', 0)) }}" icon="fas fa-upload" theme="info" url="{{ route('published.books') }}"
                    url-text="View details" />

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 text-uppercase">
                <x-adminlte-small-box title="Paid Books" text="{{ count($books->where('draft', 1)) }}" icon="fas fa-eye-slash" theme="primary" url="{{ route('drafted.books') }}"
                    url-text="View details" />

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 text-uppercase">
                <x-adminlte-small-box title="Links Reports" text="{{ count($reports) }}" icon="fas fa-dollar-sign" theme="danger" url="{{ route('reported.links') }}"
                    url-text="View details" />

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 text-uppercase">
                <x-adminlte-small-box title="Books Orders" text="{{ count($orders) }}" icon="fas fa-shopping-cart" theme="warning" url="{{ route('books.orders') }}"
                    url-text="View details" />

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 text-uppercase">
                <x-adminlte-small-box title="Comments" text="{{ count($comments) }}" icon="fas fa-comments" theme="secondary" url="{{ route('all.comments') }}"
                    url-text="View details" />
            </div>
            {{-- <div class="col-lg-3 col-md-4 col-sm-6 col-12 text-uppercase">
                <x-adminlte-small-box title="Total Downloads" text="2" icon="fas fa-download" theme="secondary" url="#"
                    url-text="View details" />
            </div> --}}
        </div>
    </div>

@stop
