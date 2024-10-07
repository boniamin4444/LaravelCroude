<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
    	$result['data'] = Coupon::all();
    	return view('admin.coupon', $result);
    }

    public function manage_coupon(Request $request, $id='')
    {
    	if($id > 0)
    	{
    		$arr = Coupon::where(['id'=>$id])->get();
    		$result['couponName'] = $arr['0']->couponName;
            $result['value'] = $arr['0']->value;
            $result['status'] = $arr['0']->status;
    		$result['id'] = $arr['0']->id;
    	}
    	else
    	{
    		$result['couponName'] = '';
            $result['value'] = '';
            $result['status'] = '';
    		$result['id'] = 0;
    	}
    	return view('admin/manage_coupon', $result);
    }

    public function manage_coupon_process(Request $request)
    {
    	$request->validate([

    		'couponName'=>'required',
            'value'=>'required',
            'status'=>'required',
    	]);

    	if($request->post('id') > 0)
    	{
    		$model = Coupon::find($request->post('id'));
    		$msg = "Coupon Updated";
    	}

    	else
    	{
    		$model = new Coupon();
    		$msg = "Coupon Inserted";
    	}

    	$model->couponName = $request->post('couponName');
        $model->value = $request->post('value');
        $model->status = $request->post('status');
    	$model->save();
    	$request->session()->flash('message', $msg);
    	return redirect('admin/coupon');
    }

    public function delete(Request $request, $id)
    {
    	$model = Coupon::find($id);
    	$model->delete();
    	$request->session()->flash('message', 'Coupon Deleted');
    	return redirect('admin/coupon');
    }
}
