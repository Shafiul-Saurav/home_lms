<div>
    <!-- Start Check Area -->
    <div class="checks-area ptb-100">
        <div class="container">
            <form wire:submit.prevent="filterRooms" class="check-form">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-sm-6">
                        <div class="check-content">
                            <p>Arrival Date</p>
                            <div class="form-group">
                                <div class="input-group date">
                                    {{-- <i class="flaticon-calendar"></i> --}}
                                    <input type="date" wire:model="checkin_date" class="form-control">
                                    @error('checkin_date') <span class="text-danger">{{ $message }}</span> @enderror
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="check-content">
                            <p>Departure Date</p>
                            <div class="form-group">
                                <div class="input-group date">
                                    {{-- <i class="flaticon-calendar"></i> --}}
                                    <input type="date" wire:model="checkout_date" class="form-control">
                                    @error('checkout_date') <span class="text-danger">{{ $message }}</span> @enderror
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="check-btn check-content mb-0">
                            <button class="default-btn" type="submit">
                                Check Availability
                                <i class="flaticon-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Check Section -->

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
                                    <a href="{{ route('booking', ['id' => $room->id]) }}" class="default-btn">
                                        Book Online
                                        <i class="flaticon-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p>No Rooms Found</p>
                    </div>
                @endforelse
                <div class="col-lg-12">
                    <div class="page-navigation-area">
                        {{ $rooms->links(data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Rooms Area -->
</div>
