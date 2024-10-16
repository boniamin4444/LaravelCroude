@extends('admin/layout')
@section('container')
    <h1 class="mb10">Manage Coupon</h1>
    <a href="{{ url('admin/coupon') }}">
        <button type="button" class="btn btn-success">
            Back
        </button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('coupon.manage_coupon_process') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="coupon_code" class="control-label mb-1">Coupon Code</label>
                                    <input id="coupon_code" value="{{ $coupon_code }}" name="coupon_code" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('coupon_code')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}        
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="value" class="control-label mb-1">Value</label>
                                    <input id="value" value="{{ $value }}" name="value" type="number" class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('value')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}        
                                    </div>
                                    @enderror
                                </div> 

                                <div class="form-group">
                                    <label for="status" class="control-label mb-1">Status</label>
                                    <label><input type="radio" name="status" value="active" {{ $status == 'active' ? 'checked' : '' }} required> Active</label>
                                    <label><input type="radio" name="status" value="inactive" {{ $status == 'inactive' ? 'checked' : '' }}> Inactive</label>
                                    @error('status')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}        
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="expire_date" class="control-label mb-1">Expire Date</label>
                                    <input id="expire_date" value="{{ $expire_date ? $expire_date->format('Y-m-d') : '' }}" name="expire_date" type="date" class="form-control" aria-required="false" aria-invalid="false">
                                    @error('expire_date')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}        
                                    </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                                </div>
                                <input type="hidden" name="id" value="{{ $id }}"/>
                            </form>
                        </div>
                    </div>
                </div>            
            </div>                        
        </div>
    </div>                        
@endsection
