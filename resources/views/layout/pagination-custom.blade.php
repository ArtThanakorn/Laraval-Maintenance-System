@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous" tabindex="-1">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            {{-- @dd($paginator->count()) --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    {{ $element }}
                @endif
                @if (is_array($element))
                    @php
                        $totalPages = count($element);
                        $currentPage = $paginator->currentPage();
                        $showFirstEllipsis = $currentPage > 2;
                        $showLastEllipsis = $totalPages - $currentPage > 1;
                        $start = $currentPage - 2;
                        $end = $currentPage + 5;
                    @endphp

                    @if ($showFirstEllipsis)
                        {{-- <span class="text-white">...</span> --}}
                    @endif

                    @for ($i = $start; $i < $end; $i++)
                        @if ($i > 0 && $i <= $totalPages)
                            @if ($i == $currentPage)
                                    <li class="page-item"><a class="page-link text-dark" >{{ $i }}</a></li>
                            @else
                                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endif
                    @endfor

                    @if ($showLastEllipsis)
                    <li class="page-item"><a class="page-link">{{ '...' }}</a></li>
                        
                    @endif
                @endif
            @endforeach
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
@endif
