@extends('admin/layout')
@section('container')
    <h1 class="mb10">Manage Category</h1>
    <a href="{{url('admin/coupon')}}">
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
                                        <form action="{{route('coupon.manage_coupon_process')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="couponName" class="control-label mb-1">Coupon Name</label>
                                                <input id="couponName" value="{{$couponName}}" name="couponName" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                                @error('category_name')
                                                <div class="alert alert-danger" role="alert">
                                                    {{$message}}		
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                      <label for="value" class="control-label mb-1">Value</
                                    label>
                                      <input id="value" value="{{$value}}" name="value" 
                                 type="text" class="form-control" aria-required="true" 
                          aria-invalid="false" required>
                     @error('category_name')
                          <div class="alert alert-danger" role="alert">
                        {{$message}}		
                       </div>
                             @enderror
                      </div> 
 
                <div class="form-group">
                  <label for="status" class="control-label mb-1">Status</
                      label>
                      <label><input type="radio" name="status" value="active" required> Active</label>
                      <label><input type="radio" name="status" value="inactive"> Inactive</label>
                @error('status')
               <div class="alert alert-danger" role="alert">
                  {{$message}}		
                 </div>
                   @enderror
                          </div>                      
                                            <div>
                                             <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Submit
                                                </button>
                                            </div>
                                            <input type="hidden" name="id" value="{{$id}}"/>
                                        </form>
                                    </div>
                                </div>
                            </div>            
                        </div>                        
        </div>
    </div>                        
@endsection
