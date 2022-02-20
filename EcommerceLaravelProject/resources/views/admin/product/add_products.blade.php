@extends('admin.admin_master')
@section('product') active show-sub @endsection
@section('add_product') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Admin</a>
        <span class="breadcrumb-item active">Add Product</span>
    </nav>
    <div class="sl-pagebody">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="row row-sm">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Add new Product</h6>
                <form action="{{route('store.product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_name" value="{{old('product_name')}}" placeholder="Enter Product here">
                                    @error('product_name')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="product_code" value="{{old('product_code')}}" placeholder="Enter product_code">
                                    @error('product_code')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Price: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="price" value="{{old('price')}}" placeholder="Enter product price">
                                    @error('price')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="interger" name="product_quantity" value="{{old('product_quantity')}}" placeholder="Enter product quantity">
                                    @error('product_quantity')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category Name: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name='category_id' data-placeholder="Choose country">
                                        <option label="Choose category"></option>
                                        @foreach($all_category as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Brand Name: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name='brand_id' data-placeholder="Choose country">
                                        <option label="Choose brand"></option>
                                        @foreach($all_brand as $brand)
                                        <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Short Description: <span class="tx-danger">*</span></label>
                                    <textarea name="short_description" id="summernote"></textarea>
                                    @error('short_description')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Long Description: <span class="tx-danger">*</span></label>
                                    <textarea name="long_description" id="summernote2"></textarea>
                                    @error('long_description')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Image One: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="file" name="image_one">
                                    @error('image_one')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="file" name="image_two">
                                    @error('image_two')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-8 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="file" name="image_three">
                                    @error('image_three')
                                    <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5">Submit Form</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>

            </div><!-- card -->

        </div>
    </div>





</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->




@endsection