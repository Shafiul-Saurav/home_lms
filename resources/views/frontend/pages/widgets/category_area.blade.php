<div class="category-area bg-2 py-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s"
                    style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInDown;">
                    <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Category</span>
                    <h2 class="site-title">Let's check our <span class="text-gradient">category</span></h2>
                </div>
            </div>
        </div>
        <div class="category-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
            @foreach($categories as $category)
                <a href="#" class="category-item">
                    <div class="content">
                        <div class="icon">
                            @if($category->file)
                                <img src="{{ asset('uploads/categories/' . $category->file) }}" alt="{{ $category->name }}">
                            @else
                                <img src="{{ asset('assets/frontend/img/icon/development.svg') }}" alt="{{ $category->name }}">
                            @endif
                        </div>
                        <div class="info">
                            <h6>{{ $category->name }}</h6>
                            <p>{{ $category->courses ? $category->courses->count() : 0 }} Courses</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
