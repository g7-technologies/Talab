<?php

namespace App\Http\Controllers;

use App\Notifications\passwordResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use App\ShopTimings;
use App\User;
use App\Category;
use App\Notification;
use App\Order;
use App\Accessory;
use App\Banner;
use App\OrderDetail;
use App\Product;
use App\ProductRequest;
use App\FavouriteProduct;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{

    public function add_new_shop()
    {
    	return view('shop.add_new_shop');
    }

    public function add_new_shop_submit(Request $request)
    {
        $rules = [
            'img' => 'required',
			'name' => 'required',
			'registration_no' => 'required',
			'trader_name' => 'required',
			'email' => 'required|email|max:50|unique:shops|unique:customers',
			'password' => 'required|min:6|max:30',
            'number' => 'required|max:50|unique:customers|unique:shops|regex:{^05[0-9]{8}$}',
			'city' => 'required',
			'iban' => 'required',
			'minimum_cost_to_delivery' => 'required',
			'no_of_product' => 'required',
			'delivery' => 'required',
            'albalad' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect('/add_new_shop')->with('error_msg', $validator->errors()->first())->withInput();
        }

		$filename = uniqid().$_FILES["img"]["name"]; 
		$tempname = $_FILES["img"]["tmp_name"];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

        if($ext == 'jpg' || $ext == 'JPG' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPEG' || $ext == 'jpeg')
        {
        	move_uploaded_file($tempname, public_path('shop_logo/'.$filename));
        }
        else
        {
        	return redirect('/add_new_shop')->with('error_msg', 'Please Upload a Valid Shop Logo')->withInput();
        }

        $accessory = Accessory::where('id','=',1)->first();

        if($request->always_open != 1)
        {
        	$shop = Shop::create([
                'logo' => $filename,
                'name' => $request->name,
                'registration_no' => $request->registration_no,
                'trader_name' => $request->trader_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'number' => $request->number,
                'city' => $request->city,
                'iban' => $request->iban,
                'minimum_cost_to_delivery' => $request->minimum_cost_to_delivery,
                'no_of_product' => $request->no_of_product,
                'delivery' => $request->delivery,
                'always_open' => 0,
                'verified' => 1,
                'albalad' => $request->albalad,
                'profit' => $accessory->profit
            ]);
        }
        else
        {
            $shop = Shop::create([
                'logo' => $filename,
                'name' => $request->name,
                'registration_no' => $request->registration_no,
                'trader_name' => $request->trader_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'number' => $request->number,
                'city' => $request->city,
                'iban' => $request->iban,
                'vat' => $request->vat,
                'minimum_cost_to_delivery' => $request->minimum_cost_to_delivery,
                'no_of_product' => $request->no_of_product,
                'delivery' => $request->delivery,
                'always_open' => $request->always_open,
                'verified' => 1,
                'albalad' => $request->albalad,
                'profit' => $accessory->profit
            ]);
        }

        if($shop)
    	{
    		return redirect('/view_all_shops');
    	}
    	else
    	{
    		return redirect('/add_new_shop')->with('error_msg', 'Unable To Register Shop..Try Again Later')->withInput();
    	}
    }

    public function view_all_shops()
    {
        $shops = Shop::where('status','=',1)->where('is_deleted','=',0)->where('verified','=',1)->get();
        
        return view('shop.view_all_shops',compact('shops'));
    }

    public function shop_joining_request()
    {
        $shops = Shop::where('status','=',1)->where('is_deleted','=',0)->where('verified','=',0)->get();

        return view('shop.shop_joining_request',compact('shops'));
    }

    public function accept_joinning_request($id)
    {
        $shop = Shop::where('id','=',$id)->first();
        $shop->verified = 1;
        
        if($shop->save())
        {
            return redirect('/shop_joining_request')->with('success_msg', 'Request accepted successfully!');
        }
        else
        {
            return redirect('/shop_joining_request')->with('error_msg', 'Unable to accept the request. Try Again!');
        }
    }

    public function reject_joinning_request($id)
    {
        $shop = Shop::where('id','=',$id)->first();
        $shop->is_deleted = 1;
        $shop->status = 0;

        if($shop->save())
        {
            return redirect('/shop_joining_request')->with('success_msg', 'Request rejected successfully!');
        }
        else
        {
            return redirect('/shop_joining_request')->with('error_msg', 'Unable to reject the request. Try Again!');
        }
    }

    public function view_shop_detail($id)
    {
        $shop = Shop::where('id','=',$id)->first();

        return view('shop.view_shop_detail',compact('shop'));
    }

    public function shop_invitation_link()
    {
        return view('shop.shop_invitation_link');
    }

    public function shop_invitation_link_submit(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:50|unique:shops'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect('/shop_invitation_link')->with('error_msg', $validator->errors()->first());
        }
        
        $link = 'http://www.talab-sa.com/signup_seller';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
        $to = $request->email;
        $from = 'support@talab-sa.com';
        $subject = 'Invitation Link';
        $message = '<p>Hye </br> Kindly click the <a href="'.$link.'">link</a> to signup and become a part of Talab. Signup and start selling.</p>';
        $headers .= 'From: support@talab-sa.com'."\r\n".
        'Reply-To: support@talab-sa.com'. "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);

        return redirect('/shop_invitation_link')->with('success_msg', 'Email Sent successfully');
    }

    public function deactive_shops()
    {
        $shops = Shop::where('status','=',0)->where('is_deleted','=',1)->where('verified','=',1)->get();

        return view('shop.deactive_shops',compact('shops'));
    }

    public function activate_shop($id)
    {
        $shop = Shop::where('id','=',$id)->first();
        $shop->is_deleted = 0;
        $shop->status = 1;

        if($shop->save())
        {
            return redirect('/deactive_shops')->with('success_msg', 'Activated successfully!');
        }
        else
        {
            return redirect('/deactive_shops')->with('error_msg', 'Unable to activate the shop. Try Again!');
        }
    }

    public function deactivate_shop($id)
    {
        $shop = Shop::where('id','=',$id)->first();
        $shop->is_deleted = 1;
        $shop->status = 0;

        if($shop->save())
        {
            return redirect('/view_all_shops')->with('success_msg', 'Deactivated successfully!');
        }
        else
        {
            return redirect('/view_all_shops')->with('error_msg', 'Unable to deactivate the shop. Try Again!');
        }
    }

    public function customer_home()
    {
        $shops = Shop::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('albalad','=',0)->get();

        $albalad_shops = Shop::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('albalad','=',1)->get();
        
        $banners = Banner::where('is_deleted','=',0)->where('status','=',1)->get();
        
        return view('client.index',compact('shops','albalad_shops','banners'));
    }

    public function all_stores()
    {
        $shops = Shop::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->get();

        return view('client.all_stores',compact('shops'));
    }

    public function all_offers()
    {
        $shops = Shop::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->get();

        return view('client.all_offers',compact('shops'));
    }

    public function albalad_stores()
    {
        $shops = Shop::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('albalad','=',1)->get();

        return view('client.albalad_stores',compact('shops'));
    }

    public function store_products($id)
    {
        $shop = Shop::with(['shop_timings'])->where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('id','=',$id)->first();

        $categories = Category::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('shop_id','=',$id)->get();
        $filter_categories = Category::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('shop_id','=',$id)->get();

        $products = [];
        $total_items = 0;

        foreach($categories as $data)
        {
            foreach($data->products as $pro)
            {
                array_push($products, $pro);
                if($pro->status == 1 && $pro->is_deleted == 0)
                {
                    $total_items = $total_items + 1;
                }
            }
        }
        return view('client.store_products',compact('shop','categories','total_items','filter_categories','products'));
    }

    public function store_products_filter(Request $request,$id)
    {
        $shop = Shop::with(['shop_timings'])->where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('id','=',$id)->first();

        $filter_categories = Category::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('shop_id','=',$id)->get();
        
        $products = [];

        if(!$request->high && !$request->low && !$request->recently && !$request->filter_list)
        {
            $categories = Category::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('shop_id','=',$id)->get();

            
            $total_items = 0;

            foreach($categories as $data)
            {
                foreach($data->products as $pro)
                {
                    array_push($products, $pro);
                    if($pro->status == 1 && $pro->is_deleted == 0)
                    {
                        $total_items = $total_items + 1;
                    }
                }
            }   
        }
        else
        {
            if($request->filter_list)
            {
                $query = Category::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('shop_id','=',$id);
                $iterator = 0;
                foreach($request->filter_list as $key)
                {
                    if($iterator == 0)
                    {
                        $query->where('id','=',$key);
                    }
                    else
                    {
                        $query->orWhere('id','=',$key);
                    }
                    $iterator = $iterator+1;
                }
                $categories = $query->get();
            }
            else
            {
                $categories = Category::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('shop_id','=',$id)->get();
            }
            
            $total_items = 0;

            foreach($categories as $data)
            {
                foreach($data->products as $pro)
                {
                    array_push($products, $pro);
                    if($pro->status == 1 && $pro->is_deleted == 0)
                    {
                        $total_items = $total_items + 1;
                    }
                }
            }

            if($request->high)
            {
                foreach($products as $unsorted)
                {
                    if($unsorted->discount_percentage == 0)
                    {
                        $price[] = $unsorted->price;
                    }
                    else
                    {
                        $price[] = ($unsorted->price*$unsorted->discount_percentage)/100;
                    }
                    
                }
                array_multisort($price, SORT_DESC,$products);
            }
            if($request->low)
            {
                foreach($products as $unsorted)
                {
                    if($unsorted->discount_percentage == 0)
                    {
                        $price[] = $unsorted->price;
                    }
                    else
                    {
                        $price[] = ($unsorted->price*$unsorted->discount_percentage)/100;
                    }
                }
                array_multisort($price, SORT_ASC,$products);
            }
            if($request->recent)
            {
                foreach($products as $unsorted)
                {
                    $price[] = $unsorted->created_at;
                }
                array_multisort($price, SORT_DESC,$products);
            }
        }
        return view('client.store_products',compact('shop','categories','total_items','filter_categories','products'));
    }

    public function login_as_seller()
    {
        return view('trader.login_as_seller');
    }

    public function login_trader(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:50',
            'password' => 'required|min:6|max:30'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first())->withInput();
        }

        $email = $request->email;
        $password = $request->password;
        
        $shop = Shop::where('email','=',$email)->first();
        if($shop)
        {
            if($shop->verified == 0 && $shop->status == 1 && $shop->is_deleted == 0)
            {
                return redirect()->back()->with('error_msg','Shop not verified. Contact Talab Administrator for verification.')->withInput();
            }
            elseif($shop->status == 0 && $shop->is_deleted == 1)
            {
                return redirect()->back()->with('error_msg','Shop Deactivated. Contact Talab Administrator for activation.')->withInput();
            }
            elseif($shop->status == 1 && $shop->is_deleted == 0 && $shop->verified == 1)
            {
                if(Auth::guard('shop')->attempt(['email'=> $email, 'password' => $password]))
                {
                    return redirect('/shop_dashboard');
                }
                else
                {
                    return redirect()->back()->with('error_msg', 'Invalid Credentials!')->withInput();
                }
            }
            else
            {
                return redirect()->back()->with('error_msg', 'Network Error. Try Again Later.')->withInput();
            }
        }
        else
        {
            return redirect()->back()->with('error_msg', 'You are not authorized!')->withInput();
        }
    }

    public function logout_trader()
    {
        Auth::logout();
        return redirect()->back();
    }

    public function shop_dashboard()
    {
        $incompleted = OrderDetail::with(['order'])->where('shop_id','=', Auth::guard('shop')->user()->id)->get();
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

        $categories = Category::where('shop_id','=',Auth::guard('shop')->user()->id)->where('verified','=',1)->where('is_deleted','=',0)->where('status','=',1)->get();

        return view('trader.shop_dashboard',compact('categories','result'));
    }

    public function shop_products()
    {
        $categories = Category::where('shop_id','=',Auth::guard('shop')->user()->id)->where('verified','=',1)->where('is_deleted','=',0)->where('status','=',1)->get();

        return view('trader.shop_products',compact('categories'));
    }

    public function out_of_stock_products()
    {
        $categories = Category::where('shop_id','=',Auth::guard('shop')->user()->id)->where('verified','=',1)->where('is_deleted','=',0)->where('status','=',1)->get();

        return view('trader.out_of_stock_products',compact('categories'));
    }

    public function activate_product($id)
    {
        $product = Product::where('id','=',$id)->first();

        $category = Category::where('id','=',$product->category_id)->first();

        if($product->is_deleted == 0)
        {
            if($category->shop_id == Auth::guard('shop')->user()->id)
            {
                $product->status = 1;

                if($product->save())
                {
                    return redirect()->back()->with('success_msg','Product Activated Successfully.');
                }
                else
                {
                    return redirect()->back()->with('error_msg','Unable to activate product. Try Again later');
                }
            }
            else
            {
                return redirect()->back()->with('error_msg','You are not authorized for this action.');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg','Product Deleted by Administrator. Cannot perform this action.');
        }
    }

    public function delete_product($id)
    {
        $product = Product::where('id','=',$id)->first();

        $category = Category::where('id','=',$product->category_id)->first();

        if($product->is_deleted == 0)
        {
            if($category->shop_id == Auth::guard('shop')->user()->id)
            {
                $product->status = 0;

                if($product->save())
                {
                    return redirect()->back()->with('success_msg','Product Deactivated Successfully.');
                }
                else
                {
                    return redirect()->back()->with('error_msg','Unable to deactivate product. Try Again later');
                }
            }
            else
            {
                return redirect()->back()->with('error_msg','You are not authorized for this action.');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg','Product Deleted by Administrator. Cannot perform this action.');
        }
    }

    public function signup_seller()
    {
        return view('trader.signup_seller');
    }

    public function register_trader(Request $request)
    {
        $rules = [
            'img' => 'required',
            'name' => 'required|min:1|max:25',
            'registration_no' => 'required',
            'trader_name' => 'required',
            'email' => 'required|email|max:50|unique:shops|unique:customers',
            'password' => 'required|min:6|max:30',
            'number' => 'required|max:10|unique:customers|unique:shops|regex:{^05[0-9]{8}$}',
            'city' => 'required',
            'no_of_product' => 'required',
            'iban' => 'required',
            'minimum_cost_to_delivery' => 'required',
            'delivery' => 'required',
            'shop_type' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first())->withInput();
        }

        $filename = uniqid().$_FILES["img"]["name"]; 
        $tempname = $_FILES["img"]["tmp_name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if($ext == 'jpg' || $ext == 'JPG' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPEG' || $ext == 'jpeg')
        {
            move_uploaded_file($tempname, public_path('shop_logo/'.$filename));
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Please Upload a Valid Shop Logo')->withInput();
        }

        $accessory = Accessory::where('id','=',1)->first();
        
        $shop = Shop::create([
            'logo' => $filename,
            'name' => $request->name,
            'registration_no' => $request->registration_no,
            'trader_name' => $request->trader_name,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
            'number' => $request->number,
            'city' => $request->city,
            'no_of_product' => $request->no_of_product,
            'iban' => $request->iban,
            'minimum_cost_to_delivery' => $request->minimum_cost_to_delivery,
            'always_open' => 0, 
            'delivery' => $request->delivery,
            'vat' => $accessory->vat,
            'albalad' => $request->shop_type,
            'profit' => $accessory->profit
        ]);

        if($request->always_open == 1)
        {
            $shop->always_open = 1;
            $shop->save();
        }
        
        $notification = Notification::create([
            'text' => 'There is a new Joining Request for Shop name '.$shop->name,
            'notification_by' => $shop->id
        ]);
        
        if($shop)
        {
            return redirect()->back()->with('success_msg', 'Successfully Signed up');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Failed to signup. Try Again')->withInput();
        }
    }

    public function search_shop(Request $request)
    {
        $shops = Shop::where('name', 'like', '%' . $request->search . '%')->where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->get();

        return view('client.search_store',compact('shops'));
    }

    public function open_close_shop(Request $request)
    {
        if($request->switch == 1)
        {
            $shop = Shop::where('id','=', Auth::guard('shop')->user()->id)->first();
            $shop->shop_open = 1;
            $shop->save();
            return redirect()->back();
        }
        else
        {
            $shop = Shop::where('id','=', Auth::guard('shop')->user()->id)->first();
            $shop->shop_open = 0;
            $shop->save();
            return redirect()->back();
        }
    }

    public function shop_edit_profile(Request $request)
    {
        $rules = [
            'name' => 'required|max:20',
            'registration_no' => 'required',
            'trader_name' => 'required|max:20',
            'email' => 'required|email|max:30|unique:customers',
            'number' => 'required|max:10|unique:customers|regex:{^05[0-9]{8}$}',
            'city' => 'required|max:20',
            'iban' => 'required|max:25',
            'minimum_cost_to_delivery' => 'required',
            'delivery' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $shop_email = Shop::where('id','!=',Auth::guard('shop')->user()->id)->where('email','=',$request->email)->get();

        if(count($shop_email) > 0)
        {
            return redirect()->back()->with('error_msg', 'Email Already Exists');
        }

        $shop_number = Shop::where('id','!=',Auth::guard('shop')->user()->id)->where('number','=',$request->number)->get();

        if(count($shop_number) > 0)
        {
            return redirect()->back()->with('error_msg', 'Number Already Exists');
        }

        $shop = Shop::where('id','=',Auth::guard('shop')->user()->id)->first();

        $shop->name = $request->name;
        $shop->registration_no = $request->registration_no;
        $shop->trader_name = $request->trader_name;
        $shop->email = $request->email;
        $shop->number = $request->number;
        $shop->city = $request->city;
        $shop->iban = $request->iban;
        $shop->minimum_cost_to_delivery = $request->minimum_cost_to_delivery;
        $shop->delivery = $request->delivery;

        if($request->always_open == 1)
        {
            $shop->always_open = 1;
        }
        else
        {
            $shop->always_open = 0;
        }

        if($request->albalad == 1)
        {
            $shop->albalad = 1;
        }
        else
        {
            $shop->albalad = 0;
        }

        if($request->img)
        {
            $filename = uniqid().$_FILES["img"]["name"]; 
            $tempname = $_FILES["img"]["tmp_name"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if($ext == 'jpg' || $ext == 'JPG' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPEG' || $ext == 'jpeg')
            {
                move_uploaded_file($tempname, public_path('shop_logo/'.$filename));
            }
            else
            {
                return redirect()->back()->with('error_msg', 'Please Upload a Valid Shop Logo');
            }

            $shop->logo = $filename;
        }

        if($shop->save())
        {
            return redirect()->back()->with('success_msg', 'Profile Updated Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Unable to update profile.');
        }

        
    }

    public function view_forgot_password()
    {
        return view('trader.forgot_password');
    }

    public function submit_trader_forgot_password(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first())->withInput();
        }

        $shop = Shop::where('email','=',$request->email)->first();

        if($shop)
        {
            $token = \Str::random(20);
            $shop->token = $token;
            $shop->save();

            $link = 'http://talab-sa.com/trader_reset_password/'.$token;
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
            $to = $request->email;
            $from = 'support@talab-sa.com';
            $subject = 'Reset Password';
            $message = '<p>Hye</br>There was a request for password resetting. Kindly click the <a href="'.$link.'">link</a> to reset your password.</p>';
            $headers .= 'From: support@talab-sa.com'."\r\n".
            'Reply-To: support@talab-sa.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);

            return redirect()->back()->with('success_msg', 'Link has been sent to your email. Kindly check your email.');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Email not found')->withInput();
        }
    }

    public function trader_reset_password($token)
    {
        $shop = Shop::where('token','=',$token)->first();

        if($shop)
        {
            return view('trader.trader_reset_password',compact('token'));
        }
        else
        {
            abort(403, 'Your token expired');
        }
    }

    public function submit_trader_reset_password(Request $request)
    {
        $rules = [
            'password' => 'required',
            'confirm_password' => 'required',
            'token' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        if($request->password == $request->confirm_password)
        {
            $shop = Shop::where('token','=',$request->token)->first();

            $shop->password = Hash::make($request->password);
            $shop->token = null;

            if($shop->save())
            {
                return redirect('/trader_password_reseted')->with('success_msg', 'Password Changed successfully');
            }
            else
            {
                return redirect()->back()->with('error_msg', 'Something went wrong Try Again later');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Password and Confirm Password donot matched');
        }
    }

    public function trader_password_reseted()
    {
        return view('trader.trader_password_reseted');
    }

    public function shop_settings()
    {
        return view('trader.shop_settings');
    }

    public function shop_account()
    {
        return view('trader.shop_account');
    }

    public function shop_contact_us()
    {
        return view('client.complains_and_suggestions');
    }

    public function shop_change_password(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }
        
        $shop = Shop::where('id','=',Auth::guard('shop')->user()->id)->first();

        if (Hash::check($request->old_password, $shop->password)) {

            if($request->new_password == $request->confirm_password)
            {
                $shop->password = Hash::make($request->new_password);

                if($shop->save())
                {
                    return redirect()->back()->with('success_msg', 'Password Changed successfully');
                }
                else
                {
                    return redirect()->back()->with('error_msg', 'Something went wrong Try Again later');
                }
            }
            else
            {
                return redirect()->back()->with('error_msg', 'Password and Confirm Password donot matched');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Wrong password entered');
        }
    }

    public function request_product_display(Request $request)
    {
        $rules = [
            'no_of_product' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $product_request = ProductRequest::create([
            'shop_id' => Auth::guard('shop')->user()->id,
            'no_of_product' => $request->no_of_product
        ]);

        if($product_request)
        {
            return redirect()->back()->with('success_msg', 'Request sent to admin. You will be notified');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Unable to make request. Try Again');
        }
    }
}
