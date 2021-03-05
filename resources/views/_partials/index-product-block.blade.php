<div class="single-products-catagory clearfix">
    <a href="{{ route('product', ['slug' => $item->slug]) }}">
        <img src="{{ $item->primaryImageUrl }}" alt="">
        <!-- Hover Content -->
        <div class="hover-content">
            <div class="line"></div>
            <p>@lang('ui.product.from') {{ $item->price.$item->currency }}</p>
            <h4>{{ $item->name }}</h4>
        </div>
    </a>
</div>
