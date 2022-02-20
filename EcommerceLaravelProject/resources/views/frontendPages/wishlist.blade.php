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

        @if(session('wishlistDelete'))
        <div class="alert alert-danger" role="alert">
            {{session('wishlistDelete')}}
        </div>
        @endif
        @if(session('cart_quantity_update'))
        <div class="alert alert-info" role="alert">
            {{session('cart_quantity_update')}}
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
                                <th>Cart</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wishlistItem as $wishlistData)
                            <tr>

                                <td class="shoping__cart__item">
                                    <img src="{{asset($wishlistData->product->image_one)}}" height="100px" width="100px" aria-hidden="true">
                                    <h5>{{$wishlistData->product->product_name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    ${{$wishlistData->product->price}}
                                </td>
                                <td>
                                    <form action="{{url('add_to_cart',$wishlistData->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="price" value="{{$wishlistData->product->price}}">
                                        <button type="submut" class="btn btn-sm btn-danger"> Add To Cart</button>
                                    </form>
                                </td>


                                <td class="shoping__cart__item__close">
                                    <a href="{{url('card/wishlist/delete',$wishlistData->id)}}">
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

    </div>
</section>
<!-- Shoping Cart Section End -->
@endsection