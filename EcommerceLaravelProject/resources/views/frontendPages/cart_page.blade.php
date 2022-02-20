@extends('layouts.fontend_master')
@section('content')

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Category</span>
                    </div>
                    @php
                    $categories=App\Models\Category::where('status',1)->latest()->get();
                    @endphp
                    <ul>
                        @foreach($categories as $category)
                        <li><a href="#">{{$category->category_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('fontend')}}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="{{url('/')}}">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">

        @if(session('cupon_cart_insert'))
        <div class="alert alert-success" role="alert">
            {{session('cupon_cart_insert')}}
        </div>
        @endif
        @if(session('cart_quantity_update'))
        <div class="alert alert-info" role="alert">
            {{session('cart_quantity_update')}}
        </div>
        @endif
        @if(session('cupon_cartDewstroy'))
        <div class="alert alert-danger" role="alert">
            {{session('cupon_cartDewstroy')}}
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_cart_info as $cart_info)
                            <tr>

                                <td class="shoping__cart__item">
                                    <img src="{{asset($cart_info->product->image_one)}}" height="100px" ; width="100px" aria-hidden="true">
                                    <h5>{{$cart_info->product->product_name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{$cart_info->price}}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <form action="{{url('/cart/update_quary',$cart_info->id)}}" method="post">
                                        @csrf
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" name="qty" value="{{$cart_info->qty}}">
                                            </div>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="shoping__cart__total">
                                    {{$cart_info->price*$cart_info->qty}}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="{{url('card/quantity/delete',$cart_info->id)}}">
                                        <span class="icon_close"></span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{url('/')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>


                </div>
            </div>
            <div class="col-lg-6">
                @if(Session::has('cupon'))
                @else
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>

                        <form action="{{url('/apply_cuppon')}}" method="post">
                            @csrf
                            <input type="text" name="cupon_name" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>

                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        @if(session::has('cupon'))
                        <li>Subtotal <span>${{$subtotal}}</span></li>
                        <li>Cupon Name <span>{{session()->get('cupon')['cupon_name']}}
                                <a href="{{url('cupon/destroy')}}">
                                    X
                                </a>
                            </span>
                        </li>
                        <li>Discount <span>${{session()->get('cupon')['discount']}}%
                                ({{$discount=$subtotal*session()->get('cupon')['discount']/100}}tk)</span></li>
                        <li>Total <span>${{$subtotal-$discount}}</span></li>
                        @else
                        <li></li>
                        <li>Total <span>${{$subtotal}}</span></li>
                        @endif
                    </ul>
                    <a href="{{url('checkOut')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
@endsection