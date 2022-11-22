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
use App\Accessory;
use App\ProductRequest;
use App\FavouriteProduct;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AccessoryController extends Controller
{
    
    public function update_vat_submit(Request $request)
    {
        $rules = [
            'vat' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $accessory = Accessory::where('id','=',1)->first();
        $old_value = $accessory->vat;
        $accessory->vat = $request->vat;
        
        if($accessory->save())
        {
            $update_vat = DB::table('shops')->where('vat', '=', $old_value)->update(array('vat' => $request->vat));

            return redirect()->back()->with('success_msg','Updated Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to update. Try Again Later');
        }
    }
    
    public function update_profit_submit(Request $request)
    {
        $rules = [
            'profit' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }
        
        $accessory = Accessory::where('id','=',1)->first();
        $old_value = $accessory->profit;
        $accessory->profit = $request->profit;
        
        if($accessory->save())
        {
            $update_profit = DB::table('shops')->where('profit', '=', $old_value)->update(array('profit' => $request->profit));

            return redirect()->back()->with('success_msg','Updated Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to update. Try Again Later');
        }
    }
    
    public function update_shipping_cost_submit(Request $request)
    {
        $rules = [
            'shipping' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $accessory = Accessory::where('id','=',1)->first();
        $accessory->shipping = $request->shipping;
        
        if($accessory->save())
        {
            return redirect()->back()->with('success_msg','Updated Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to update. Try Again Later');
        }
    }
    
    public function update_vat()
    {
        $accessory = Accessory::where('id','=',1)->first();
        return view('accessory.update_vat',compact('accessory'));
    }
    
    public function update_profit()
    {
        $accessory = Accessory::where('id','=',1)->first();
        return view('accessory.update_profit',compact('accessory'));
    }
    
    public function update_shipping_cost()
    {
        $accessory = Accessory::where('id','=',1)->first();
        return view('accessory.update_shipping_cost',compact('accessory'));
    }
    
    public function goback()
    {
        return redirect()->back();
    }
    
    public function faqs()
    {
        return view('client.faq');
    }

    public function privacy_policy()
    {
        return view('client.privacy_policy');
    }

    public function complains_and_suggestions()
    {
        return view('client.complains_and_suggestions');
    }

    public function send_mail(Request $request)
    {
    	$rules = [
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'message' => 'required',
            'msg_type' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $to = 'info@talab-sa.com';
        $from = $request->email;
        $subject = $request->msg_type.' '.$request->title;
        $message = $request->message;
        $headers = 'From: '. $from . "\r\n" .
        'Reply-To: '.$from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        
        if(mail($to, $subject, $message, $headers))
        {
    	   return redirect()->back()->with('success_msg','Mail sent successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Unable to send mail. Try again later');
        }

    }

    public function view_all_shop_requests()
    {
        $requests = ProductRequest::with(['shop'])->orderBy('id','DESC')->get();

        return view('requests.view_all_shop_requests',compact('requests'));
    }

    public function accept_product_request($id)
    {
        $request = ProductRequest::where('id','=',$id)->first();
        $request->status = 1;
        $shop = Shop::where('id','=',$request->shop_id)->first();
        $shop->no_of_product = $request->no_of_product;

        if($request->save() && $shop->save())
        {
            return redirect()->back()->with('success_msg','Request accepted successfully.');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to accept request. Try Again Later');
        }
    }

    public function delete_product_request($id)
    {
        $request = ProductRequest::where('id','=',$id)->first();
        $request->status = 2;

        if($request->save())
        {
            return redirect()->back()->with('success_msg','Request deleted successfully.');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to delete request. Try Again Later');
        }
    }
}
