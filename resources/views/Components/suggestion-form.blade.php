<div>
    <form action="{{ route('books.orders.store') }}" method="POST" class="form">
        @csrf
        <div>
            <label for="book_name"><span class="text-red">*</span> Book name</label>
            <input type="text" class="form-control" name="book_name" value="{{ old('book_name') }}" required>
            @error('book_name')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="book_url"><span class="text-red">*</span> Please search Amazon or Goodreads for the book
                you need, then copy the link and paste it here so we know which the exact book you are looking
                for</label>
            <input type="url" class="form-control" name="book_url" value="{{ old('book_url') }}" required>
            @error('book_url')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="orderer_name"><span class="text-red">*</span> Your name</label>
            <input type="text" class="form-control" name="orderer_name" value="{{ old('orderer_name') }}" required>
            @error('orderer_name')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="orderer_email"><span class="text-red">*</span> Your Email</label>
            <input type="email" class="form-control" name="orderer_email" value="{{ old('orderer_email') }}"
                required>
            @error('orderer_email')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="book_name">Notes</label>
            <textarea name="notes" class="form-control rounded">{{ old('notes') }}</textarea>
        </div>
        <button class="btn btn-primary">Suggest</button>
    </form>
</div>
