@extends('layouts.yellow.master')

@section('title', 'Home')

@section('content')

@include('partials.slides')

<!-- .block-features -->
<div class="block block-features block-features--layout--classic d-none d-md-block">
    <div class="container">
        <div class="block-features__list">
            @if($services = setting('services'))
                @foreach(config('services.services', []) as $num => $icon)
                    <div class="block-features__item">
                        <div class="block-features__icon">
                            <svg width="48px" height="48px">
                                <use xlink:href="{{ asset($icon) }}"></use>
                            </svg>
                        </div>
                        <div class="block-features__content">
                            <div class="block-features__title">{{ $services->$num->title }}</div>
                            <div class="block-features__subtitle">{{ $services->$num->detail }}</div>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <div class="block-features__divider"></div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div><!-- .block-features / end -->
@foreach($sections as $section)
    @php($products = $section->products())
<!-- .block-products-carousel -->
@includeWhen($section->type == 'carousel-grid', 'partials.products.carousel.grid', [
    'title' => $section->title,
    'products' => $products,
    'rows' => optional($section->data)->rows,
    'cols' => optional($section->data)->cols,
])
@includeWhen($section->type == 'pure-grid', 'partials.products.pure-grid', [
    'title' => $section->title,
    'products' => $products,
    'rows' => optional($section->data)->rows,
    'cols' => optional($section->data)->cols,
])
<!-- .block-products-carousel / end -->
@endforeach

@endsection
