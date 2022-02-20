@extends('admin.admin_master')
@section('product') active show-sub @endsection
@section('manage_product') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>
    <div class="container">
        <div class="">

            <div class="card  mt-4">
                @if(session('delete'))
                <div class="alert alert-danger">
                    {{ session('delete') }}
                </div>
                @endif

                <div class="col-lg-12">
                    <h5>Product list</h5>
                    <div class="table-wrapper">

                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p">image</th>
                                    <th class="wd-15p">Product Name</th>
                                    <th class="wd-15p">Product quantity</th>
                                    <th class="wd-20p">category</th>
                                    <th class="wd-20p">status</th>
                                    <th class="wd-20p">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($all_product as $product)
                                <tr>
                                    <td>
                                        <img src="{{asset($product->image_one)}}" height="50px" width="50px" alt="">
                                    </td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_quantity}}</td>
                                    <td>{{$product->category->category_name}}</td>

                                    <td>
                                        @if($product->status==1)
                                        <span class="btn btn-sm btn-success">Active</span>
                                        @else
                                        <span class="btn btn-sm btn-warning">Deactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('product.edit',$product->id)}}" class="btn btn-sm  btn btn-info">
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                        <a href="{{route('product.delete',$product->id)}}" class="btn btn-sm  btn btn-danger">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </a>
                                        @if($product->status==1)
                                        <a href="{{route('product.deactive',$product->id)}}" class="btn btn-sm  btn btn-danger">
                                            <ion-icon name="thumbs-down-outline"></ion-icon>
                                        </a>
                                        @else
                                        <a href="{{route('product.active',$product->id)}}" class="btn  btn-sm btn btn-success">
                                            <ion-icon name="thumbs-up-outline"></ion-icon>
                                        </a>

                                        @endif

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                </div>

            </div>

        </div>

    </div>






</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
</div>



@endsection