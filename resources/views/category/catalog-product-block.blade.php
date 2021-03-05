<div class="col-12 col-sm-6 col-md-12 col-xl-6">
    <div class="single-product-wrapper">
        <!-- Product Image -->
        <div class="product-img">
            <img src="{{ $item->primaryImageUrl }}" alt="">
            <!-- Hover Thumb -->
            <img class="hover-img" src="{{ $item->images->get(1)->fileUrl ?? $item->primaryImageUrl }}" alt="">
        </div>

        <!-- Product Description -->
        <div class="product-description d-flex align-items-center justify-content-between">
            <!-- Product Meta Data -->
            <div class="product-meta-data">
                <div class="line"></div>
                <p class="product-price">@lang('ui.product.from') {{ $item->price.$item->currency }}</p>
                <a href="{{ \App\Helpers\Utils::routeByModel($item) }}">
                    <h6>{{ $item->name }}</h6>
                </a>
            </div>
            <!-- Ratings & Cart -->
            <div class="ratings-cart text-right">
                <div class="ratings">
                    <span class="material-icons">star_rate</span>
                    <span class="material-icons">star_rate</span>
                    <span class="material-icons">star_rate</span>
                    <span class="material-icons">star_rate</span>
                    <span class="material-icons">star_rate</span>
                </div>
                <div class="cart">
                    <a href="#" data-toggle="tooltip" data-placement="left" title="@lang('ui.product.add_to_cart')">
                        <img src="{{ asset('images/core-img/cart.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
