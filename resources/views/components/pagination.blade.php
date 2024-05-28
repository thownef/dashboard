<div>
    @if ($paginator->hasPages())
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- First Page --}}
            @if ($paginator->currentPage() > 2)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                </li>
            @endif

            {{-- Second Page --}}
            @if ($paginator->currentPage() > 3)
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">
                        <i class="fa-solid fa-ellipsis"></i>
                    </span>
                </li>
            @elseif ($paginator->currentPage() == 3)
                <li class="page-item"><a class="page-link" href="{{ $paginator->url(2) }}">2</a></li>
            @endif

            {{-- Current Page --}}
            <li class="page-item active" aria-current="page"><span class="page-link">{{ $paginator->currentPage() }}</span></li>

            {{-- Second to Last Page --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">
                        <i class="fa-solid fa-ellipsis"></i>
                    </span>
                </li>
            @elseif ($paginator->currentPage() == $paginator->lastPage() - 2)
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage() - 1) }}">{{ $paginator->lastPage() - 1 }}</a></li>
            @endif

            {{-- Last Page --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    @endif
</div>
