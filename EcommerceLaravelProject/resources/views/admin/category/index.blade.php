@extends('admin.admin_master')
@section('category') active @endsection
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
                    <form action="{{route('category.categoryadd')}}" method="post">
                        @csrf
                        @if(session('inserCate'))
                        <div class="alert alert-success" role="alert">
                            {{session('inserCate')}}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Add category</label>
                            <input type="text" class="form-control" name="category_name" placeholder="enter category name">
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
                                @foreach($all_category as $category)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->status}}</td>
                                    <td>{{$category->created_at}}</td>
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
                @if(session('deletecategory'))
                <div class="alert alert-danger" role="alert">
                    {{session('deletecategory')}}
                </div>
                @endif
                @if(session('updatecategory'))
                <div class="alert alert-warning" role="alert">
                    {{session('updatecategory')}}
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
                            <th class="wd-15p">Category Name</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-20p">Created at</th>
                            <th class="wd-20p">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($all_category as $category)
                        <tr>
                            <td>{{$i++}}</td>
                            <!-- <td>{{$loop->index+1}}}</td> -->
                            <td>{{$category->category_name}}</td>
                            <td>
                                @if($category->status==1)
                                <span class="btn btn-sm btn-success">Active</span>
                                @else
                                <span class="btn btn-sm btn-warning">Deactive</span>
                                @endif
                            </td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-sm btn btn-info">Edit</a>
                                <a href="{{route('admin.category.delete',$category->id)}}" class="btn btn-sm btn btn-danger">Delete</a>
                                @if($category->status==1)
                                <a href="{{route('admin.category.deactive',$category->id)}}" class="btn btn-sm btn btn-danger">Deactive</a>
                                @else
                                <a href="{{route('admin.category.active',$category->id)}}" class="btn btn-sm btn btn-success">Active</a>
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