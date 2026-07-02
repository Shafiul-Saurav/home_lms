@props(['title', 'breadcrumb', 'bgImage' => 'assets/frontend/img/breadcrumb/01.png'])

<div class="site-breadcrumb" style="position: relative; background: url({{ asset($bgImage) }}) no-repeat center center / cover;">
    <div style="position: absolute; inset: 0; background: rgba(0, 0, 0, 0.55);"></div>
    <div class="container" style="position: relative; z-index: 1;">
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
