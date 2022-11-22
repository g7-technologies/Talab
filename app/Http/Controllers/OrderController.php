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
use App\Promotion;
use App\Order;
use App\OrderDetail;
use App\FavouriteProduct;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    public function admin_change_order_status(Request $request)
    {
        $rules = [
            'order_id' => 'required',
            'order_status' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }
        
        $order = Order::where('id','=',$request->order_id)->first();
        
        if($order)
        {
            $order->status = $request->order_status;
            
            if($order->save())
            {
                return redirect()->back()->with('success_msg','Order status changed successfully');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg','No Order Found');
        }
    }
    
    public function create_order(Request $request)
    {
        $rules = [
            'city' => 'required',
            'address' => 'required'
        ];
        
        if($request->shipping_note == '')
        {
            $shipping_note = "Not Provided";
        }
        else
        {
            $shipping_note = "";
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $total = 0;
            foreach($cart_data as $keys => $values)
            {

                $product = Product::where('id','=',$cart_data[$keys]["item_id"])->first();

                if($product->status == 1 && $product->is_deleted == 0)
                {
                    if($product->stock >= $cart_data[$keys]["item_quantity"])
                    {
                        if($product->discount_percentage != 0)
                        {
                            $total = $total+(($product->price*$cart_data[$keys]["item_quantity"]*$product->discount_percentage)/100);
                        }
                        else
                        {
                            $total = $total+($product->price*$cart_data[$keys]["item_quantity"]);
                        }
                    }
                    else
                    {
                        return redirect()->back()->with('error_msg','Sorry '.$product->name.' is '.$product->stock.' pieces left. Your ordered amount can not be fullfilled.');
                    }
                }
            }
            
            $accessory = Accessory::where('id','=',1)->first();
            
            $order = Order::create([
                'order_id' => uniqid(),
                'transaction_id' => 'NA',
                'customer_id' => 0,
                'first_name' => Auth::guard('customer')->user()->first_name,
                'last_name' => Auth::guard('customer')->user()->last_name,
                'email' => Auth::guard('customer')->user()->email,
                'phone' => Auth::guard('customer')->user()->number,
                'city' => $request->city,
                'address' => $request->address,
                'shipping_note' => $shipping_note,
                'shipping_cost' => $accessory->shipping,
                'sub_total' => $total,
                'discount' => 0,
                'grand_total' => $total
            ]);
            
            if(Cookie::get('coupon_code'))
            {
                $cookie_data = stripslashes(Cookie::get('coupon_code'));
                $coupon_data = json_decode($cookie_data, true);
                if(count($coupon_data))
                {
                    if($coupon_data[0]['promotion_type'] == 1)
                    {
                        $order->discount = $total*($coupon_data[0]['discount']/100);
                        $total = $total-(($total)*($coupon_data[0]['discount']/100))+$accessory->shipping;
                        $order->grand_total = $total;
                        $order->save();
                    }
                    else
                    {
                        $order->discount = 0;
                        $total = $total+(($accessory->shipping)*((100-$coupon_data[0]['discount'])/100));
                        $order->shipping_cost = (($accessory->shipping)*((100-$coupon_data[0]['discount'])/100));
                        $order->grand_total = $total;
                        $order->save();
                    }
                }
            }

            if(Auth::guard('customer')->check())
            {
                $order->customer_id = Auth::guard('customer')->user()->id;
                $order->save();
            }

            foreach($cart_data as $keys => $values)
            {
                $product = Product::where('id','=',$cart_data[$keys]["item_id"])->first();
                $category = Category::where('id','=',$product->category_id)->first();

                $order_details = OrderDetail::create([
                    'order_id' => $order->id,
                    'shop_id' => $category->shop_id,
                    'product_id' => $product->id,
                    'quantity' => $cart_data[$keys]["item_quantity"],
                    'price' => $product->price,
                    'profit' => $cart_data[$keys]["item_profit"],
                    'discount_percentage' => $product->discount_percentage
                ]);

                if($order_details)
                {
                    $product->stock = ($product->stock)-($cart_data[$keys]["item_quantity"]);
                    $product->save();
                }
            }

            Cookie::queue(Cookie::forget('shopping_cart'));

            return redirect('/')->with('success_msg_order_confirmed','Order Placed Successfully. Your Order Number is #'.$order->order_id);

        }
        else
        {
            return redirect()->back()->with('error_msg','Cant get the cart item. Try Again');
        }
    }

    public function shop_orders()
    {
        $incompleted = OrderDetail::with(['order'])->where('shop_id','=', Auth::guard('shop')->user()->id)->orderBy('id', 'DESC')->get();
        $result = [];
        if(count($incompleted) != 0)
        {
            $result = [];
            $check = $incompleted[0]->order_id;
            $grand_total = 0;
            $order_data = Order::where('id','=', $check)->first();
            $temp = [];
            $count = 0;
            foreach($incompleted as $data)
            {   
                $count = $count +1;
                if($data->order_id == $check)
                {
                    if($data->discount_percentage == 0)
                    {
                        $grand_total = $grand_total+($data->price*$data->quantity);
                    }
                    else
                    {
                        $grand_total = $grand_total+((($data->price*$data->quantity)*$data->discount_percentage)/100);
                    }
                    array_push($temp,$data);
                }
                else
                {
                    $raw_orders = ['id'=>$order_data->id,'order_id'=>$order_data->order_id,'transaction_id'=>$order_data->transaction_id,'customer_id'=>$order_data->customer_id,'first_name'=>$order_data->first_name,'last_name'=>$order_data->last_name,'email'=>$order_data->email,'phone'=>$order_data->phone,'city'=>$order_data->city,'address'=>$order_data->address,'shipping_note'=>$order_data->shipping_note,'shipping_cost'=>$order_data->shipping_cost,'sub_total'=>$order_data->sub_total,'discount'=>$order_data->discount,'grand_total'=>$grand_total,'status'=>$order_data->status,'created_at'=>$order_data->created_at,'updated_at'=>$order_data->updated_at,'order_details'=>$temp];

                    array_push($result,$raw_orders);
                    $check = $data->order_id;
                    $order_data = Order::where('id','=', $check)->first();
                    $temp = [];
                    array_push($temp,$data);
                }

                if($count == count($incompleted))
                {
                    $raw_orders = ['id'=>$order_data->id,'order_id'=>$order_data->order_id,'transaction_id'=>$order_data->transaction_id,'customer_id'=>$order_data->customer_id,'first_name'=>$order_data->first_name,'last_name'=>$order_data->last_name,'email'=>$order_data->email,'phone'=>$order_data->phone,'city'=>$order_data->city,'address'=>$order_data->address,'shipping_note'=>$order_data->shipping_note,'shipping_cost'=>$order_data->shipping_cost,'sub_total'=>$order_data->sub_total,'discount'=>$order_data->discount,'grand_total'=>$grand_total,'status'=>$order_data->status,'created_at'=>$order_data->created_at,'updated_at'=>$order_data->updated_at,'order_details'=>$temp];
                    
                    array_push($result,$raw_orders);
                }
            }
        }
        $result = array_reverse($result);
        return view('trader.shop_orders',compact('result'));
    }

    public function customer_orders()
    {
        $incompleted_order = Order::with(['order_details'])->where('status','!=', 4)->orderBy('id', 'DESC')->get();

        $completed_order = Order::with(['order_details'])->where('status','=', 4)->orderBy('id', 'DESC')->get();

        return view('client.orders',compact('incompleted_order','completed_order'));
    }

    public function cancel_order($id)
    {
        $order = Order::where('id','=', $id)->first();

        if($order->customer_id == Auth::guard('customer')->user()->id)
        {
            $order->status = 2;

            if($order->save())
            {
                return redirect()->back()->with('success_msg','Order Cancelled Successfully.');
            }
            else
            {
                return redirect()->back()->with('error_msg','Unable to cancel order. Try Again Later');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg','You are not authorized for this action.');
        }
    }

    public function shop_cancel_order($id)
    {
        $order = Order::where('id','=', $id)->first();

        $order->status = 2;

        if($order->save())
        {
            return redirect()->back()->with('success_msg','Order Cancelled Successfully.');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to cancel order. Try Again Later');
        }
    }

    public function accept_order($id)
    {
        $order = Order::where('id','=',$id)->first();

        if($order->status == 1)
        {
            return redirect()->back()->with('success_msg','Order status changed successfully');
        }
        else
        {
            $order->status = 1;

            if($order->save())
            {
                return redirect()->back()->with('success_msg','Order status changed successfully');
            }
            else
            {
                return redirect()->back()->with('error_msg','Unable to change order status. Try Again');   
            }
        }
    }
    public function ship_order($id)
    {
        $order = Order::where('id','=',$id)->first();

        if($order->status == 3)
        {
            return redirect()->back()->with('success_msg','Order status changed successfully');
        }
        else
        {
            $order->status = 3;

            if($order->save())
            {
                return redirect()->back()->with('success_msg','Order status changed successfully');
            }
            else
            {
                return redirect()->back()->with('error_msg','Unable to change order status. Try Again');   
            }
        }
    }
    public function mark_as_delivered($id)
    {
        $order = Order::where('id','=',$id)->first();

        if($order->status == 4)
        {
            return redirect()->back()->with('success_msg','Order status changed successfully');
        }
        else
        {
            $order->status = 4;

            if($order->save())
            {
                return redirect()->back()->with('success_msg','Order status changed successfully');
            }
            else
            {
                return redirect()->back()->with('error_msg','Unable to change order status. Try Again');   
            }
        }
    }

    public function view_all_orders()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('order.view_all_orders',compact('orders'));
    }

    public function order_detail($id)
    {
        $order = Order::with(['order_details'])->where('id','=',$id)->first();
        
        return view('order.view_order_detail',compact('order'));
    }
    
    public function apply_coupon(Request $request)
    {
        $rules = [
            'coupon_code' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }
        
        $promo = Promotion::where('status','=',1)->where('is_deleted','=',0)->where('code','=',$request->coupon_code)->where('valid_till','>=',Carbon::today()->toDateString())->first();
        
        if($promo)
        {
            if(Cookie::get('coupon_code'))
            {
                $cookie_data = stripslashes(Cookie::get('coupon_code'));
                $coupon_data = json_decode($cookie_data, true);
            }
            else
            {
                $coupon_data = array();
            }
            
            if(count($coupon_data) == 0)
            {
                $coupon_array = array(
                    'id' => $promo->id, 
                    'code' => $promo->code, 
                    'discount' => $promo->discount, 
                    'by_admin' => $promo->by_admin,
                    'promotion_type' => $promo->promotion_type,
                    'valid_till' => $promo->valid_till, 
                    'status' => $promo->status, 
                    'is_deleted' => $promo->is_deleted, 
                    'created_at' => $promo->created_at, 
                    'updated_at' => $promo->updated_at
                );
                $coupon_data[] = $coupon_array;
                $item_data = json_encode($coupon_data);
                $minutes = 60;
                $result = Cookie::queue(Cookie::make('coupon_code', $item_data, $minutes));
            }
            else
            {
                return redirect()->back()->with('error_msg', 'Coupon Code already Applied');
            }
            
            return redirect()->back()->with('success_msg', 'Coupon Code Applied');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'No Coupon Code Found');
        }
    }
    
    public function remove_coupon()
    {
        Cookie::queue(Cookie::forget('coupon_code'));
        return redirect()->back()->with('success_msg','Coupon removed successfully');
    }
}
