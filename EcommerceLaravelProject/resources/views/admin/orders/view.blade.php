done;@extends('admin.admin_master')
@section('order') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>
    <div class="sl-pagebody">
        <h5> View Shipping</h5>
    </div>
    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Shipping Address</h6>
        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="firstname" value="{{$shipping->shipping_first_name}}" placeholder="Enter firstname" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="lastname" value="{{$shipping->shipping_last_name}}" placeholder="Enter lastname" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email" value="{{$shipping->shipping_email}}" placeholder="Enter email address" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email" value="{{$shipping->shipping_phone}}" placeholder="Enter email address" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" value="{{$shipping->state}}" placeholder="Enter address" readonly>
                    </div>
                </div><!-- col-8 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label"> Address: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" value="{{$shipping->address}}" " placeholder=" Enter address" readonly>
                    </div>
                </div><!-- col-8 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label"> Post code: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" value="{{$shipping->post_code}}" placeholder="Enter address" readonly>
                    </div>
                </div><!-- col-8 -->

            </div><!-- row -->


        </div><!-- form-layout -->
    </div><!-- card -->


    <hr>


    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">View Orders </h6>
        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">payment_type: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="firstname" value="{{$ordersTabel->payment_type}}" placeholder="Enter firstname" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Total: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="lastname" value="{{$ordersTabel->total}}" placeholder="Enter lastname" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Subtotal: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email" value="{{$ordersTabel->subtotal}}" placeholder="Enter email address" readonly>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Cupon Discount: <span class="tx-danger">*</span></label>
                        <!-- <input class="form-control" type="text" name="email" value="{{$ordersTabel->cupon_discount}}" placeholder="Enter email address" readonly> -->
                        @if($ordersTabel->cupon_discount == NULL)
                        <span class="btn btn-sm btn-danger">NO</span>
                        @else
                        <span class="btn btn-sm btn-success">{{$ordersTabel->cupon_discount}}</span>
                        @endif
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Invoice No: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" value="{{$ordersTabel->invoice_no}}" placeholder="Enter address" readonly>
                    </div>
                </div><!-- col-8 -->


            </div><!-- row -->


        </div><!-- form-layout -->
    </div><!-- card -->


    <hr>

    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">View Orders </h6>
        <div class="form-layout">
            <div class="table-wrapper">
                <div class="row mg-b-25">
                    <table class="table tabel-bordered">

                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $orders)
                            <tr>

                                <td>
                                    <img src="{{asset($orders->product->image_one)}}" alt="not found" height="40px" width="40px">

                                </td>
                                <br>
                                <td>{{$orders->product->product_name}}</td>
                                <td>{{$orders->product_qty}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div><!-- row -->

            </div>


        </div><!-- form-layout -->
    </div><!-- card -->



    <!-- ########## END: MAIN PANEL ########## -->





    <!-- ########## END: MAIN PANEL ########## -->
</div>



@endsection