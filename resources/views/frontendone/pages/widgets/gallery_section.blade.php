<section class="section-padding gallery-section">
    <div class="container">

        <div class="section-heading">
            <span class="sub-title">
                <i class="fa-regular fa-images"></i>
                Image Gallery
            </span>
            <h2>Training, Workshop & Student Moments</h2>
            <p>
                Explore our class activities, cyber security workshops, mentor sessions and practical lab moments.
            </p>
        </div>

        <div class="row g-4">
            @if($photoGalleries && $photoGalleries->isNotEmpty())
                @php $firstGallery = $photoGalleries->first(); @endphp
                <div class="col-lg-4">
                    <div class="gallery-item large">
                        <img src="{{ asset('uploads/photogalleries/' . $firstGallery->gall_image) }}"
                            alt="{{ $firstGallery->title }}">
                        <div class="gallery-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="gallery-overlay">
                            <div>
                                <h4>{{ $firstGallery->title ?: 'Live Cyber Security Class' }}</h4>
                                <p>{{ $firstGallery->photoCategory?->category_name ?: 'Dhaka training session' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($photoGalleries->count() > 1)
                    <div class="col-lg-8">
                        <div class="row g-4">
                            @foreach($photoGalleries->slice(1) as $gallery)
                                <div class="col-md-6">
                                    <div class="gallery-item">
                                        <img src="{{ asset('uploads/photogalleries/' . $gallery->gall_image) }}"
                                            alt="{{ $gallery->title }}">
                                        <div class="gallery-icon">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                        <div class="gallery-overlay">
                                            <div>
                                                <h4>{{ $gallery->title ?: 'Practical Lab' }}</h4>
                                                <p>{{ $gallery->photoCategory?->category_name ?: 'Hands-on hacking practice' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                {{-- Fallback in case table is empty --}}
                <div class="col-lg-4">
                    <div class="gallery-item large">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80"
                            alt="">
                        <div class="gallery-icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="gallery-overlay">
                            <div>
                                <h4>Live Cyber Security Class</h4>
                                <p>Dhaka training session</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row g-4">

                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80"
                                    alt="">
                                <div class="gallery-icon">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div class="gallery-overlay">
                                    <div>
                                        <h4>Practical Lab</h4>
                                        <p>Hands-on hacking practice</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=700&q=80"
                                    alt="">
                                <div class="gallery-icon">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div class="gallery-overlay">
                                    <div>
                                        <h4>Mentor Support</h4>
                                        <p>One-to-one guidance</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=700&q=80"
                                    alt="">
                                <div class="gallery-icon">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div class="gallery-overlay">
                                    <div>
                                        <h4>Corporate Workshop</h4>
                                        <p>Security awareness training</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="gallery-item">
                                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=700&q=80"
                                    alt="">
                                <div class="gallery-icon">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <div class="gallery-overlay">
                                    <div>
                                        <h4>Cyber Career Session</h4>
                                        <p>Career roadmap program</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>

    </div>
</section>
