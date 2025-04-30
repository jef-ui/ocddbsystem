@if ($paginator->hasPages())
    <nav>
        <div class="pagination d-flex justify-content-center" style="gap: 10px;">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <span class="page-item d-flex align-items-center">
                    <a class="page-link nav-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="bi bi-chevron-left"></i> Back
                    </a>
                </span>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <span class="page-item d-flex align-items-center">
                    <a class="page-link nav-btn" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        Next <i class="bi bi-chevron-right"></i>
                    </a>
                </span>
            @endif
        </div>
    </nav>
@endif
