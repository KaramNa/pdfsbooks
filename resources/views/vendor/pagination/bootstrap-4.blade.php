@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif


            @if ($paginator->currentPage() > 3)
                <li class="hidden-xs"><a href="{{ $paginator->url(1) }}" class="page-link">1</a></li>
            @endif
            @if ($paginator->currentPage() > 4)
                <li class="page-item disabled hidden-xs"><span class="page-link">...</span></li>
            @endif
            @foreach (range(1, $paginator->lastPage()) as $i)
                @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <li class="disabled hidden-xs"><span class="page-link">...</span></li>
            @endif
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li class="hidden-xs"><a
                        href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">{{ $paginator->lastPage() }}</a></li>
            @endif

            {{-- Pagination Elements --}}
            {{-- @foreach ($elements as $element) --}}
            {{-- "Three Dots" Separator --}}
            {{-- @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif --}}

            {{-- Array Of Links --}}
            {{-- @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach --}}

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
