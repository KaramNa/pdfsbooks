@extends('layouts.app')

@section('content')
@if (session()->has("status"))
    <div class="text-danger">
        {{ session("status") }}
    </div>
@endif
    <form action="{{ route('publish.drafted.books') }}" method="POST">
        @csrf
        <input type="checkbox" id="selectAll"><span class="fw-bold"> Check all</span>
        <hr class="m-0">
        @foreach ($drafted_books as $drafted_book)
            <div class="border-bottom border-dark py-2">
                <input type="checkbox" name="drafted[]" value="{{ $drafted_book->id }}">
                <a href="/book/{{ $drafted_book->slug }}"><span>{{ $drafted_book->title }}</span></a>
            </div>
        @endforeach
        <button type="submit" class="btn btn-dark mt-4">Publish</button>
    </form>
        {{ $drafted_books->links() }}

    <script>
        $("#selectAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@stop
