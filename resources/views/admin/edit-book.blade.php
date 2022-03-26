@extends("adminlte::page")

@section('title', 'Edit Book')

@section('plugins.BsCustomFileInput', true)
@section('plugins.Select2', true)
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 position-relative">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="text-white">{{ session('success') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('update.book', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="my-2">
                        <label for="title">Book title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $book->title) }}">
                        @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">

                        <label for="qoute">Book qoute</label>
                        <input type="text" class="form-control" name="qoute" value="{{ old('qoute', $book->qoute) }}">
                        @error('qoute')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="author">Book author</label>
                        <input type="text" class="form-control" name="author"
                            value="{{ old('author', $book->author) }}">
                        @error('author')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="poster">Book poster</label>
                        <x-adminlte-input-file name="poster" igroup-size="md" placeholder="Choose a file...">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                        <img src="{{ $book->poster }}" alt="" class="mt-2 img-fluid">
                        @error('poster')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="description">Book description</label>
                        <textarea type="text" class="form-control"
                            name="description">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="Category">Book category</label>
                        <x-adminlte-select2 name="category" class="form-control bg-white">
                            @foreach ($categories as $category)
                                <option value="{{ $category['name'] }}"
                                    {{ old('category', $book->category) == $category['name'] ? 'selected' : '' }}>
                                    {{ $category['name'] }}</option>
                            @endforeach
                        </x-adminlte-select2>
                        @error('category')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="tag">Book Tag</label>
                        <x-adminlte-select2 id="tagsSelect" name="tag" class="form-control bg-white">
                            <option value="" selected>Choose tag</option>
                            <option value="NEW">Add new tag</option>
                            @foreach ($tags as $tag)
                                @if ($tag->tag)
                                    <option value="{{ $tag->tag }}"
                                        {{ old('tag', $book->tag) == $tag->tag ? 'selected' : '' }}>
                                        {{ $tag->tag }}
                                    </option>
                                @endif
                            @endforeach
                        </x-adminlte-select2>
                    </div>
                    <div class="my-2">
                        <label for="publisher">Book publisher</label>
                        <input type="text" class="form-control" name="publisher"
                            value="{{ old('publisher', $book->publisher) }}">
                        @error('publisher')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="published">Book published</label>
                        <input type="text" class="form-control" name="published"
                            value="{{ old('published', $book->published) }}">
                        @error('published')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="myw-2">
                        <label for="pages">Book pages</label>
                        <input type="text" class="form-control" name="pages" value="{{ old('pages', $book->pages) }}">
                        @error('pages')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="lanuage">Book language</label>
                        <input type="text" class="form-control" name="language"
                            value="{{ old('language', $book->language) }}">
                        @error('language')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="PDF_size">Book size</label>
                        <input type="text" class="form-control" name="PDF_size"
                            value="{{ old('PDF_size', $book->PDF_size) }}">
                        @error('PDF_size')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="download_link2">Download link</label>
                        <input type="text" class="form-control" name="download_link2"
                            value="{{ old('download_link2', $book->download_link2) }}">
                        @error('download_link2')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="download_link3">Download link2</label>
                        <input type="text" class="form-control" name="download_link3"
                            value="{{ old('download_link3', $book->download_link3) }}">
                        @error('download_link3')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="post_text">Post Text</label>
                        <input type="text" class="form-control" name="post_text"
                            value="{{ old('post_text', $book->post_text) }}">
                        @error('post_text')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="post_link">Post Link</label>
                        <input type="text" class="form-control" name="post_link"
                            value="{{ old('post_link', $book->post_link) }}">
                        @error('post_link')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-2" name="updateForm">Update</button>
                </form>
                @if ($book->draft == 1)
                    <form action="{{ route('publish', $book->id) }}" method="post" class="d-inline position-absolute" style="right: 9px;bottom: 4px;">
                        @csrf
                        <button class="btn btn-primary mt-2" title="Publish" type="submit" name="publishForm">
                            Make it Free</button>
                    </form>
                @else
                    <form action="{{ route('draft', $book->id) }}" method="post" class="d-inline position-absolute" style="right: 9px;bottom: 4px;">
                        @csrf
                        <button class="btn btn-primary mt-2" title="Draft" type="submit" name="draftForm">
                            Make it Paid</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@stop
@section('Myjs')
    <script>
        $(function() {
            $("#tagsSelect").on('select2:close', function() {
                var el = $(this);
                if (el.val() === "NEW") {
                    var newval = prompt("Enter new value: ");
                    if (newval !== null) {
                        el.append('<option>' + newval + '</option>')
                            .val(newval);
                    }
                }
            });
        });
    </script>
@stop
