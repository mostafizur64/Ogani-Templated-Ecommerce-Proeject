@extends('admin.admin_master')
@section('brand') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>
    <div class="container">
        <div class="row">
            <div class="card m-auto">
                <div class="col-lg-12">
                    <form action="{{route('brand.brandadd')}}" method="post">
                        @csrf
                        @if(session('inserCate'))
                        <div class="alert alert-success" role="alert">
                            {{session('inserCate')}}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Add Brand</label>
                            <input type="text" class="form-control" name="brand_name" placeholder="enter brand name">
                            @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>

            </div>

        </div>

    </div>
    <!-- <div class="container mt-4">
        <div class="row">
            <div class="card mt-4 m-auto">
                <div class="col-sm-12">
                    <div class="card-header">
                        <h3>All Category Info</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-danger">
                            <thead>
                                <th>sl1</th>
                                <th>category_name</th>
                                <th>status</th>
                                <th>created at</th>
                            </thead>
                            <tbody>
                                @foreach($all_brand as $brand)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$brand->brand_name}}</td>
                                    <td>{{$brand->status}}</td>
                                    <td>{{$brand->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- ########## START: MAIN PANEL ########## -->


    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Data Table</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Basic Responsive DataTable</h6>
            <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</p>

            <div class="table-wrapper">
                @if(session('deletebrand'))
                <div class="alert alert-danger" role="alert">
                    {{session('deletebrand')}}
                </div>
                @endif
                @if(session('updatebrand'))
                <div class="alert alert-warning" role="alert">
                    {{session('updatebrand')}}
                </div>
                @endif
                @if(session('deactive'))
                <div class="alert alert-danger" role="alert">
                    {{session('deactive')}}
                </div>
                @endif
                @if(session('active'))
                <div class="alert alert-warning" role="alert">
                    {{session('active')}}
                </div>
                @endif
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">sl</th>
                            <th class="wd-15p">Brand Name</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-20p">Created at</th>
                            <th class="wd-20p">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($all_brand as $brand)
                        <tr>
                            <td>{{$i++}}</td>
                            <!-- <td>{{$loop->index+1}}}</td> -->
                            <td>{{$brand->brand_name}}</td>
                            <td>
                                @if($brand->status==1)
                                <span class="btn btn-sm btn-success">Active</span>
                                @else
                                <span class="btn btn-sm btn-warning">Deactive</span>
                                @endif
                            </td>
                            <td>{{$brand->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.brand.edit',$brand->id)}}" class="btn  btn btn-info">
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>
                                <a href="{{route('admin.brand.delete',$brand->id)}}" class="btn  btn btn-danger">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                                @if($brand->status==1)
                                <a href="{{route('admin.deactive',$brand->id)}}" class="btn  btn btn-danger">
                                    <ion-icon name="thumbs-down-outline"></ion-icon>
                                </a>
                                @else
                                <a href="{{route('admin.active',$brand->id)}}" class="btn  btn btn-success">
                                    <ion-icon name="thumbs-up-outline"></ion-icon>
                                </a>

                                @endif

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->



    </div><!-- sl-pagebody -->

</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
</div>



@endsection