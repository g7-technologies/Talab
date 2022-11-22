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

class WishlistController extends Controller
{
	public function customer_wishlist()
	{
		$wishlist = FavouriteProduct::with(['products'])->where('customer_id','=',Auth::guard('customer')->user()->id)->where('is_deleted','=',0)->get();
// 		dd($wishlist);
		return view('client.wishlist',compact('wishlist'));
	}

	public function remove_from_wishlist($id)
	{
		$wishlist = FavouriteProduct::where('id','=',$id)->first();

		if($wishlist->customer_id == Auth::guard('customer')->user()->id)
		{
			$wishlist->is_deleted = 1;

			if($wishlist->save())
			{
				return redirect()->back()->with('success_msg','Removed from wishlist');
			}
			else
			{
				return redirect()->back()->with('error_msg','Unable to remove from wishlist. Try Again');
			}
		}
		else
		{
			return redirect()->back()->with('error_msg','Not Authorized for this action.');
		}
	}

	public function unlike_product($id)
    {
        $favourite_product = FavouriteProduct::where('customer_id','=',Auth::guard('customer')->user()->id)->where('product_id','=',$id)->delete();

        if($favourite_product)
        {
            return redirect()->back()->with('success_msg','Product removed from wishlist successfully.');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to remove product from wishlist. Try again later');
        }
    }

    public function like_product($id)
    {
        $favourite_product = FavouriteProduct::create([
            'customer_id' => Auth::guard('customer')->user()->id,
            'product_id' => $id
        ]);

        if($favourite_product)
        {
            return redirect()->back()->with('success_msg','Product added to wishlist successfully.');
        }
        else
        {
            return redirect()->back()->with('error_msg','Unable to add product to wishlist. Try again later');
        }
    }
}
