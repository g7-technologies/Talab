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

class CategoryController extends Controller
{
    public function view_all_categories()
    {
    	$shops = Shop::where('status','=',1)->where('is_deleted','=',0)->where('verified','=',1)->get();
    	
    	return view('category.view_all_categories',compact('shops'));
    }

    public function category_products($id)
    {
        $category = Category::where('id','=',$id)->first();

		if($category->shop_id != Auth::guard('shop')->user()->id)
		{
			return redirect()->back()->with('error_msg','You are not authorized for this action');
		}
		else
		{
            return view('trader.category_products',compact('category'));
		}
    }

    public function verify_category($id)
    {
    	$category = Category::where('id','=',$id)->first();
    	$category->verified = 1;

    	if($category->save())
		{
			return redirect('/view_all_categories')->with('success_msg','Category verified successfully');
		}
		else{
			return redirect('/view_all_categories')->with('error_msg','Unable to verify category. Try Again');
		}
    }

	public function admin_deactivate_category($id)
	{
		$category = Category::where('id','=',$id)->first();
		$category->status = 0;
		$category->is_deleted = 1;

		if($category->save())
		{
			return redirect('/view_all_categories')->with('success_msg','Category deactivated successfully');
		}
		else{
			return redirect('/view_all_categories')->with('error_msg','Unable to deactivate category. Try Again');
		}
	}

	public function admin_activate_category($id)
	{
		$category = Category::where('id','=',$id)->first();
		$category->status = 1;
		$category->is_deleted = 0;

		if($category->save())
		{
			return redirect('/view_all_categories')->with('success_msg','Category activated successfully');
		}
		else{
			return redirect('/view_all_categories')->with('error_msg','Unable to activate category. Try Again');
		}
	}

	public function shop_categories()
    {
    	$categories = Category::where('shop_id','=',Auth::guard('shop')->user()->id)->get();
        
        return view('trader.shop_categories',compact('categories'));
    }

	public function activate_category($id)
	{
		$category = Category::where('id','=',$id)->first();

		if($category->shop_id != Auth::guard('shop')->user()->id)
		{
			return redirect()->back()->with('error_msg','You are not authorized for this action');
		}

		$category->status = 1;

		if($category->save())
		{
			return redirect('/shop_categories')->with('success_msg','Category activated successfully');
		}
		else
		{
			return redirect()->back()->with('error_msg','Unable to activate category. Try again.');
		}
	}
	public function delete_category($id)
	{
		$category = Category::where('id','=',$id)->first();

		if($category->shop_id != Auth::guard('shop')->user()->id)
		{
			return redirect()->back()->with('error_msg','You are not authorized for this action');
		}

		$category->status = 0;

		if($category->save())
		{
			return redirect('/shop_categories')->with('success_msg','Category deactivated successfully');
		}
		else
		{
			return redirect()->back()->with('error_msg','Unable to deactivate category. Try again.');
		}
	}

	public function create_new_category()
	{
		return view('trader.create_new_category');
	}

	public function add_new_category(Request $request)
	{
		$rules = [
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->back()->with('error_msg', $validator->errors()->first());
        }

        $category = Category::create([
        	'shop_id' => Auth::guard('shop')->user()->id,
        	'name' => $request->name,
        	'verified' => 1,
        ]);

        if($category)
        {
        	return redirect('/shop_categories')->with('success_msg','Category added successfully');
        }
        else
        {
        	return redirect()->back()->with('error_msg', 'Unable to create category. Try again.');
        }
	}

	public function shop_edit_category($id)
    {
        $category = Category::where('id','=',$id)->first();

        if($category->shop_id == Auth::guard('shop')->user()->id)
        {
            return view('trader.shop_edit_category',compact('category'));
        }
        else
        {
            return redirect()->back()->with('error_msg','You are not authorized for this action.');
        }
    }

    public function shop_update_category(Request $request)
    {
        $rules = [
            'name' => 'required',
            'category_id' => 'required'
        ];
        
        $category = Category::where('id','=',$request->category_id)->first();

        if($category->shop_id == Auth::guard('shop')->user()->id)
        {
            $category->name = $request->name;

            if($category->save())
            {
                return redirect()->back()->with('success_msg','Category updated successfully.');
            }
            else
            {
                return redirect()->back()->with('error_msg','Unable to update category. Try Again');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg','You are not authorized for this action.');
        }
    }
}
