@extends('admin.admin_master')
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>
    <div class="container">

        <div class="card m-auto">
            <div class="col-lg-8">
                <form action="{{route('update.brand',$editbrand->id)}}" method="post">
                    @csrf
                    <div class="form-group">

                        <input type="hidden" value="{{$editbrand->id}}" name="id">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="text" class="form-control" name="brand_name" value="{{$editbrand->brand_name}}">
                        @error('category_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>

        </div>


    </div>


</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
</div>



@endsection