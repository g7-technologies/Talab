<?php

namespace App\Http\Controllers;

use App\Notifications\passwordResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\User;
use App\FavouriteProduct;
use App\Promotion;
use App\Shop;
use App\Banner;
use App\Order;
use App\OrderDetail;
use App\Accessory;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function admin_change_password()
    {
        return view('admin.admin_change_password');
    }
    
    public function admin_change_password_submit(Request $request)
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
        
        $admin = Admin::where('id','=',Auth::guard('admin')->user()->id)->first();

        if (Hash::check($request->old_password, $admin->password)) {

            if($request->new_password == $request->confirm_password)
            {
                $admin->password = Hash::make($request->new_password);

                if($admin->save())
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

    public function update_shop_details_admin(Request $request)
    {
        $rules = [
            'profit' => 'required',
            'minimum_cost_to_delivery' => 'required',
            'no_of_product' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }
        
        $shop = Shop::where('id','=',$request->shop_id)->first();
        if($shop)
        {
            $shop->profit = $request->profit;
            $shop->vat = $request->vat;
            $shop->minimum_cost_to_delivery = $request->minimum_cost_to_delivery;
            $shop->no_of_product = $request->no_of_product;
            if($shop->save())
            {
                return redirect()->back()->with('success_msg', 'Updated Successfully');
            }
            else
            {
                return redirect()->back()->with('error_msg', 'Unable to update data. Try Again');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg', 'No Shop Found');
        }
    }
    
    public function view_login()
    {
    	return view('admin.login');
    }
    
    public function admin_notifications()
    {
        $notifications = Shop::where('status','=',1)->where('is_deleted','=',0)->where('verified','=',0)->get();
        return response()->json(['result' => $notifications]);
    }

    public function login_submit(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect('/')->with('error_msg', 'Invalid Credentials!');
        }
        
        $email = $request->email;
		$password = $request->password;
		
		$admin = Admin::where(['email' => $email])->first();
		
		if($admin)
		{
			if(Auth::guard('admin')->attempt(['email'=> $email, 'password' => $password]))
			{
				return redirect('/dashboard');
			}
            else
            {
                return redirect('/')->with('error_msg', 'Invalid Credentials!');
            }
        }
        else
        {
            return redirect('/')->with('error_msg', 'You are not authorized!');
        }
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/');
    }

    public function dashboard()
    {
        $number_of_joined_shops = Shop::where('status','=',1)->where('is_deleted','=',0)->where('verified','=',1)->count();

        $joining_request = Shop::where('status','=',1)->where('is_deleted','=',0)->where('verified','=',0)->count();
        
        $orders_this_month = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        
        $profit_this_month = DB::table('order_details')->selectRaw('SUM((price*profit)/100) as profit')->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
        
        $recent_orders = Order::orderBy('id','DESC')->limit(10)->get();
        
        $total_customers = Customer::where('status','=',1)->where('is_deleted','=',0)->count();
        
        $popular_products = DB::table('order_details')
                            ->join('products','products.id','=','order_details.product_id')
                            ->limit(3)
                            ->select('order_details.product_id', 'products.image' ,'products.name' , 'products.description', 'products.price', 'products.stock', 'products.minimum_quantity',DB::raw('SUM(order_details.quantity) AS total_sold'))
                            ->orderBy('total_sold','DESC')
                            ->groupBy('products.id')
                            ->get();
                            
        $total_orders = Order::count();
        $pending_orders = Order::where('status','=',0)->count();
        $accepted_orders = Order::where('status','=',1)->count();
        $cancelled_orders = Order::where('status','=',2)->count();
        $shipped_orders = Order::where('status','=',3)->count();
        $delivered_orders = Order::where('status','=',4)->count();
        $order_percentage = [];
        
        array_push($order_percentage, number_format((float)(($pending_orders/$total_orders)*100), 1, '.', ''));
        array_push($order_percentage, number_format((float)(($accepted_orders/$total_orders)*100), 1, '.', ''));
        array_push($order_percentage, number_format((float)(($cancelled_orders/$total_orders)*100), 1, '.', ''));
        array_push($order_percentage, number_format((float)(($shipped_orders/$total_orders)*100), 1, '.', ''));
        array_push($order_percentage, number_format((float)(($delivered_orders/$total_orders)*100), 1, '.', ''));
        
        return view('admin.dashboard',compact('number_of_joined_shops','joining_request','orders_this_month','profit_this_month','recent_orders','popular_products','order_percentage','total_customers'));
    }

    public function view_forgot_password()
    {
        return view('admin.forgot_password');
    }

    public function submit_admin_forgot_password(Request $request)
    {
        $rules = [
            'email' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect('/view_forgot_password')->with('error_msg', $validator->errors()->first());
        }

        $admin = Admin::where('email','=',$request->email)->first();

        if($admin)
        {
            $token = \Str::random(20);
            $admin->token = $token;
            $admin->save();

            $link = 'http://talab-sa.com/admin_reset_password/'.$token;
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
            $to = $request->email;
            $from = 'support@talab-sa.com';
            $subject = 'Reset Password';
            $message = '<p>Hye Admin</br>There was a request for password resetting. Kindly click the <a href="'.$link.'">link</a> to reset your password.</p>';
            $headers .= 'From: support@talab-sa.com'."\r\n".
            'Reply-To: support@talab-sa.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);

            return redirect('/view_forgot_password')->with('success_msg', 'Link has been sent to your email. Kindly check your email.');
        }
        else
        {
            return redirect('/view_forgot_password')->with('error_msg', 'Email not found');
        }
    }

    public function admin_reset_password($token)
    {
        $admin = Admin::where('token','=',$token)->first();

        if($admin)
        {
            return view('admin.admin_reset_password',compact('token'));
        }
        else
        {
            abort(403, 'Your token expired');
        }
    }

    public function submit_admin_reset_password(Request $request)
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
            $admin = Admin::where('token','=',$request->token)->first();

            $admin->password = Hash::make($request->password);
            $admin->token = null;

            if($admin->save())
            {
                return redirect('/password_reseted')->with('success_msg', 'Password Changed successfully');
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

    public function password_reseted()
    {
        return view('admin.password_reseted');
    }
    
    public function create_promotion()
    {
        return view('promotion.create_promotion');    
    }
    
    public function promotions()
    {
        $promotions = Promotion::where('status','=',1)->where('is_deleted','=',0)->where('valid_till','>=',Carbon::today()->toDateString())->get();
        return view('promotion.promotions',compact('promotions'));
    }
    
    public function delete_promotion($id)
    {
        $promotions = Promotion::where('id','=',$id)->first();
        if($promotions)
        {
            $promotions->status = 0;
            $promotions->is_deleted = 1;
            $promotions->save();
            return redirect('/promotions')->with('success_msg', 'Promotion Deleted Successfully');
        }
        else
        {
            return redirect('/promotions')->with('error_msg', 'Unable to delete. Try Again');
        }
    }
    
    public function create_promotion_submit(Request $request)
    {
        $rules = [
            'code' => 'required',
            'discount' => 'required',
            'valid_till' => 'required',
            'promotion_type' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }
        
        $promo = Promotion::create([
            'code' => $request->code,
            'discount' => $request->discount,
            'valid_till' => $request->valid_till,
            'promotion_type' => $request->promotion_type
        ]);
        
        if($promo)
        {
            return redirect()->back()->with('success_msg', 'Promotion created successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Unable to create promotional code. Try Again');
        }
    }
    
    public function upload_banners()
    {
        return view('banner.upload_banners');
    }
    
    public function view_all_banners()
    {
        $banners = Banner::where('status','=',1)->where('is_deleted','=',0)->get();
        return view('banner.view_all_banners',compact('banners'));
    }
    
    public function upload_banners_submit(Request $request)
    {
        $rules = [
            'img' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }
        
        $filename = uniqid().$_FILES["img"]["name"]; 
		$tempname = $_FILES["img"]["tmp_name"];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

        if($ext == 'jpg' || $ext == 'JPG' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPEG' || $ext == 'jpeg')
        {
        	move_uploaded_file($tempname, public_path('banner_images/'.$filename));
        }
        else
        {
        	return redirect()->back()->with('error_msg', 'Please Upload a Valid Banner');
        }
        
        $banners = Banner::create([
            'name' => $filename
        ]);
        
        if($banners)
        {
            $update_banners = DB::table('banners')->where('id', '!=', $banners->id)->update(array('status' => 0,'is_deleted' => 1));
            return redirect()->back()->with('success_msg', 'Banner uploaded successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Unable to upload banner. Try Again');
        }
    }
    
    public function delete_banner($id)
    {
        $banners = Banner::where('id','=',$id)->first();
        if($banners)
        {
            $banners->status = 0;
            $banners->is_deleted = 1;
            $banners->save();
            return redirect('/view_all_banners')->with('success_msg', 'Banner Deleted Successfully');
        }
        else
        {
            return redirect('/view_all_banners')->with('error_msg', 'Unable to delete. Try Again');
        }
    }
    
    public function charts_data()
    {
        ////////////////////////////////////////////profit//////////////////////////////////////////////////////////////////////////////////////
        $daily_profit = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%e %b %y') as day, ROUND(SUM((price*profit)/100),1) as profit FROM `order_details` WHERE DATE_FORMAT(created_at, '%b %y') = DATE_FORMAT(now(), '%b %y') GROUP BY DATE_FORMAT(created_at, '%e %b %y')"));
        $profit_day = [];
        $day_profit = [];
        
        foreach($daily_profit as $data)
        {
            array_push($profit_day,$data->day);
            array_push($day_profit,$data->profit);
        }
        
        $daily_profit = array(
            'profit_day'=> $profit_day,
            'day_profit'=> $day_profit
        );
        
        $monthly_profit = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%b %y') as month, ROUND(SUM((price*profit)/100),1) as profit FROM `order_details` WHERE DATE_FORMAT(created_at, '%y') = DATE_FORMAT(now(), '%y') GROUP BY DATE_FORMAT(created_at, '%b %y')"));
        $profit_month = [];
        $month_profit = [];
        
        foreach($monthly_profit as $data)
        {
            array_push($profit_month,$data->month);
            array_push($month_profit,$data->profit);
        }
        
        $monthly_profit = array(
            'profit_month'=> $profit_month,
            'month_profit'=> $month_profit
        );
        
        $yearly_profit = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%Y') as year, ROUND(SUM((price*profit)/100),1) as profit FROM `order_details` GROUP BY DATE_FORMAT(created_at, '%Y')"));
        $profit_year = [];
        $year_profit = [];
        
        foreach($yearly_profit as $data)
        {
            array_push($profit_year,$data->year);
            array_push($year_profit,$data->profit);
        }
        
        $yearly_profit = array(
            'profit_year'=> $profit_year,
            'year_profit'=> $year_profit
        );
        
        ////////////////////////////////////////////joined shops//////////////////////////////////////////////////////////////////////////////////////
        $daily_joined_shops = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%e %b %y') as day, count(*) as joined_shops FROM `shops` where DATE_FORMAT(created_at, '%b %y') = DATE_FORMAT(now(), '%b %y') GROUP BY DATE_FORMAT(created_at, '%e %b %y')"));
        $shops_day = [];
        $day_shops = [];
        
        foreach($daily_joined_shops as $data)
        {
            array_push($shops_day,$data->day);
            array_push($day_shops,$data->joined_shops);
        }
        
        $daily_joined_shops = array(
            'shops_day'=> $shops_day,
            'day_shops'=> $day_shops
        );
        
        $monthly_joined_shops = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%b %y') as month, count(*) as joined_shops FROM `shops` WHERE DATE_FORMAT(created_at, '%y') = DATE_FORMAT(now(), '%y') GROUP BY DATE_FORMAT(created_at, '%b %y')"));
        $shops_month = [];
        $month_shops = [];
        
        foreach($monthly_joined_shops as $data)
        {
            array_push($shops_month,$data->month);
            array_push($month_shops,$data->joined_shops);
        }
        
        $monthly_joined_shops = array(
            'shops_month'=> $shops_month,
            'month_shops'=> $month_shops
        );
        
        $yearly_joined_shops = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%Y') as year, count(*) as joined_shops FROM `shops` GROUP BY DATE_FORMAT(created_at, '%Y')"));
        $shops_year = [];
        $year_shops = [];
        
        foreach($yearly_joined_shops as $data)
        {
            array_push($shops_year,$data->year);
            array_push($year_shops,$data->joined_shops);
        }
        
        $yearly_joined_shops = array(
            'shops_year'=> $shops_year,
            'year_shops'=> $year_shops
        );

        ////////////////////////////////////////////orders//////////////////////////////////////////////////////////////////////////////////////
        $daily_orders = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%e %b %y') as day, count(*) as total_orders FROM `orders` where DATE_FORMAT(created_at, '%b %y') = DATE_FORMAT(now(), '%b %y') GROUP BY DATE_FORMAT(created_at, '%e %b %y')"));
        $orders_day = [];
        $day_orders = [];
        
        foreach($daily_orders as $data)
        {
            array_push($orders_day,$data->day);
            array_push($day_orders,$data->total_orders);
        }
        
        $daily_orders = array(
            'orders_day'=> $orders_day,
            'day_orders'=> $day_orders
        );
        
        $monthly_orders = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%b %y') as month, count(*) as total_orders FROM `orders` where DATE_FORMAT(created_at, '%y') = DATE_FORMAT(now(), '%y') GROUP BY DATE_FORMAT(created_at, '%b %y')"));
        $orders_month = [];
        $month_orders = [];
        
        foreach($monthly_orders as $data)
        {
            array_push($orders_month,$data->month);
            array_push($month_orders,$data->total_orders);
        }
        
        $monthly_orders = array(
            'orders_month'=> $orders_month,
            'month_orders'=> $month_orders
        );
        
        $yearly_orders = DB::select(DB::raw("SELECT DATE_FORMAT(created_at, '%Y') as year, count(*) as total_orders FROM `orders` GROUP BY DATE_FORMAT(created_at, '%Y')"));
        $orders_year = [];
        $year_orders = [];
        
        foreach($yearly_orders as $data)
        {
            array_push($orders_year,$data->year);
            array_push($year_orders,$data->total_orders);
        }
        
        $yearly_orders = array(
            'orders_year'=> $orders_year,
            'year_orders'=> $year_orders
        );
        
        return response()->json([
            'daily_profit' => $daily_profit, 'monthly_profit' => $monthly_profit, 'yearly_profit' => $yearly_profit,
            'daily_joined_shops' => $daily_joined_shops, 'monthly_joined_shops' => $monthly_joined_shops, 'yearly_joined_shops' => $yearly_joined_shops,
            'daily_orders' => $daily_orders, 'monthly_orders' => $monthly_orders, 'yearly_orders' => $yearly_orders
        ]);
    }
}
