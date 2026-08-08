@if ($paginator->hasPages())
    <nav aria-label="{{ __('Pagination Navigation') }}">
        <div class="inventory-pagination__list">
            @if ($paginator->onFirstPage())
                <span class="inventory-pagination__control" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <span aria-hidden="true">←</span>
                    <span class="inventory-pagination__label">{{ __('pagination.previous') }}</span>
                </span>
            @else
                <a class="inventory-pagination__control" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}">
                    <span aria-hidden="true">←</span>
                    <span class="inventory-pagination__label">{{ __('pagination.previous') }}</span>
                </a>
            @endif

            <div class="inventory-pagination__pages">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inventory-pagination__ellipsis" aria-hidden="true">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="inventory-pagination__page" aria-current="page">{{ $page }}</span>
                            @else
                                <a class="inventory-pagination__page" href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            @if ($paginator->hasMorePages())
                <a class="inventory-pagination__control" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}">
                    <span class="inventory-pagination__label">{{ __('pagination.next') }}</span>
                    <span aria-hidden="true">→</span>
                </a>
            @else
                <span class="inventory-pagination__control" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span class="inventory-pagination__label">{{ __('pagination.next') }}</span>
                    <span aria-hidden="true">→</span>
                </span>
            @endif
        </div>
    </nav>
@endif
