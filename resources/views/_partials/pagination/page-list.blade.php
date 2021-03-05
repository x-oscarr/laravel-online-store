@if ($paginator->hasPages())
    <nav aria-label="navigation">
        <ul class="pagination justify-content-end mt-50">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{--                <li class="page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
                {{--                    <span class="page-link disabled" aria-hidden="true">&lsaquo;</span>--}}
                {{--                </li>--}}
            @else
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->onFirstPage() }}"
                       rel="prev"
                       aria-label="@lang('pagination.previous')">
                        &lsaquo;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item active">
                        <span class="page-link">{{ $page }}.</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                               <span class="page-link">{{ $page }}.</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}.</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->nextPageUrl() }}"
                       rel="next"
                       aria-label="@lang('pagination.next')">
                        &rsaquo;
                    </a>
                </li>
            @else
{{--                <li class="page-item" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                    <span class="page-link disabled" aria-hidden="true">&rsaquo;</span>--}}
{{--                </li>--}}
            @endif
        </ul>
    </nav>
@endif
