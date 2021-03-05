@extends('_layouts.base')

@section('content')
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            @foreach($heroItems as $item)
                @include('_partials.index-product-block', ['item' => $item])
            @endforeach
        </div>
    </div>
@endsection
