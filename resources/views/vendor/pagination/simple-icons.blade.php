@if ($paginator->hasPages())
    <nav>
        <div class="pagination d-flex justify-content-center" style="gap: 10px;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="page-item disabled d-flex align-items-center" style="gap: 5px;">
                    <i class="bi bi-chevron-left"></i> Back
                </span>
            @else
                <span class="page-item d-flex align-items-center">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" style="gap: 5px;">
                        <i class="bi bi-chevron-left"></i> Back
                    </a>
                </span>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <span class="page-item d-flex align-items-center">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" style="gap: 5px;">
                        Next <i class="bi bi-chevron-right"></i>
                    </a>
                </span>
            @else
                <span class="page-item disabled d-flex align-items-center" style="gap: 5px;">
                    Next <i class="bi bi-chevron-right"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
