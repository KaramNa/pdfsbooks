@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Book URL</th>
                    <th>Orderer Name</th>
                    <th>Orderer Email</th>
                    <th>Notes</th>
                    <th class="text-center">Done</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $suggestion)
                    <tr>
                        <td>{{ $suggestion->book_name }}</td>
                        <td class="book-url"><a href="{{ $suggestion->book_url }}" target="_blank">Visit</a></td>
                        <td>{{ $suggestion->orderer_name }}</td>
                        <td>{{ $suggestion->orderer_email }}</td>
                        <td>{{ $suggestion->notes }}</td>
                        @if ($suggestion->status == 1)
                            <td class="text-center text-success h3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30"><g fill='#2D7646'><path d="M22.5 4.5c-.8-.8-2.2-.8-3 0L9 15l-4.5-4.5c-.8-.8-2.2-.8-3 0s-.8 2.2 0 3L9 21 22.5 7.5c.8-.8.8-2.2 0-3z"></path></g></svg></td>
                        @else
                            <td class="text-center">
                                <form action="{{ route('order.done', $suggestion->id) }}" method="POST"
                                    class="text-center">
                                    @csrf
                                    <button href="" class="btn btn-primary">Done</button>
                                </form>
                            </td>
                        @endif
                        <td>
                            <div x-data="{ show: false}">
                                <div class="text-center">
                                    <button type="button" class="btn btn-danger" @click="show = true"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25">
                                            <g fill='#ffffff'>
                                                <path
                                                    d="M16 5s-1-2-4-2-4 2-4 2H5l.4 2h13.3l.3-2h-3zM9.4 5S10 4 12 4s2.6 1 2.6 1H9.4zM8 21h8l2.4-13H5.6z">
                                                </path>
                                            </g>
                                        </svg></button>
                                </div>
                                <div x-show="show" style="display: none">
                                    <form action="{{ route('delete.order', $suggestion->id) }}" method="POST"
                                        class="text-center">
                                        @csrf
                                        <button type="submit" class="btn btn-danger mt-3 text-start"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><g fill='#ffffff'><path d="M22.5 4.5c-.8-.8-2.2-.8-3 0L9 15l-4.5-4.5c-.8-.8-2.2-.8-3 0s-.8 2.2 0 3L9 21 22.5 7.5c.8-.8.8-2.2 0-3z"></path></g></svg></button>
                                        <button type="button" class="btn btn-primary mt-3 text-start"
                                            @click="show = false"><span class="fw-bold">X</span></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop
