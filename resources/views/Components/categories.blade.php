@props(['categories', 'currentCategory'])
<div class="category">
    <div x-data="{ show: false }">
        <button class="form-control" @click="show = !show" @click.away="show = false"><span
                class="me-3">{{ isset($currentCategory) ? Str::headline($currentCategory) : 'Categories' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-width="20" height="20">
                <g fill='#000'>
                    <path
                        d="M18.2 7.6c-.4 0-.7.1-.9.4L13 12.6c-.5.5-1.4.5-1.9 0L6.8 8c-.3-.2-.6-.4-1-.4-1.1 0-1.7 1.3-.9 2.1l6.2 6.8c.5.6 1.4.6 1.9 0l6.2-6.8c.6-.8 0-2.1-1-2.1z">
                    </path>
                </g>
            </svg>
        </button>

        <div x-show="show"
            class="bg-dark text-white overflow-auto rounded py-3 text-left m-auto mt-2 position-absolute categories-list"
            style="display: none">
            <a href="{{ route('home') }}">All Categories</a>


            @foreach ($categories as $category)
                <a href="/?category={{ $category->slug }}&{{ http_build_query(request()->except(['category', 'tag', 'page'])) }}"
                    class="d-block py-1 px-3 text-start {{ isset($currentCategory) && $currentCategory === Str::lower($category->name) ? 'active' : '' }}">{{ Str::headline($category->name) }}</a>
            @endforeach
        </div>

    </div>
</div>
