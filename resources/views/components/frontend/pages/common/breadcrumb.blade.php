@props(['title', 'breadcrumb', 'bgImage' => 'assets/frontend/img/breadcrumb/01.png'])

<div class="site-breadcrumb" style="background: url({{ asset($bgImage) }})">
    <div class="container">
        <h2 class="breadcrumb-title">{{ $title }}</h2>
        <ul class="breadcrumb-menu">
            @foreach($breadcrumb as $item)
                @if($loop->last)
                    <li class="active">{{ $item['name'] }}</li>
                @else
                    <li><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
</div>