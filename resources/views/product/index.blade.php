@extends('_layouts.base')

@section('content')
    <div class="single-product-area clearfix">
        <div class="container-fluid">

            {{ Breadcrumbs::render('product', $item) }}

            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($item->images as $image)
                                    <li class="{{ $loop->first ? 'active' : '' }}"
                                        data-target="#product_details_slider"
                                        data-slide-to="{{ $loop->index }}"
                                        style="background-image: url({{ $image->fileUrl }});">
                                    </li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach($item->images as $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <a class="gallery_img" href="{{ $image->fileUrl }}">
                                        <img class="d-block w-100"
                                             src="{{ $image->fileUrl }}"
                                             alt="Slide {{ $loop->index }}">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="single_product_desc">
                        <!-- Product Meta Data -->
                        <div class="product-meta-data">
                            <div class="line"></div>
                            <p class="product-price">{{ $item->price.$item->currency }}</p>
                            <a href="#">
                                <h6>{{ $item->name }}</h6>
                            </a>
                            <!-- Ratings & Review -->
                            <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                <div class="ratings">
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                </div>
                                <div class="review">
                                    <a href="#">@lang('ui.product.write_review')</a>
                                </div>
                            </div>
                            <!-- Avaiable -->
                            @if($item->is_available)
                                <p class="avaibility">
                                    <i class="fa fa-circle in-stock"></i> @lang('ui.product.status.in_stock')
                                </p>
                            @else
                                <p class="avaibility">
                                    <i class="fa fa-circle not-available"></i> @lang('ui.product.status.not_available')
                                </p>
                            @endif
                        </div>

                        <div class="short_overview my-5">
                            <p>{{ $item->description }}</p>
                        </div>

                        <!-- Add to Cart Form -->
                        <div class="cart clearfix">
                            <div class="cart-btn d-flex mb-50">
                                <p>@lang('ui.product.quantity')</p>
                                <div class="quantity">
                                    <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </span>
                                    <input type="number" name="quantity" class="qty-text" id="qty" step="1" min="1" max="{{ $item->amount ?? 9999 }}" value="1">
                                    <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;">
                                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <button type="submit" name="add-to-cart" value="{{ $item->id }}" class="btn secondary mx-1">
                                    <span class="material-icons vertical-bottom">add_shopping_cart</span> Add to cart
                                </button>
                                <a class="btn primary" href="#">Buy now!</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    import Button from "../../../vendor/laravel/jetstream/stubs/inertia/resources/js/Jetstream/Button";
    export default {
        components: {Button}
    }
</script>
