<section class="brand-section" data-aos="fade-up">
    <div class="container">

        <div class="section-heading">
            <span class="sub-title">
                <i class="fa-solid fa-handshake"></i>
                Our Partners
            </span>
            <h2>Our Training & Institutional Partners</h2>
            <p>Our programs are built in partnership with universities, corporate organizations and training institutes committed to advancing cyber security skills.</p>
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
