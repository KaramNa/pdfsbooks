<form action="{{ route('home') }}" method="get" role="search" class="search-form">
    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
        <div class="flex">
            <input class="search-input" name="search" autocomplete="off" placeholder="Search By Title or Author"
                type="search" value="{{ request('search') }}" required><button aria-label="submit"
                class="search-button" type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill='#FFFFFF'>
                        <path
                            d="M22.1 20.1l-4.8-4.8C18.4 13.8 19 12 19 10c0-5-4-9-9-9s-9 4-9 9 4 9 9 9c2 0 3.8-.6 5.3-1.7l4.8 4.8c.6.6 1.4.6 2 0 .5-.6.5-1.5 0-2zM10 16.5c-3.6 0-6.5-2.9-6.5-6.5S6.4 3.5 10 3.5s6.5 2.9 6.5 6.5-2.9 6.5-6.5 6.5z">
                        </path>
                    </g>
                </svg></button>
        </div>
        <div class="flex">
            <div>
                <input id="exact_search" type="checkbox" name="exact_search"
                    {{ request('exact_search') == 'on' ? 'checked' : '' }}>
                <label for="exact_search"><strong>Exact Search</strong></label>
            </div>
            <div>
                <input id="free_books" type="checkbox" name="free_books"
                    {{ request('free_books') == 'on' ? 'checked' : '' }}>
                <label for="free_books"><strong>Free Books</strong></label>
            </div>
        </div>
</form>
