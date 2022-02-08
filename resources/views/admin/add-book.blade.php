@extends("adminlte::page")

@section('title', 'Edit Book')

@section('plugins.BsCustomFileInput', true)

@section('plugins.Select2', true)

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-white">{{ session('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="text-white">{{ session('error') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('store.or.fill.book') }}" method="POST" class="border border-dark p-3 rounded">
                    @csrf
                    <label for="url">Book URL</label>
                    <input type="text" name="url" class="form-control">
                    @error('url')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" name="fill" class="btn btn-dark mt-3">Fill</button>

                </form>
                <form action="{{ route('store.or.fill.book') }}" method="POST" enctype="multipart/form-data"
                    class="mt-5">
                    @csrf
                    <div class="my-2">
                        <label for="title">Book title</label>
                        <input type="text" class="form-control" name="title"
                            value="{{ isset($details) ? $details['title'] : old('title') }}">
                        @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="qoute">Book qoute</label>
                        <input type="text" class="form-control" name="qoute"
                            value="{{ isset($details) ? $details['qoute'] : old('qoute') }}">
                        @error('qoute')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="author">Book author</label>
                        <input type="text" class="form-control" name="author"
                            value="{{ isset($details) ? $details['author'] : old('author') }}">
                        @error('author')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="poster">Book poster</label>
                        <input type="hidden" name="image_url"
                            value="{{ isset($details) ? $details['image_url'] : old('image_url') }}">
                        <x-adminlte-input-file name="poster" igroup-size="md" placeholder="Choose a file...">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                        @error('poster')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="description">Book description</label>
                        <textarea type="text" class="form-control"
                            name="description">{{ isset($details) ? $details['description'] : old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="Category">Book category</label>
                        <x-adminlte-select2 name="category" class="form-control bg-white">
                            <option value="" selected>Choose category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['name'] }}"
                                    {{ old('category') == $category['name'] ? 'selected' : '' }}>
                                    {{ $category['name'] }}</option>
                            @endforeach
                        </x-adminlte-select2>
                    </div>

                    <div class="my-2">
                        <label for="publisher">Book publisher</label>
                        <input type="text" class="form-control" name="publisher"
                            value="{{ isset($details) ? $details['publisher'] : old('publisher') }}">
                        @error('publisher')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="published">Book published</label>
                        <input type="text" class="form-control" name="published"
                            value="{{ isset($details) ? $details['published'] : old('published') }}">
                        @error('published')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="myw-2">
                        <label for="pages">Book pages</label>
                        <input type="text" class="form-control" name="pages"
                            value="{{ isset($details) ? $details['pages'] : old('pages') }}">
                        @error('pages')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="lanuage">Book language</label>
                        <input type="text" class="form-control" name="language"
                            value="{{ isset($details) ? $details['language'] : old('language') }}">
                        @error('language')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="PDF_size">Book size</label>
                        <input type="text" class="form-control" name="PDF_size"
                            value="{{ isset($details) ? $details['size'] : old('PDF_size') }}">
                        @error('PDF_size')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="download_link2">Download link</label>
                        <input type="text" class="form-control" name="download_link2"
                            value="{{ old('download_link2', $details['link']?? '') }}">
                        @error('download_link2')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="download_link3">Download link 2</label>
                        <input type="text" class="form-control" name="download_link3"
                            value="{{ old('download_link3') }}">
                        @error('download_link3')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2 form-group d-flex align-items-center">
                        <input type="checkbox" id="telegram_notif" name="telegram_notif"
                            {{ old('telegram_notif') ? 'checked' : '' }}>
                        <label for="telegram_notif" class="ml-1 mb-0">Send Telegram Notification</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" name="publish" class="btn btn-primary mt-2">Publish</button>
                        <button type="submit" name="draft" class="btn btn-danger mt-2">Draft</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop
