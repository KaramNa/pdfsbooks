@extends('layouts.app')

@section('content')
    @if (session()->has('status'))
        <div class="text-danger">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('publish.drafted.books') }}" method="POST">
        @csrf
        <input type="checkbox" id="selectAll" onclick="toggle(this)"><span class="fw-bold"> Check all</span>
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
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>
@stop
