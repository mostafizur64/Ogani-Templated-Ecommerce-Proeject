@extends('admin.admin_master')
@section('cupon') active @endsection
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
                    <form action="{{route('cupon.cuponadd')}}" method="post">
                        @csrf
                        @if(session('insertCupon'))
                        <div class="alert alert-success" role="alert">
                            {{session('insertCupon')}}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">Add Cupon</label>
                            <input type="text" class="form-control" name="cupon_name" placeholder="enter cupon name">
                            @error('cupon_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="discount" placeholder="enter cupon discount %">
                            @error('discount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>

            </div>

        </div>

    </div>
    <div class="sl-pagebody">
        <h5> All Cupon list</h5>
        <!-- <div class="sl-page-title">
            
        </div>sl-page-title -->

        <div class="card ">


            <div class="table-wrapper">
                @if(session('delete'))
                <div class="alert alert-danger" role="alert">
                    {{session('delete')}}
                </div>
                @endif
                @if(session('updatecupon'))
                <div class="alert alert-warning" role="alert">
                    {{session('updatecupon')}}
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
                            <th class="wd-15p">Cupon Name</th>
                            <th class="wd-15p">Discount</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-20p">Created at</th>
                            <th class="wd-20p">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($all_cupon as $cupon)
                        <tr>
                            <td>{{$i++}}</td>
                            <!-- <td>{{$loop->index+1}}}</td> -->
                            <td>{{$cupon->cupon_name}}</td>
                            <td>{{$cupon->discount}}%</td>

                            <td>
                                @if($cupon->status==1)
                                <span class="btn btn-sm btn-success">Active</span>
                                @else
                                <span class="btn btn-sm btn-warning">Deactive</span>
                                @endif
                            </td>
                            <td>{{$cupon->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.cupon.edit',$cupon->id)}}" class="btn  btn btn-info">
                                    <ion-icon name="create-outline"></ion-icon>
                                </a>
                                <a href="{{route('admin.cupon.delete',$cupon->id)}}" class="btn  btn btn-danger">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                                @if($cupon->status==1)
                                <a href="{{route('admin.deactive',$cupon->id)}}" class="btn  btn btn-danger">
                                    <ion-icon name="thumbs-down-outline"></ion-icon>
                                </a>
                                @else
                                <a href="{{route('admin.active',$cupon->id)}}" class="btn  btn btn-success">
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