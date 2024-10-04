<section class="our-rooms-area pt-60 pb-100">
    <div class="container">
        <div class="section-title">
            <span>Our Rooms</span>
            <h2>Fascinating rooms & suites</h2>
        </div>
        <div class="tab industries-list-tab">
            <div class="row">
                <div class="col-lg-4">
                    <ul class="tabs">
                        @foreach ($room_types as $room_type)
                        <li class="single-rooms">
                            <img src="{{ asset('uploads/room_types') }}/{{ $room_type->sm_image }}" alt="Image">
                            <div class="room-content">
                                <h3>{{ $room_type->title }}</h3>
                                <span>{{ $room_type->occupancy }}</span>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-lg-8">
                    <div class="tab_content">
                        @foreach ($room_types as $room_type)
                        <div class="tabs_item">
                            <div class="our-rooms-single-img room-bg-1" style="background-image: url('{{ asset('uploads/room_types') }}/{{ $room_type->lg_image }}')">
                            </div>
                            <span class="preview-item">The Preview Of Double Room</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
