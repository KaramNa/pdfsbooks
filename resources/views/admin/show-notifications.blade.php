@extends("adminlte::page")

@section('title', 'Show All Books')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                @foreach ($notifications as $notification)
                    @php
                        $type = $notification->notif_type;
                        $link = $notification->link;
                        $username = $notification->username;
                        if ($type === 'comment') {
                            $color = 'teal';
                            $icon = 'fas fa-comments';
                            $text = $username . ' left a comment';
                        } elseif ($type === 'order') {
                            $color = 'primary';
                            $icon = 'fas fa-shopping-cart';
                            $text = $username . ' ordered a book';
                        } elseif ($type === 'report') {
                            $color = 'danger';
                            $icon = 'fas fa-exclamation-triangle';
                            $text = $username . ' reported a link';
                        }
                    @endphp
                        <x-adminlte-alert theme="{{ route('delete.notif', $notification->id) }}" class="bg-{{ $color }}" icon="{{ $icon }}" title="{{ $type }}" dismissable>
                            <a href="{{ $link }}">
                            {{ $text }}
                        </a>
                        </x-adminlte-alert>
                @endforeach
            </div>
        </div>
    </div>
@stop
