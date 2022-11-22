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

class CustomerController extends Controller
{
    public function signup_customer(Request $request)
    {
        $rules = [
            'first_name' => 'required|min:1|max:15',
            'last_name' => 'required|min:1|max:15',
            'number' => 'required|max:50|unique:shops|unique:customers|regex:{^05[0-9]{8}$}',
            'email' => 'required|email|max:50|unique:customers|unique:shops',
            'password' => 'required|min:6|max:30',
            'confirm_password' => 'required|min:6|max:30',
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('signup_error_msg', $validator->errors()->first())->withInput();
        }

        if($request->password != $request->confirm_password)
        {
            return redirect()->back()->with('signup_error_msg', 'Password and Confirm Password Did not matched')->withInput();
        }
        
        $customer = Customer::create([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'number'=> $request->number,
            'image'=> 'user.svg',
            'status'=>0
        ]);

        if($customer)
        {
            $token = \Str::random(20);
            $customer->token = $token;
            $customer->save();
            
            $link = 'http://talab-sa.com/verify_account/'.$token;
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
            $to = $request->email;
            $from = 'support@talab-sa.com';
            $subject = 'Reset Password';
            $message = '<p>Hye </br> Thanks for signing up. Kindly click the <a href="'.$link.'">link</a> to verify and activate your Talab account.</p>';
            $headers .= 'From: support@talab-sa.com'."\r\n".
            'Reply-To: support@talab-sa.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            

            return redirect()->back()->with('signup_success_msg', 'Successfully Signed up. Verify Your Email to activate Your account');
        }
        else
        {
            return redirect()->back()->with('signup_error_msg', 'Failed to signup. Try Again')->withInput();
        }
    }
    
    public function verify_account($token)
    {
        $customer = Customer::where('token','=',$token)->where('status','=',0)->where('is_deleted','=',0)->first();
        if($customer)
        {
            $customer->token = null;
            $customer->status = 1;
            $customer->save();
            $email = $customer->email;
            $password = $customer->password;
            Auth::guard('customer')->attempt(['email'=> $email, 'password' => $password]);
            return view('client.verify_account');
        }
        else
        {
            abort(403, 'Your token expired');
        }
    }

    public function login_customer(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:50',
            'password' => 'required|min:6|max:30'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('login_error_msg', $validator->errors()->first())->withInput();
        }

        $email = $request->email;
        $password = $request->password;
        
        $customer = Customer::where('email','=',$email)->where('status','=',1)->where('is_deleted','=',0)->first();
        
        if($customer)
        {
            if(Auth::guard('customer')->attempt(['email'=> $email, 'password' => $password]))
            {
                return redirect()->back();
            }
            else
            {
                return redirect()->back()->with('login_error_msg', 'Invalid Credentials!')->withInput();
            }
        }
        else
        {
            return redirect()->back()->with('login_error_msg', 'You are not authorized!')->withInput();
        }
    }

    public function logout_customer()
    {
        Auth::logout();
        return redirect()->back();
    }

    public function my_account_customer()
    {
        return view('client.my_account');
    }

    public function customer_edit_profile(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:15',
            'last_name' => 'required|max:15',
            'number' => 'required|unique:shops|regex:{^05[0-9]{8}$}',
            'email' => 'required|email|max:50|unique:shops'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $customer_email = Customer::where('id','!=',Auth::guard('customer')->user()->id)->where('email','=',$request->email)->get();

        if(count($customer_email) > 0)
        {
            return redirect()->back()->with('error_msg', 'Email Already Exists');
        }

        $customer_number = Customer::where('id','!=',Auth::guard('customer')->user()->id)->where('number','=',$request->number)->get();

        if(count($customer_number) > 0)
        {
            return redirect()->back()->with('error_msg', 'Number Already Exists');
        }

        $customer = Customer::where('id','=',Auth::guard('customer')->user()->id)->first();

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->number = $request->number;
        $customer->email = $request->email;

        if($request->img)
        {
            $filename = uniqid().$_FILES["img"]["name"]; 
            $tempname = $_FILES["img"]["tmp_name"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if($ext == 'jpg' || $ext == 'JPG' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPEG' || $ext == 'jpeg')
            {
                move_uploaded_file($tempname, public_path('customer_images/'.$filename));
            }
            else
            {
                return redirect()->back()->with('error_msg', 'Please Upload a Valid Shop Logo');
            }

            $customer->image = $filename;
        }

        if($customer->save())
        {
            return redirect()->back()->with('success_msg', 'Profile Updated Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Unable to update profile.');
        }
    }

    public function customer_notifications()
    {
        return view('client.customer_notifications');
    }

    public function submit_client_forgot_password(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:50'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('forgot_error_msg', $validator->errors()->first())->withInput();
        }

        $customer = Customer::where('email','=',$request->email)->first();

        if($customer)
        {
            $token = \Str::random(20);
            $customer->token = $token;
            $customer->save();

            $link = 'http://talab-sa.com/client_reset_password/'.$token;
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
            $to = $request->email;
            $from = 'support@talab-sa.com';
            $subject = 'Reset Password';
            $message = '<p>Hye </br> There was a request for password resetting. Kindly click the <a href="'.$link.'">link</a> to reset your password.</p>';
            $headers .= 'From: support@talab-sa.com'."\r\n".
            'Reply-To: support@talab-sa.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);

            return redirect()->back()->with('forgot_success_msg', 'Link has been sent to your email. Kindly check your email.');
        }
        else
        {
            return redirect()->back()->with('forgot_error_msg', 'No User Found with this email')->withInput();
        }
    }

    public function client_reset_password($token)
    {
        $customer = Customer::where('token','=',$token)->first();

        if($customer)
        {
            return view('client.client_reset_password',compact('token'));
        }
        else
        {
            abort(403, 'Your token expired');
        }
    }

    public function submit_client_reset_password(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|max:30',
            'confirm_password' => 'required|min:6|max:30',
            'token' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        if($request->password == $request->confirm_password)
        {
            $customer = Customer::where('token','=',$request->token)->first();

            $customer->password = Hash::make($request->password);
            $customer->token = null;

            if($customer->save())
            {
                return redirect('/client_password_reseted')->with('success_msg', 'Password Changed successfully');
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

    public function client_password_reseted()
    {
        return view('client.client_password_reseted');
    }

    public function customer_settings()
    {
        return view('client.customer_settings');
    }

    public function customer_change_password(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:6|max:30',
            'new_password' => 'required|min:6|max:30',
            'confirm_password' => 'required|min:6|max:30'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }
        
        $customer = Customer::where('id','=',Auth::guard('customer')->user()->id)->first();

        if (Hash::check($request->old_password, $customer->password)) {

            if($request->new_password == $request->confirm_password)
            {
                $customer->password = Hash::make($request->new_password);

                if($customer->save())
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

    public function view_all_clients()
    {
        $customers = Customer::with(['orders'])->get();
        
        return view('client.view_all_clients',compact('customers'));
    }

    public function block_client($id)
    {
        $customer = Customer::where('id','=',$id)->first();
        $customer->status = 0;
        $customer->is_deleted = 1;

        if($customer->save())
        {
            return redirect()->back()->with('success_msg', 'Blocked successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Unable to block customer');
        }
    }

    public function activate_client($id)
    {
        $customer = Customer::where('id','=',$id)->first();
        $customer->status = 1;
        $customer->is_deleted = 0;

        if($customer->save())
        {
            return redirect()->back()->with('success_msg', 'Activated successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Unable to activate customer');
        }
    }

    public function client_detail($id)
    {
        $customer = Customer::where('id','=',$id)->first();

        return view('client.client_detail',compact('customer'));
    }
}
