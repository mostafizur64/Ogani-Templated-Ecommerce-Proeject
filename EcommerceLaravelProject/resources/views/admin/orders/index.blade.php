@extends('admin.admin_master')
@section('order') active @endsection
@section('admin_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>
    <!-- <div class="container">
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

    </div> -->
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
                            <th class="wd-15p">Payment type</th>
                            <th class="wd-15p">Total</th>
                            <th class="wd-15p">Subtotal</th>
                            <th class="wd-15p">invoice_no</th>
                            <th class="wd-15p">cupon discount</th>
                            <th class="wd-20p">Created at</th>
                            <th class="wd-20p">Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$i++}}</td>
                            <!-- <td>{{$loop->index+1}}}</td> -->
                            <td>{{$order->payment_type}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->subtotal}}</td>
                            <td>{{$order->invoice_no}}</td>
                            <td>
                                @if($order->cupon_discount == NULL)
                                <span class="btn btn-sm btn-danger">NO</span>
                                @else
                                <span class="btn btn-sm btn-success">Yes</span>
                                @endif

                            </td>

                            <td>{{$order->created_at->diffForHumans()}}</td>
                            <td> <a href="{{route('order.view',$order->id)}}" class="btn  btn btn-info">
                                    <ion-icon name="eye-outline"></ion-icon>
                                </a>
                                <a href="{{route('order.delete',$order->id)}}" class="btn  btn btn-danger">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
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