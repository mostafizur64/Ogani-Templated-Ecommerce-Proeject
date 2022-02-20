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
                    <h2>My Orders Details</h2>
                    <div class="breadcrumb__option">
                        <a href="{{url('/')}}">Home</a>
                        <span>My Orders Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                @include('frontendPages.profile.inc.profilesidebar')

            </div>
            <div class="col-sm-8 mt-5">

                <div class="card">
                    <h5 class="text-center">Order details</h5>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Invoice No</th>
                                    <th>Payment Type</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                    <th>Created at</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                ?>
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$ordersTabel->invoice_no}}</td>
                                    <td>{{$ordersTabel->payment_type}}</td>
                                    <td>{{$ordersTabel->subtotal}}</td>
                                    <td>{{$ordersTabel->total}}</td>
                                    <td>{{$ordersTabel->created_at->format('D-M-Y')}}</td>



                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-sm-12 mt-5">
            <div class="card">
                <h5 class="text-center">Shipping details</h5>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Shipping FName</th>
                                <th>Shipping LName</th>
                                <th>Shipping Email</th>
                                <th>Shipping Phone</th>
                                <th>Shipping State</th>
                                <th>Shipping Address</th>
                                <th>Shipping Post Code</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            <tr>
                                <td>{{$i++}}</td>

                                <td>{{$shipping->shipping_first_name}}</td>
                                <td>{{$shipping->shipping_last_name}}</td>
                                <td>{{$shipping->shipping_email}}</td>
                                <td>{{$shipping->shipping_phone}}</td>
                                <td>{{$shipping->state}}</td>
                                <td>{{$shipping->address}}</td>
                                <td>{{$shipping->post_code}}</td>


                            </tr>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mt-5">
            <div class="card">
                <h5 class="text-center">Product details</h5>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product quantity</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $item)
                            <?php
                            $i = 1;
                            ?>
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    <img src="{{asset($item->product->image_one)}}" height="50px" width="50px" alt="">

                                </td>
                                <td>{{$item->product->product_name}}</td>
                                <td>{{$item->product_qty}}</td>


                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

</section>
@endsection