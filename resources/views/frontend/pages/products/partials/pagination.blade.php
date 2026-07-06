<div class="pagination-area">
    <div aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @if($products->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><i class="fas fa-arrow-left"></i></span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous"><i class="fas fa-arrow-left"></i></a></li>
            @endif

            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                @if($page == $products->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            @if($products->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next"><i class="fas fa-arrow-right"></i></a></li>
            @else
                <li class="page-item disabled"><span class="page-link"><i class="fas fa-arrow-right"></i></span></li>
            @endif
        </ul>
    </div>
</div>
