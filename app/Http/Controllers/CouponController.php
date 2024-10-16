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

    public function manage_coupon(Request $request, $id = '')
    {
        if ($id > 0) {
            $arr = Coupon::where(['id' => $id])->get();
            $result['coupon_code'] = $arr[0]->coupon_code; // Changed to coupon_code
            $result['value'] = $arr[0]->value;
            $result['status'] = $arr[0]->status;
            $result['expire_date'] = $arr[0]->expire_date; // Added expire_date
            $result['id'] = $arr[0]->id;
        } else {
            $result['coupon_code'] = ''; // Changed to coupon_code
            $result['value'] = '';
            $result['status'] = '';
            $result['expire_date'] = ''; // Added expire_date
            $result['id'] = 0;
        }
        return view('admin.manage_coupon', $result); // Ensure the path is correct
    }

    public function manage_coupon_process(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required', // Changed to coupon_code
            'value' => 'required|integer', // Ensure value is an integer
            'status' => 'required',
            'expire_date' => 'nullable|date', // Validate expire_date
        ]);

        if ($request->post('id') > 0) {
            $model = Coupon::find($request->post('id'));
            $msg = "Coupon Updated";
        } else {
            $model = new Coupon();
            $msg = "Coupon Inserted";
        }

        $model->coupon_code = $request->post('coupon_code'); // Changed to coupon_code
        $model->value = $request->post('value');
        $model->status = $request->post('status');
        $model->expire_date = $request->post('expire_date'); // Save expire_date
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
