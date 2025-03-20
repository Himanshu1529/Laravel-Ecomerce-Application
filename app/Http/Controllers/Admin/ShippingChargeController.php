<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingChargeModel;
use Auth;

class ShippingChargeController extends Controller
{
    public function list()
    {
    	$data['getRecord'] = ShippingChargeModel::getRecord();
    	$data['header_title'] = "Shipping Charges";
	    return view('admin.shippingcharge.list',$data);
    }


    public function add()
    {
    	$data['header_title'] = "Add New Shipping Charges";
    	return view('admin.shippingcharge.add',$data);
    }

    public function insert(Request $request)
    {
    	$shippingcharge = new ShippingChargeModel;
    	$shippingcharge->name = trim($request->name);
        $shippingcharge->price = trim($request->price);
        $shippingcharge->status = trim($request->status);
    	$shippingcharge->save();

    	return  redirect('admin/shipping_charge/list')->with('success',"Shipping Charges Successfully Created ");
    }

    public function edit($id)
    {   
        $data['getRecord'] = ShippingChargeModel::getSingle($id);
        $data['header_title'] = "Edit Shipping Charges";
        return view('admin.shippingcharge.edit',$data);
    }

    public function update(Request $request,$id)
    {

    	$shippingcharge = ShippingChargeModel::getSingle($id);
    	$shippingcharge->name = trim($request->name);
        $shippingcharge->price = trim($request->price);
        $shippingcharge->status = trim($request->status);
    	$shippingcharge->save();

    	return  redirect('admin/shipping_charge/list')->with('success',"Shipping Charges Successfully Updated ");
    }

    public function delete($id)
    {
        $shippingcharge = ShippingChargeModel::getSingle($id);
        $shippingcharge->is_delete = 1;
        $shippingcharge->save();
        return  redirect()->back()->with('success',"Shipping Charges Successfully Deleted ");
    }
}
