@extends('admin/layout')
@section('container')
    {{ session('message') }}                          
    <h1 class="mb10">Coupons</h1>
    <a href="{{ url('admin/coupon/manage_coupon') }}">
        <button type="button" class="btn btn-success">
            Add Coupon
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Coupon Code</th>  <!-- Updated from Coupon Name -->
                            <th>Coupon Value</th>
                            <th>Coupon Status</th> 
                            <th>Expire Date</th>  <!-- Added Expire Date header -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>{{ $list->coupon_code }}</td>  <!-- Updated variable name -->
                            <td>{{ $list->value }}</td> 
                            <td>{{ $list->status }}</td>
                            <td>{{ $list->expire_date ? $list->expire_date->format('Y-m-d') : 'N/A' }}</td> <!-- Added Expire Date value -->
                            <td>
                                <a href="{{ url('admin/coupon/delete/') }}/{{ $list->id }}">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a>
                                <a href="{{ url('admin/coupon/manage_coupon/') }}/{{ $list->id }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>                        
@endsection
