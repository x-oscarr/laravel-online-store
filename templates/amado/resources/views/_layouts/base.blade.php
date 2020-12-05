<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Amado - Furniture Ecommerce Template | Home</title>

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
