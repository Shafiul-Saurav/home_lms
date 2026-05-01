<div class="pagination-area">
    <div aria-label="Page navigation">
        <ul class="pagination">
            {{-- Previous Link --}}
            @if($courses->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $courses->previousPageUrl() }}" aria-label="Previous">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
            @endif

            {{-- Page Links --}}
            @foreach($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                @if($page == $courses->currentPage())
                    <li class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Next Link --}}
            @if($courses->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $courses->nextPageUrl() }}" aria-label="Next">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </div>
</div>
