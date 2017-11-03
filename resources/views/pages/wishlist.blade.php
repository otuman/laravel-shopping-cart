@extends('layouts.master')

@section('content')
    <nav >
      <div class="nav-wrapper teal lighten-2 ">
        <div class="container">
            <div class="row">
              <div class="col s12">
                <a href="{{ url('/') }}" class="breadcrumb">Home</a>
                <a href="{{ url('shop') }}" class="breadcrumb">Shop</a>
                <a href="{{ url('wishlist') }}" class="breadcrumb">Wishlist</a>
              </div>
            </div>
        </div>
    </div>
    </nav>
    <div class="container">
        <h1>Your Wishlist</h1>
        <hr>
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        @if (sizeof(Cart::instance('wishlist')->content()) > 0)

            <table class="table">
                <thead>
                    <tr>
                        <th class="table-image"></th>
                        <th>Product</th>

                        <th>Price</th>
                        <th class="column-spacer"></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (Cart::instance('wishlist')->content() as $item)
                    <tr>
                        <td class="table-image"><a href="{{ url('shop', [$item->model->slug]) }}"><img src="{{ asset('storage/products/' . $item->model->image) }}" alt="product" class="img-responsive cart-image"></a></td>
                        <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a></td>

                        <td>${{ $item->subtotal }}</td>
                        <td class=""></td>
                        <td>
                            <form action="{{ url('wishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger btn-sm" value="Remove">
                            </form>

                            <form action="{{ url('switchToCart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="submit" class="btn btn-success btn-sm" value="To Cart">
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="spacer"></div>

            <a href="/shop" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;

            <div style="float:right">
                <form action="{{ url('/emptyWishlist') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger btn-lg" value="Empty Wishlist">
                </form>
            </div>

        @else

            <h3>You have no items in your Wishlist</h3>
            <a href="{{url('shop')}}" class="btn btn-primary btn-lg">Continue Shopping</a>

        @endif

        <div class="spacer"></div>

    </div> <!-- end container -->

@endsection
