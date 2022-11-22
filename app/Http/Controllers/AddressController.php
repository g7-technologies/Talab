<?php

namespace App\Http\Controllers;

use App\Notifications\passwordResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use App\ShopTimings;
use App\User;
use App\Category;
use App\Product;
use App\Customer;
use App\Address;
use App\FavouriteProduct;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function mark_as_default(Request $request)
    {
        $customer = Customer::where('id','=',Auth::guard('customer')->user()->id)->first();
        $customer->default_address = $request->id;

        if($customer->save())
        {
            return redirect('/customer_addresses')->with('success_msg','Address marked as default successfully.');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to add default address. Try Again');
        }
    }

    public function customer_addresses()
    {
        $addresses = Address::where('status','=',1)->where('is_deleted','=',0)->where('customer_id','=',Auth::guard('customer')->user()->id)->get();

        return view('client.customer_addresses',compact('addresses'));
    }

    public function create_new_address()
    {
        return view('client.create_new_address');
    }

    public function add_new_address(Request $request)
    {
        $rules = [
            'city' => 'required',
            'address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $address = Address::create([
            'customer_id' => Auth::guard('customer')->user()->id,
            'city' => $request->city,
            'address' => $request->address,
            'shipping_note' => $request->shipping_note,
            'latitude' => $request->lat,
            'longitude' => $request->long
        ]);


        if($address)
        {
            return redirect('/customer_addresses')->with('success_msg','Address added successfully.');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to add address. Try Again');
        }
    }

    public function delete_address($id)
    {
        $address = Address::where('id','=',$id)->first();

        if($address->customer_id == Auth::guard('customer')->user()->id)
        {
            $address->is_deleted = 1;
            $address->status = 0;

            if($address->save())
            {
                return redirect()->back()->with('success_msg','Address deleted successfully.');
            }
            else
            {
                return redirect()->back()->with('error_msg','Unable to delete address. Try Again');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg','Not Authorized for this action.');
        }    
    }
}