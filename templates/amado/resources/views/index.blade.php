@extends('_layouts.base')

@section('content')
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            @foreach(range(1,9) as $item)
                @include('_partials.index-category-block', ['item' => $item])
            @endforeach
        </div>
    </div>
@endsection
