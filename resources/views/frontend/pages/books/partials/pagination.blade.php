<div class="pagination-area">
    <div aria-label="Page navigation">
        <ul class="pagination">
            {{-- Previous Link --}}
            @if($books->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
            @endif

            {{-- Page Links --}}
            @foreach($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                @if($page == $books->currentPage())
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
            @if($books->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
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
