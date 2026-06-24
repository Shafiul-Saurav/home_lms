<section class="brand-section">
    <div class="container">

        <div class="section-heading">
            <span class="sub-title">
                <i class="fa-solid fa-handshake"></i>
                Our Partners
            </span>
            <h2>Trusted By Training Partners</h2>
            <p>Our training and workshop programs are designed for Bangladeshi learners and organizations.</p>
        </div>

        <div class="owl-carousel brand-carousel owl-theme">
            @foreach ($partners as $partner)
                <div class="item">
                    <div class="brand-logo">
                        <img src="{{ asset('uploads/partners/' . $partner->partner_image) }}"
                            alt="{{ $partner->name ?? '' }}">
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
