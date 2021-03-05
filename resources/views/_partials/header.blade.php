<header class="header-area clearfix">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <!-- Logo -->
    <div class="logo">
        <a href="{{ route('index') }}">
            <img src="{{ asset('images/core-img/logo.png') }}" alt="">
        </a>
    </div>
    <!-- Nav -->
    <nav class="amado-nav">
        <ul>
            <li class="{{ Route::is('index') ? 'active' : '' }}">
                <a href="{{ route('index') }}">@lang('ui.menu.index')</a>
            </li>
            @foreach($menuCategories as $category)
                <li class="{{ \App\Helpers\Utils::isCurrentPath($category) ? 'active' : '' }}">
                    <a href="{{ \App\Helpers\Utils::routeByModel($category) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">
        <a href="#" class="btn amado-btn mb-15">Discount</a>
        <a href="#" class="btn amado-btn active">New this week</a>
    </div>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
        <a href="{{ route('cart') }}" class="cart-nav">
            <span class="material-icons vertical-bottom">shopping_cart</span>
            @lang('ui.menu.cart') (<span id="product-quantity">0</span>)
        </a>
        <a href="{{ route('favorites') }}" class="fav-nav">
            <span class="material-icons vertical-bottom">favorite_border</span>
            @lang('ui.menu.favorite')
        </a>
        <a href="#" class="search-nav">
            <span class="material-icons vertical-bottom">search</span>
            @lang('ui.menu.search')
        </a>
    </div>
    <!-- Social Button -->
    <div class="social-info d-flex justify-content-between">
        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    </div>
</header>
