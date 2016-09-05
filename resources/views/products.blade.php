@extends('layout')

@section('content')
    <div class="container">
        <div id="products" class="row list-group">
            @foreach($products as $product)
                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="group list-group-image" src="img/{{ $product->image_url }}" alt="" />
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">
                                {{ $product->name }}}</h4>
                            <p class="group inner list-group-item-text">
{{ $product->description }}}
                            </p>
                            <div class="row pricing-buttons">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">
                                        ${{ $product->price}}</p>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <a href="/cart/add/{{ $product->id }}" data-style="expand-right" class="btn btn-success btn-add-to-cart ladda-button">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
        <div class="row">
            <div class="col-md-1 col-md-offset-9 col-xs-2 col-xs-offset-8">
                <a href="/checkout" class="btn btn-info btn-lg">View Cart</a>
            </div>
        </div>
    </div>

@stop
