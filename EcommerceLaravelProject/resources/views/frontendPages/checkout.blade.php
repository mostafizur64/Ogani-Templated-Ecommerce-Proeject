@extends('layouts.fontend_master')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('/fontend')}}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form action="{{route('Order.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input type="text" name="shipping_first_name" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text" name="shipping_last_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="shipping_phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="shipping_email" value="{{Auth::user()->email}}">
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address" name="address" class="checkout__input__add">
                        </div>

                        <div class="checkout__input">
                            <p>Country/State<span>*</span></p>
                            <input type="text" name="state">
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input type="text" name="post_code">
                        </div>




                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>
                                @foreach($carts as $cart)
                                <li>{{$cart->product->product_name}} ({{$cart->qty}}) <span>{{$cart->price}}</span></li>
                                @endforeach
                            </ul>
                            @if(Session::has('cupon'))
                            <div class="checkout__order__total">Total <span>${{round($subtotal-$subtotal*session()->get('cupon')['discount']/100)}}</span></div>
                            <input type="hidden" name="discount" value="{{session()->get('cupon')['discount']}}">
                            <input type="hidden" name="subtotal" value="{{$subtotal}}">
                            <input type="hidden" name="total" value="{{($subtotal-$subtotal*session()->get('cupon')['discount']/100)}}">
                            @else
                            <div class="checkout__order__subtotal">Subtotal <span>${{$subtotal}}</span></div>
                            <input type="hidden" name="subtotal" value="{{$subtotal}}">
                            <input type="hidden" name="total" value="{{$subtotal}}">

                            @endif


                            <h5>select payment method</h5>
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    HandCash
                                    <input type="checkbox" id="payment" name="payment_type" value="handcash">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Paypal
                                    <input type="checkbox" id="paypal" name="payment_type" value="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@endsection