@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-6">
                @if (session('success'))
                    <div class="text-danger">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('add.category') }}" method="POST">
                    @csrf

                    <label for="Category">Category</label>
                    <input type="text" class="form-control" name="category" focus>
                    @error('category')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-2">Add</button>
                </form>

            </div>
        </div>
    </div>
   
@stop
