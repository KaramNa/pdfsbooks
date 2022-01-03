@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table mb-5">
            <thead>
                <tr>
                    <th>
                        Query
                    </th>
                    <th>
                        Status
                    </th>
                    <th class="text-center">
                        number of searches
                    </th>
                    <th class="text-center">
                        Delete
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queries as $query)
                    <tr class="border-bottom border-dark">
                        <td>{{ $query->query }}</td>
                        <td>{{ $query->result == 1 ? 'Found' : 'Not Found' }}</td>
                        <td class="text-center">{{ $query->num_of_searches }}</td>
                        <td class="text-center">
                            <form action="{{ route('delete.query', $query->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $queries->links() }}
    </div>
@stop
