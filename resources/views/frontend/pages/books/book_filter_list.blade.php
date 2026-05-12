@if($books->count() > 0)
<div class="row g-4 course-grid-area">
    @foreach($books as $book)
        @include('frontend.pages.books.book_item')
    @endforeach
</div>

<div id="pagination-wrapper">
    @include('frontend.pages.books.partials.pagination')
</div>
@else
<div class="alert alert-info text-center" role="alert">
    <h3>No Books Found</h3>
    <p>Sorry, we couldn't find any books matching your filters. Please try adjusting your search criteria.</p>
</div>
@endif
