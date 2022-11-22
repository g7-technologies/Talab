<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use App\Resturant;
use App\Meals;
use App\FoodType;
use App\Dispute;
use App\LikedResturants;
use App\Address;
use DB;
use App\DeliveryBoy;
use App\MealOrder;
use App\OrderDetails;

class CustomerController extends Controller
{
    
    public function register_customer(Request $request)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required',
            'device_id' => 'required'
        ];
        
        
        $email_count = Customer::where('email','=',$request->email)->get();
        
        if(count($email_count) > 0){
            return response()->json(['error'=> true, 'error_msg' => 'Email already exists']);
        }
        
        $phone_count = Customer::where('phone','=',$request->phone)->get();
        
        if(count($phone_count) > 0){
            return response()->json(['error'=> true, 'error_msg' => 'Phone already exists']);
        }
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'phone'=> $request->phone,
            'device_id'=> $request->device_id
        ]);
        
        return response()->json(['error' => false,'success_msg' => 'User Registered Successfully!','user'=>$customer]);
    }
    
    public function login_customer(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
            // 'device_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('email','=',$request->email)->where('status','=',1)->where('is_deleted','=',0)->first();
        
        if($customer)
        {
            if(password_verify($request->password, $customer->password))
            {
                //$customer->device_id = $request->device_id;
                $customer->save();
                
                return response()->json(['error' => false,'user' => $customer,'success_msg' => 'Logged In successfully']);
            }
            else
            {
                return response()->json(['error' => true,'error_msg' => 'Login failed, invalid credentials']);
            }
        }
        else
        {
            return response()->json(['error' => true,'error_msg' => 'No User Found..!']);
        }
    }
    
    public function customer_change_email(Request $request)
    {
        $rules = [
            'email' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $email_count = Customer::where('email','=',$request->email)->where('id','!=',$request->customer_id)->get();
        
        if(count($email_count) > 0){
            return response()->json(['error'=> true, 'error_msg' => 'Email already exists']);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        $customer->email = $request->email;
        $customer->save();

        return response()->json(['error' => false,'user' => $customer,'success_msg' => 'Email changed']);
    }

    public function customer_change_phone(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $phone_count = Customer::where('phone','=',$request->phone)->where('id','!=',$request->customer_id)->get();
        
        if(count($phone_count) > 0){
            return response()->json(['error'=> true, 'error_msg' => 'Phone already exists']);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        $customer->phone = $request->phone;
        $customer->save();
        
        return response()->json(['error' => false,'user' => $customer,'success_msg' => 'Phone Number changed']);
    }
    
    public function customer_change_password(Request $request)
    {
        $rules = [
            'new_password' => 'required',
            'old_password' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        
        if(password_verify($request->old_password, $customer->password))
        {
            $customer->password = Hash::make($request->new_password);
            $customer->save();
            
            return response()->json(['error' => false,'user' => $customer,'success_msg' => 'Password Updated Successfully!']);
        }
        else
        {
            return response()->json(['error' => true,'error_msg' => 'Password incorrect..Please Try Again!']);
        }
    }
    
    public function customer_update_profile(Request $request)
    {
        $rules = [
            'customer_id'=> 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        
        if($request->image != '')
        {
            $image_parts = explode(";base64,",$request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() .'.'.$image_type;
            file_put_contents(public_path('user_profile_pic/').$imageName, $image_base64);
            
            if($customer->image != null || $customer->image != '')
            {
                unlink(public_path('user_profile_pic/').$customer->image);    
            }
            
            $customer->image = $imageName;
            $customer->save();
        }
        
        if($request->dob != '')
        {
            $customer->dob = $request->dob;
        }
        
        if($request->gender != '')
        {
             $customer->gender = $request->gender;    
        }
        
        if($request->name != '')
        {
            $customer->name = $request->name;
        }
        
        $customer->save();
        
        return response()->json(['error' => false,'user' => $customer,'success_msg' => 'Profile Updated Successfully!']);
    }
    
    public function customer_set_password(Request $request)
    {
        $rules = [
            'password' => 'required',
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        
        $customer->password = Hash::make($request->password);
        $customer->save();
            
        return response()->json(['error' => false,'user' => $customer,'success_msg' => 'Password set Successfully!']);
    }
    
    public function customer_social_login(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'device_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('email','=',$request->email)->first();
        
        if($customer)
        {
            $customer->device_id = $request->device_id;
            $customer->save();
            
            return response()->json(['error' => false,'user' => $customer,'success_msg' => 'Logged In successfully']);
        }
        else
        {
            $customer = Customer::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> 0,
                'phone'=> 0,
                'device_id'=> $request->device_id
            ]);
            
            return response()->json(['error' => false,'success_msg' => 'Logged In Successfully!','user'=>$customer]);
        }
    }
    
    public function customer_home(Request $request)
    {
        $rules = [
            'customer_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ];
        
        $data = [];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        //*******************************************************************************
        //---------------------------food types data starts------------------------------
        //*******************************************************************************
        $foodTypes = FoodType::where('is_deleted','=',0)->get();
        
        foreach($foodTypes as $foodType)
        {
            $temp = [];
            $meals = Meals::where('food_type_id','=',$foodType->id)->get();

            foreach($meals->unique('resturant_id') as $meals)
            {
                $resturants = Resturant::where('is_deleted','=',0)->where('status','=',1)->where('id','=',$meals->resturant_id)->first();
                
                //*******************************************************
                //-------------checking distance in Km-------------------
                //*******************************************************
                
                // $theta = $request->longitude - $resturants->longitude;
                // $dist = sin(deg2rad($request->latitude)) * sin(deg2rad($resturants->latitude)) +  cos(deg2rad($request->latitude)) * cos(deg2rad($resturants->latitude)) * cos(deg2rad($theta));
                // $dist = acos($dist);
                // $dist = rad2deg($dist);
                // $kms = ($dist * 60 * 1.1515) * 1.609344;
                
                // if($kms >= 8)
                // {
                    $resturant_meals = Meals::with(['FoodType'])->where('is_deleted','=',0)->where('status','=',1)->where('resturant_id','=',$resturants->id)->get();
                    $liked_check = LikedResturants::where('resturant_id','=',$resturants->id)->where('customer_id','=',$request->customer_id)->first();
                    
                    if($liked_check)
                    {
                        $raw_resturants = ['id'=> $resturants->id,'name'=>$resturants->name,'logo'=>$resturants->logo,'email'=>$resturants->email,'password'=>$resturants->password,'phone'=> $resturants->phone,'description'=>$resturants->description,'rating'=>$resturants->rating,'status'=>$resturants->status,'is_deleted'=>$resturants->is_deleted,'token'=> $resturants->token,'latitude'=>$resturants->latitude,'longitude'=>$resturants->longitude,'created_at'=>$resturants->created_at,'updated_at'=>$resturants->updated_at,'liked'=>true,'meals'=>$resturant_meals];
                    }
                    else
                    {
                        $raw_resturants = ['id'=> $resturants->id,'name'=>$resturants->name,'logo'=>$resturants->logo,'email'=>$resturants->email,'password'=>$resturants->password,'phone'=> $resturants->phone,'description'=>$resturants->description,'rating'=>$resturants->rating,'status'=>$resturants->status,'is_deleted'=>$resturants->is_deleted,'token'=> $resturants->token,'latitude'=>$resturants->latitude,'longitude'=>$resturants->longitude,'created_at'=>$resturants->created_at,'updated_at'=>$resturants->updated_at,'liked'=>false,'meals'=>$resturant_meals];
                    }
                    
                    array_push($temp,$raw_resturants);
                // }
            }
            
            if(count($temp) > 0)
            {
                $raw_foodType = ['id'=> $foodType->id,'name'=>$foodType->name,'is_deleted'=>$foodType->is_deleted,'created_at'=>$foodType->created_at,'updated_at'=>$foodType->updated_at,'resturants'=>$temp];
                array_push($data,$raw_foodType);
            }
        }
        
        //*******************************************************************************
        //---------------------------food types data ends------------------------------
        //*******************************************************************************
        
        
        
        
        //*******************************************************************************
        //---------------------------simple resturants data starts---------------------
        //*******************************************************************************

        $list_of_resturants = Resturant::where('is_deleted','=',0)->where('status','=',1)->get();
        $temp_list_of_resturants = [];
        
        foreach($list_of_resturants as $rest)
        {
            // $theta = $request->longitude - $rest->longitude;
            // $dist = sin(deg2rad($request->latitude)) * sin(deg2rad($rest->latitude)) +  cos(deg2rad($request->latitude)) * cos(deg2rad($rest->latitude)) * cos(deg2rad($theta));
            // $dist = acos($dist);
            // $dist = rad2deg($dist);
            // $kms = ($dist * 60 * 1.1515) * 1.609344;
            
            // if($kms >= 8)
            // {
                $resturant_meals = Meals::with(['FoodType'])->where('is_deleted','=',0)->where('status','=',1)->where('resturant_id','=',$rest->id)->get();
                $liked_check = LikedResturants::where('resturant_id','=',$rest->id)->where('customer_id','=',$request->customer_id)->first();
                
                if($liked_check)
                {
                    $raw_resturants = ['id'=> $rest->id,'name'=>$rest->name,'logo'=>$rest->logo,'email'=>$rest->email,'password'=>$rest->password,'phone'=> $rest->phone,'description'=>$rest->description,'rating'=>$rest->rating,'status'=>$rest->status,'is_deleted'=>$rest->is_deleted,'token'=> $rest->token,'latitude'=>$rest->latitude,'longitude'=>$rest->longitude,'created_at'=>$rest->created_at,'updated_at'=>$rest->updated_at,'liked'=>true,'meals'=>$resturant_meals];
                }
                else
                {
                    $raw_resturants = ['id'=> $rest->id,'name'=>$rest->name,'logo'=>$rest->logo,'email'=>$rest->email,'password'=>$rest->password,'phone'=> $rest->phone,'description'=>$rest->description,'rating'=>$rest->rating,'status'=>$rest->status,'is_deleted'=>$rest->is_deleted,'token'=> $rest->token,'latitude'=>$rest->latitude,'longitude'=>$rest->longitude,'created_at'=>$rest->created_at,'updated_at'=>$rest->updated_at,'liked'=>false,'meals'=>$resturant_meals];
                }
                
                array_push($temp_list_of_resturants,$raw_resturants); 
            // }
        }
        
        //*******************************************************************************
        //---------------------------simple resturants data ends-------------------------
        //*******************************************************************************
        
        
        //*******************************************************************************
        //---------------------------top rated resturants data starts--------------------
        //*******************************************************************************

        $top_rated_resturants = Resturant::where('is_deleted','=',0)->where('status','=',1)->orderBy('rating', 'DESC')->get();
        $temp_top_rated_resturants = [];
        
        foreach($top_rated_resturants as $rest)
        {
            // $theta = $request->longitude - $rest->longitude;
            // $dist = sin(deg2rad($request->latitude)) * sin(deg2rad($rest->latitude)) +  cos(deg2rad($request->latitude)) * cos(deg2rad($rest->latitude)) * cos(deg2rad($theta));
            // $dist = acos($dist);
            // $dist = rad2deg($dist);
            // $kms = ($dist * 60 * 1.1515) * 1.609344;
            
            // if($kms >= 8)
            // {
                $resturant_meals = Meals::with(['FoodType'])->where('is_deleted','=',0)->where('status','=',1)->where('resturant_id','=',$rest->id)->get();
                $liked_check = LikedResturants::where('resturant_id','=',$rest->id)->where('customer_id','=',$request->customer_id)->first();
                
                if($liked_check)
                {
                    $raw_resturants = ['id'=> $rest->id,'name'=>$rest->name,'logo'=>$rest->logo,'email'=>$rest->email,'password'=>$rest->password,'phone'=> $rest->phone,'description'=>$rest->description,'rating'=>$rest->rating,'status'=>$rest->status,'is_deleted'=>$rest->is_deleted,'token'=> $rest->token,'latitude'=>$rest->latitude,'longitude'=>$rest->longitude,'created_at'=>$rest->created_at,'updated_at'=>$rest->updated_at,'liked'=>true,'meals'=>$resturant_meals];
                }
                else
                {
                    $raw_resturants = ['id'=> $rest->id,'name'=>$rest->name,'logo'=>$rest->logo,'email'=>$rest->email,'password'=>$rest->password,'phone'=> $rest->phone,'description'=>$rest->description,'rating'=>$rest->rating,'status'=>$rest->status,'is_deleted'=>$rest->is_deleted,'token'=> $rest->token,'latitude'=>$rest->latitude,'longitude'=>$rest->longitude,'created_at'=>$rest->created_at,'updated_at'=>$rest->updated_at,'liked'=>false,'meals'=>$resturant_meals];
                }
                
                array_push($temp_top_rated_resturants,$raw_resturants);
            // }
        }
        
        //*******************************************************************************
        //---------------------------top rated resturants data ends----------------------
        //*******************************************************************************
        
        
        
        //*******************************************************************************
        //---------------------------customer address data starts------------------------
        //*******************************************************************************

        $customer_address = Address::where('is_deleted','=',0)->where('status','=',1)->where('customer_id','=',$request->customer_id)->get();
        
        //*******************************************************************************
        //---------------------------customer address data ends--------------------------
        //*******************************************************************************
        
        return response()->json(['error'=> false, 'success_msg' =>'Data fetched','food_type'=> $data,'resturants'=>$temp_list_of_resturants,'top_rated'=>$temp_top_rated_resturants,'address'=>$customer_address]);
    }
    
    public function customer_orders(Request $request)
    {
        $rules = [
            'customer_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $mealOrder = MealOrder::with(['order_detail','Resturant','DeliveryBoy','Dispute'])->where('customer_id','=',$request->customer_id)->get();
        
        return response()->json(['error' => false,'success_msg' => 'place order','orders' => $mealOrder]);
    }
    
    public function customer_switch_notifications(Request $request)
    {
        $rules = [
            'customer_id' => 'required',
            'notification' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $customer = Customer::where('id','=',$request->customer_id)->first();
        
        $customer->notification = $request->notification;
        $customer->save();
        
        if($request->notification == 1)
        {
            return response()->json(['error' => false,'success_msg' => 'Notifications turned on','user' => $customer]);    
        }
        else
        {
            return response()->json(['error' => false,'success_msg' => 'Notifications turned off','user' => $customer]);
        }
        
    }
    
    public function customer_send_otp(Request $request)
    {
        $rules = [
            'otp' => 'required',
            'number' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg' => $validator->errors()->first()]);
        }
        
        $username = 'pdoa7175';
        $password = 'o2ipYhAE';
        $to = $request->number;
        $content = $request->otp.'%20is%20your%20verification%20code%20for%20widi';
        
        $url = 'https://http-api.d7networks.com/send?username='.$username.'&password='.$password.'&dlr-method=POST&dlr-url=https://4ba60af1.ngrok.io/receive&dlr=yes&dlr-level=3&to='.$to.'&from=smsinfo&content='.$content;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec ($ch);
        $err = curl_error($ch);
        curl_close ($ch);
        return response()->json([$response]);
    }
}
