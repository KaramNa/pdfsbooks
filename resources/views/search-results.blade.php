@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>
                    Query
                </th>
                <th>
                    Status
                </th>
                <th>
                    Delete
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($queries as $query)
                <tr>
                    <td>{{ $query->query }}</td>
                    <td>{{ $query->result == 1 ? 'Found' : 'Not Found' }}</td>
                    <td>
                        <form action="{{ route('delete.query', $query->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
