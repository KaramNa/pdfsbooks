@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Reported Link
                    </th>
                    <th>
                        email
                    </th>
                    <th>
                        message
                    </th>
                    <th>
                        Delete
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr class="border-bottom border-dark py-2">
                        <td><a href="{{ $report->reported_link }}">visit</a></td>
                        <td>{{ $report->email }}</td>
                        <td>{{ $report->message }}</td>
                        <td>
                            <form action="{{ route('delete.report', $report->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
