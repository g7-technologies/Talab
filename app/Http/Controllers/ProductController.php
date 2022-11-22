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
use App\Address;
use App\ProductImage;
use App\Accessory;
use App\FavouriteProduct;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function view_all_products()
    {
    	$shops = Shop::where('status','=',1)->where('is_deleted','=',0)->where('verified','=',1)->get();

    	return view('product.view_all_products',compact('shops'));
    }

    public function deactive_products()
    {
    	$shops = Shop::where('status','=',1)->where('is_deleted','=',0)->where('verified','=',1)->get();

    	return view('product.deactive_products',compact('shops'));
    }

    public function admin_deactivate_product($id)
    {
    	$product = Product::where('id','=',$id)->first();
    	$product->is_deleted = 1;
    	$product->status = 0;

    	if($product->save())
    	{
    		return redirect('/view_all_products')->with('success_msg','Product Deactivated Successfully');
    	}
    	else
    	{
    		return redirect('/view_all_products')->with('error_msg','Unable to deactivate product. Try Again');
    	}
    }

    public function admin_activate_product($id)
    {
    	$product = Product::where('id','=',$id)->first();
    	$product->is_deleted = 0;
    	$product->status = 1;

    	if($product->save())
    	{
    		return redirect('/deactive_products')->with('success_msg','Product Activated Successfully');
    	}
    	else
    	{
    		return redirect('/deactive_products')->with('error_msg','Unable to activate product. Try Again');
    	}
    }

	public function product_detail($id)
	{
        $product = Product::where('id','=',$id)->first();
		$category = Category::where('id','=',$product->category_id)->first();
		$shop = Shop::where('id','=',$category->shop_id)->first();
		return view('product.view_product_detail',compact('product','category','shop'));
	}

    public function product_details($id)
    {
        $favourite = false;
        $product = Product::where('id','=',$id)->first();
        $product_images = ProductImage::where('product_id','=',$id)->where('is_deleted','=',0)->get();
        $category = Category::where('id','=',$product->category_id)->first();
        $shop = Shop::where('id','=',$category->shop_id)->first();

        if(Auth::guard('customer')->check())
        {   
            $favourite_product = FavouriteProduct::where('customer_id','=',Auth::guard('customer')->user()->id)->where('product_id','=',$id)->first();

            if($favourite_product)
            {
                $favourite = true;
            }
        }
        return view('client.product_details',compact('shop','category','product','favourite','product_images'));
    }

    public function create_new_product()
    {
        $categories = Category::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('shop_id','=',Auth::guard('shop')->user()->id)->get();

        return view('trader.create_new_product',compact('categories'));
    }

    public function add_new_product(Request $request)
    {
        $rules = [
            'img' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'minimum_quantity' => 'required',
            'description' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first())->withInput();
        }

        $category = Category::where('id','=',$request->category_id)->first();

        if($category->shop_id != Auth::guard('shop')->user()->id)
        {
            return redirect()->back()->with('error_msg', 'You are not authorized for this action.')->withInput();    
        }

        $categories = Category::where('shop_id','=',Auth::guard('shop')->user()->id)->get();
        $count_products = 0;
        foreach($categories as $cat){
            foreach($cat->products as $data)
            {
                if($data->status == 1 && $data->is_deleted == 0)
                {
                    $count_products++;
                }
            }
        }
        
        if($count_products < Auth::guard('shop')->user()->no_of_product)
        {
            $filename = uniqid().$_FILES["img"]["name"]; 
            $tempname = $_FILES["img"]["tmp_name"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if($ext == 'jpg' || $ext == 'JPG' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPEG' || $ext == 'jpeg')
            {
                move_uploaded_file($tempname, public_path('product_images/'.$filename));
            }
            else
            {
                return redirect()->back()->with('error_msg', 'Please Upload a Valid Shop Logo')->withInput();
            }
            
            if($request->discount_percentage)
            {
                $discount_percentage = $request->discount_percentage;
            }
            else
            {
                $discount_percentage = 0;
            }
            
            $product = Product::create([
                'image' => $filename,
                'name'=> $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'discount_percentage' => $discount_percentage,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
                'minimum_quantity' => $request->minimum_quantity
            ]);
            
            if($request->multiple_img != null && count($request->multiple_img) > 0)
            {
                foreach($request->multiple_img as $key=>$val)
                {
                    $filename = uniqid().$_FILES['multiple_img']['name'][$key]; 
                    $tempname = $_FILES["multiple_img"]["tmp_name"][$key];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    
                    if($ext == 'jpg' || $ext == 'JPG' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPEG' || $ext == 'jpeg')
                    {
                        move_uploaded_file($tempname, public_path('product_images/'.$filename));
                        $image_product = ProductImage::create([
                            'product_id' => $product->id,
                            'image' => $filename
                        ]);
                    }
                }
            }
            
            if($product)
            {
                return redirect('/shop_products')->with('success_msg','Product Added Successfully');
            }
            else
            {
                return redirect()->back()->with('error_msg','Unable to add product. Try again later')->withInput();
            }
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Cannot Add More Products. Please Contact Admin')->withInput();
        }

    }

    public function add_to_cart(Request $request)
    {
        $rules = [
            'product_id' => 'required',
            'quantity' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $prod_id = $request->product_id;
        $quantity = $request->quantity;

        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        }
        else
        {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;
        $products = Product::find($prod_id);
        $categoryy = Category::where('id','=',$products->category_id)->first();
        $shopp = Shop::where('id','=',$categoryy->shop_id)->first();

        if(in_array($prod_id_is_there, $item_id_list))
        {
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["item_id"] == $prod_id)
                {
                    $new_quantity = $cart_data[$keys]["item_quantity"]+$request->quantity;

                    if($new_quantity > $products->stock)
                    {
                        return redirect()->back()->with('error_msg','Cannot add product more than stock available.');
                    }

                    $cart_data[$keys]["item_quantity"] = $new_quantity;
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    $result = Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    
                    if($result)
                    {
                        return redirect()->back()->with('success_msg','Product added successfully');
                    }
                    else
                    {
                        return redirect()->back()->with('error_msg','Unable to add product');   
                    }
                }
            }
        }
        else
        {
            $prod_name = $products->name;
            $prod_image = $products->image;
            $priceval = $products->price;
            $prod_profit = $shopp->profit;
            $prod_desc = $products->description;
            $prod_discount_percentage = $products->discount_percentage;
            $prod_category_id = $products->category_id;
            $prod_stock = $products->stock;
            $prod_minimum_quantity = $products->minimum_quantity;

            if($products)
            {
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_name' => $prod_name,
                    'item_desc' => $prod_desc,
                    'item_image' => $prod_image,
                    'item_price' => $priceval,
                    'item_profit' => $prod_profit,
                    'item_discount_percentage' => $prod_discount_percentage,
                    'item_category_id' => $prod_category_id,
                    'item_stock' => $prod_stock,
                    'item_minimum_quantity' => $prod_minimum_quantity,
                    'item_quantity' => $quantity
                );
                $cart_data[] = $item_array;

                $item_data = json_encode($cart_data);
                $minutes = 60;
                $result = Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                
                return redirect()->back()->with('success_msg','Product added successfully');
            }
        }
    }

    public function load_cart_data()
    {
        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $totalcart = count($cart_data);
            $cart_items = $cart_data;
            return response()->json(['totalcart'=> $totalcart,'cart_items' => $cart_items]);
        }
        else
        {
            $totalcart = "0";
            $cart_items = [];
            return response()->json(['totalcart'=> $totalcart,'cart_items' => $cart_items]);
        }
    }

    public function cart()
    {
        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $total = 0;
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["item_discount_percentage"] == 0)
                {
                    $talab_profit = $cart_data[$keys]["item_price"]*($cart_data[$keys]["item_profit"]/100);
                    $item_price_with_profit = $cart_data[$keys]["item_price"] + $talab_profit;
                    $item_total_quantity = $cart_data[$keys]["item_quantity"];
                    
                    $total = $total + ($item_price_with_profit * $item_total_quantity);
                }
                else
                {
                    $disc_price = $cart_data[$keys]["item_price"]*((100-$cart_data[$keys]["item_discount_percentage"])/100);
                    $talab_profit = $cart_data[$keys]["item_price"]*(($cart_data[$keys]["item_profit"])/100);
                    $item_total_quantity = $cart_data[$keys]["item_quantity"];
                    
                    $total = $total + ($item_total_quantity * ($disc_price + $talab_profit));
                }
            }

        }
        else
        {
            $cart_data = array();
            $total = 0;
        }
        $accessory = Accessory::where('id','=',1)->first();
         
        return view('client.customer_cart',compact('cart_data','total','accessory'));
    }

    public function remove_product_from_cart($id)
    {
        $prod_id = $id;

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if(in_array($prod_id_is_there, $item_id_list))
        {
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["item_id"] == $prod_id)
                {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return redirect('/cart')->with('success_msg','Product removed from cart successfully');
                }
            }
        }
    }

    public function update_cart_product_quantity(Request $request)
    {
        $rules = [
            'product_id' => 'required',
            'product_quantity' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $prod_id = $request->product_id;
        $quantity = $request->product_quantity;

        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        }
        else
        {
            return redirect()->back()->with('error_msg', 'Cart is empty');
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;
        $products = Product::find($prod_id);

        if(in_array($prod_id_is_there, $item_id_list))
        {
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["item_id"] == $prod_id)
                {
                    $new_quantity = $request->product_quantity;

                    if($new_quantity > $products->stock)
                    {
                        return redirect()->back()->with('error_msg','Cannot add product more than stock available.');
                    }

                    $cart_data[$keys]["item_quantity"] = $new_quantity;
                    $item_data = json_encode($cart_data);
                    $minutes = 60;
                    $result = Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    
                    return redirect()->back()->with('success_msg','Product updated successfully');
                }
            }
        }
        else
        {
            return redirect()->back()->with('error_msg','Item not available');   
        }
    }

    public function empty_cart()
    {
        Cookie::queue(Cookie::forget('shopping_cart'));
        return redirect()->back()->with('success_msg','Cart emptied successfully');
    }

    public function customer_checkout()
    {
        $accessory = Accessory::where('id','=',1)->first();
        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $total = 0;
            foreach($cart_data as $keys => $values)
            {
                if($cart_data[$keys]["item_discount_percentage"] == 0)
                {
                    $talab_profit = $cart_data[$keys]["item_price"]*($cart_data[$keys]["item_profit"]/100);
                    $item_price_with_profit = $cart_data[$keys]["item_price"] + $talab_profit;
                    $item_total_quantity = $cart_data[$keys]["item_quantity"];
                    
                    $total = $total + ($item_price_with_profit * $item_total_quantity);
                }
                else
                {
                    $disc_price = $cart_data[$keys]["item_price"]*((100-$cart_data[$keys]["item_discount_percentage"])/100);
                    $talab_profit = $cart_data[$keys]["item_price"]*(($cart_data[$keys]["item_profit"])/100);
                    $item_total_quantity = $cart_data[$keys]["item_quantity"];
                    
                    $total = $total + ($item_total_quantity * ($disc_price + $talab_profit));
                }
            }

        }
        else
        {
            $cart_data = array();
            $total = 0;
        }
        
        if(Cookie::get('coupon_code'))
        {
            $cookie_coupon_data = stripslashes(Cookie::get('coupon_code'));
            $coupon_data = json_decode($cookie_coupon_data, true);
            $totalcoupon = count($coupon_data);
        }
        else
        {
            $totalcoupon = "0";
            $coupon_data = [];
        }

        if(Auth::guard('customer')->check())
        {
            $addresses = Address::where('status','=',1)->where('is_deleted','=',0)->where('customer_id','=',Auth::guard('customer')->user()->id)->get();
            return view('client.customer_checkout',compact('cart_data','total','addresses','totalcoupon','coupon_data','accessory'));
        }
        
        return view('client.customer_checkout',compact('cart_data','total','totalcoupon','coupon_data','accessory'));
    }

    public function shop_edit_product($id)
    {
        $product = Product::where('id','=',$id)->first();
        $product_images = ProductImage::where('product_id','=',$id)->where('is_deleted','=',0)->get();
        $category = Category::where('id','=',$product->category_id)->first();
        $categories = Category::where('is_deleted','=',0)->where('status','=',1)->where('verified','=',1)->where('shop_id','=',Auth::guard('shop')->user()->id)->get();

        if($category->shop_id == Auth::guard('shop')->user()->id)
        {
            return view('trader.shop_edit_product',compact('product','category','categories','product_images'));
        }
        else
        {
            return redirect()->back()->with('error_msg','You are not authorized for this action.');
        }
    }

    public function shop_update_product(Request $request)
    {
        $rules = [
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'minimum_quantity' => 'required',
            'description' => 'required'
        ];
        
        $product = Product::where('id','=',$request->product_id)->first();
        $category = Category::where('id','=',$product->category_id)->first();
        
        if($request->discount_percentage)
        {
            $discount_percentage = $request->discount_percentage;
        }
        else
        {
            $discount_percentage = 0;
        }


        if($category->shop_id == Auth::guard('shop')->user()->id)
        {
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->discount_percentage = $discount_percentage;
            $product->stock = $request->stock;
            $product->minimum_quantity = $request->minimum_quantity;
            $product->description = $request->description;

            if($request->img)
            {
                $filename = uniqid().$_FILES["img"]["name"]; 
                $tempname = $_FILES["img"]["tmp_name"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if($ext == 'jpg' || $ext == 'JPG' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPEG' || $ext == 'jpeg')
                {
                    move_uploaded_file($tempname, public_path('product_images/'.$filename));
                    $product->image = $filename;
                }
                else
                {
                    return redirect()->back()->with('error_msg', 'Please Upload a Valid Shop Logo');
                }
            }
            
            if($request->multiple_img != null && count($request->multiple_img) != 0)
            {
                foreach($request->multiple_img as $key=>$val)
                {
                    $filename = uniqid().$_FILES['multiple_img']['name'][$key]; 
                    $tempname = $_FILES["multiple_img"]["tmp_name"][$key];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    
                    if($ext == 'jpg' || $ext == 'JPG' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPEG' || $ext == 'jpeg')
                    {
                        move_uploaded_file($tempname, public_path('product_images/'.$filename));
                        $image_product = ProductImage::create([
                            'product_id' => $product->id,
                            'image' => $filename
                        ]);
                    }
                }
            }

            if($product->save())
            {
                return redirect('/shop_products')->with('success_msg','Product updated successfully.');
            }
            else
            {
                return redirect()->back()->with('error_msg','Unable to update product. Try Again');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg','You are not authorized for this action.');
        }
    }
    
    public function delete_image($id)
    {
        $image_product = ProductImage::where('id','=',$id)->first();
        $image_product->is_deleted = 1;
        if($image_product->save())
        {
            return redirect()->back()->with('success_msg','Image Deleted Successfully');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to delete Image Try Again. Try Again');
        }
    }
}
