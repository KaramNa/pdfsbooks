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
                            <td class="text-center text-success h3"><i class="fas fa-check"></i></td>
                        @else
                            <td class="text-center">
                                <form action="{{ route('order.done', $suggestion->id) }}" method="POST" class="text-center">
                                    @csrf
                                    <button href="" class="btn btn-primary">Done</button>
                                </form>
                            </td>
                        @endif
                        <td>
                            <div x-data="{ show: false}">
                                <div class="text-center">
                                    <button type="button" class="btn btn-danger" @click="show = true"><i
                                            class="fas fa-trash text-white me-4"></i>Delete</button>
                                </div>
                                <div x-show="show" style="display: none">
                                    <form action="{{ route('delete.order', $suggestion->id) }}" method="POST"
                                        class="text-center">
                                        @csrf
                                        <button type="submit" class="btn btn-danger mt-3 text-start"><i
                                                class="fas fa-trash text-white me-4"></i>Yes</button>
                                        <button type="button" class="btn btn-primary mt-3 text-start" @click="show = false"><i
                                                class="fas fa-trash text-white me-4"></i>No</button>
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
