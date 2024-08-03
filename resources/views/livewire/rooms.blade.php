<div>
    <!-- Start Rooms Area -->
<section class="our-rooms-area ptb-100">
    <div class="container">
        <div class="section-title">
            <span>Our Rooms</span>
            <h2>Fascinating rooms & suites</h2>
        </div>
        <div class="row">
            @forelse ($rooms as $room)
            <div class="col-lg-4 col-sm-6">
                <div class="single-rooms-three-wrap">
                    <div class="single-rooms-three">
                        <a href="{{ route('room.details', ['id' => $room->id]) }}">
                            <img src="{{ asset('uploads/rooms') }}/{{ $room->image }}" alt="Image"></a>
                        <div class="single-rooms-three-content">
                            <h3>{{ $room->title }}</h3>
                            <ul class="rating">
                                <li>
                                    <i class="bx bxs-star"></i>
                                </li>
                                <li>
                                    <i class="bx bxs-star"></i>
                                </li>
                                <li>
                                    <i class="bx bxs-star"></i>
                                </li>
                                <li>
                                    <i class="bx bxs-star"></i>
                                </li>
                                <li>
                                    <i class="bx bxs-star"></i>
                                </li>
                            </ul>
                            <span class="price">From ${{ $room->price }}/night</span>
                            <a href="book-table.html" class="default-btn">
                                Book Online
                                <i class="flaticon-right"></i>
                            </a>
                            {{-- <span class="information" data-toggle="tooltip" data-placement="top" title="Swimming doller dolor sit aet odu tur adiing elitse">
                                <i class='bx bx-info-circle'></i>
                            </span> --}}
                        </div>
                    </div>
                </div>
            </div>
            @empty
                No Rooms Found
            @endforelse
            <div class="col-lg-12">
                <div class="page-navigation-area">
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Rooms Area -->
</div>
