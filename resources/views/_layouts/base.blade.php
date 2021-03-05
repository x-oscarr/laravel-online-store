<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('_partials.metadata')

    <!-- Favicon  -->
    <link rel="icon" href="images/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
    @include('_partials.search')
    <div class="main-content-wrapper d-flex clearfix">
        @include('_partials.mobile-nav')
        @include('_partials.header')

        @yield('content')
    </div>

    @include('_partials.newsletter-area')
    @include('_partials.footer')

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
