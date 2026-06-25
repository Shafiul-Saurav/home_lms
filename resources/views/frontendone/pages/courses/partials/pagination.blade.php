<div class="pagination-area mt-4 d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination mb-0">
            @if($courses->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-arrow-left"></i></span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $courses->previousPageUrl() }}" aria-label="Previous"><i class="fa-solid fa-arrow-left"></i></a></li>
            @endif

            @foreach($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                @if($page == $courses->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            @if($courses->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $courses->nextPageUrl() }}" aria-label="Next"><i class="fa-solid fa-arrow-right"></i></a></li>
            @else
                <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-arrow-right"></i></span></li>
            @endif
        </ul>
    </nav>
</div>
