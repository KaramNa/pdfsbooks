@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="text-dark">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Book URL</th>
                    <th>Orderer Name</th>
                    <th>Orderer Email</th>
                    <th>Notes</th>
                    <th class="text-center">Reply</th>
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
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#orderReplyMail{{ $suggestion->id }}">Email</button>
                        </td>
                        @if ($suggestion->status == 1)
                            <td class="text-center text-success h3"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" width="30" height="30">
                                    <g fill='#2D7646'>
                                        <path
                                            d="M22.5 4.5c-.8-.8-2.2-.8-3 0L9 15l-4.5-4.5c-.8-.8-2.2-.8-3 0s-.8 2.2 0 3L9 21 22.5 7.5c.8-.8.8-2.2 0-3z">
                                        </path>
                                    </g>
                                </svg></td>
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
                                        <button type="submit" class="btn btn-danger mt-3 text-start"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                                height="20">
                                                <g fill='#ffffff'>
                                                    <path
                                                        d="M22.5 4.5c-.8-.8-2.2-.8-3 0L9 15l-4.5-4.5c-.8-.8-2.2-.8-3 0s-.8 2.2 0 3L9 21 22.5 7.5c.8-.8.8-2.2 0-3z">
                                                    </path>
                                                </g>
                                            </svg></button>
                                        <button type="button" class="btn btn-primary mt-3 text-start"
                                            @click="show = false"><span class="fw-bold">X</span></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="orderReplyMail{{ $suggestion->id }}" tabindex="-1"
                        aria-labelledby="orderReplyMailLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('order.reply.mail', $suggestion->id) }}" method="post">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderReplyMailLabel">Send Email</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- <div>
                                            <label for="reciever_name" class="h6">Reciver Name:</label>
                                            <input type="email" name="reciever_name" class="form-control">
                                        </div>
                                        <div>
                                            <label for="reciever_email" class="h6">Reciver Email:</label>
                                            <input type="email" name="reciever_email" class="form-control">
                                        </div>
                                        <div>
                                            <label for="email_subject" class="h6">Subject:</label>
                                            <input type="email" name="email_subject" class="form-control">
                                        </div> --}}
                                        <div class="mt-3">
                                            <label for="book_link" class="h6">Book link:</label>
                                            <input type="text" name="book_url" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-primary">Send</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

@stop
