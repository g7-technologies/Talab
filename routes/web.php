<?php

//----------------------------Admin Auth Routes----------------------------------------------------------------------
Route::get('/goback','AccessoryController@goback');

Route::get('/login', 'AdminController@view_login');

Route::get('/admin', 'AdminController@view_login');

Route::post('/login_submit', 'AdminController@login_submit');

Route::get('/admin_forgot_password', 'AdminController@view_forgot_password');

Route::post('/submit_admin_forgot_password', 'AdminController@submit_admin_forgot_password');

Route::get('/admin_reset_password/{token}', 'AdminController@admin_reset_password');

Route::post('/submit_admin_reset_password','AdminController@submit_admin_reset_password');

Route::get('/password_reseted', 'AdminController@password_reseted');

Route::group(['middleware' => ['auth:admin','backHistory']], function()
{
    //----------admin logout----------------------
	Route::get('/admin_change_password','AdminController@admin_change_password');

    Route::post('/admin_change_password_submit','AdminController@admin_change_password_submit');

	Route::get('/logout','AdminController@logout');

    Route::post('/update_vat_submit','AccessoryController@update_vat_submit');
	
    Route::post('/update_profit_submit','AccessoryController@update_profit_submit');
    
    Route::post('/update_shipping_cost_submit','AccessoryController@update_shipping_cost_submit');

	Route::get('/update_vat','AccessoryController@update_vat');
	
    Route::get('/update_profit','AccessoryController@update_profit');
    
    Route::get('/update_shipping_cost','AccessoryController@update_shipping_cost');

	Route::post('/update_shop_details_admin','AdminController@update_shop_details_admin');

	Route::get('/dashboard','AdminController@dashboard');
	
    Route::get('/create_promotion','AdminController@create_promotion');
    
    Route::post('/create_promotion_submit','AdminController@create_promotion_submit');

    Route::get('/promotions','AdminController@promotions');
    
    Route::get('/delete_promotion/{id}', 'AdminController@delete_promotion');

    Route::get('/upload_banners','AdminController@upload_banners');
    
    Route::post('/upload_banners_submit','AdminController@upload_banners_submit');
	
    Route::get('/view_all_banners','AdminController@view_all_banners');
    
    Route::get('/delete_banner/{id}', 'AdminController@delete_banner');

	Route::get('/add_new_shop','ShopController@add_new_shop');

	Route::get('/view_all_shops', 'ShopController@view_all_shops');

	Route::get('/shop_detail/{id}', 'ShopController@view_shop_detail');

	Route::get('/activate_shop/{id}', 'ShopController@activate_shop');

	Route::get('/deactivate_shop/{id}', 'ShopController@deactivate_shop');

	Route::post('/add_new_shop_submit', 'ShopController@add_new_shop_submit');
	
	Route::post('/admin_change_order_status', 'OrderController@admin_change_order_status');	

	Route::get('/shop_invitation_link', 'ShopController@shop_invitation_link');

	Route::get('/shop_joining_request', 'ShopController@shop_joining_request');

	Route::get('/accept_joinning_request/{id}', 'ShopController@accept_joinning_request');

	Route::get('/reject_joinning_request/{id}', 'ShopController@reject_joinning_request');

	Route::post('/shop_invitation_link_submit', 'ShopController@shop_invitation_link_submit');

	Route::get('/deactive_shops', 'ShopController@deactive_shops');

	Route::get('/view_all_categories', 'CategoryController@view_all_categories');

	Route::get('verify_category/{id}', 'CategoryController@verify_category');
	
	Route::get('admin_deactivate_category/{id}', 'CategoryController@admin_deactivate_category');
	
	Route::get('admin_activate_category/{id}', 'CategoryController@admin_activate_category');

	Route::get('/view_all_products','ProductController@view_all_products');

	Route::get('/admin_deactivate_product/{id}','ProductController@admin_deactivate_product');

	Route::get('/admin_activate_product/{id}','ProductController@admin_activate_product');

	Route::get('/product_detail/{id}','ProductController@product_detail');

	Route::get('/deactive_products', 'ProductController@deactive_products');

	Route::get('/view_all_clients', 'CustomerController@view_all_clients');

	Route::get('/block_client/{id}', 'CustomerController@block_client');

	Route::get('/activate_client/{id}', 'CustomerController@activate_client');

	Route::get('/view_all_shop_requests', 'AccessoryController@view_all_shop_requests');

	Route::get('/accept_product_request/{id}','AccessoryController@accept_product_request');
	
	Route::get('/delete_product_request/{id}','AccessoryController@delete_product_request');

	Route::get('/client_detail/{id}', 'CustomerController@client_detail');

	Route::get('/view_all_orders', 'OrderController@view_all_orders');

	Route::get('/order_detail/{id}', 'OrderController@order_detail');
	
	Route::get('/admin_notifications','AdminController@admin_notifications')->name('admin_notifications');
	
	Route::get('/charts_data','AdminController@charts_data')->name('charts_data');

	Route::get('/deactive_clients', function () {
		return view('client.deactive_clients');
	});
			
});	


//----------------------------Trader Routes----------------------------------------------------------------------

Route::get('/login_as_seller', 'ShopController@login_as_seller');

Route::post('/login_trader','ShopController@login_trader');

Route::get('/signup_seller', 'ShopController@signup_seller');

Route::post('/register_trader','ShopController@register_trader');

Route::get('/trader_forgot_password', 'ShopController@view_forgot_password');

Route::post('/submit_trader_forgot_password', 'ShopController@submit_trader_forgot_password');

Route::get('/trader_reset_password/{token}', 'ShopController@trader_reset_password');

Route::post('/submit_trader_reset_password','ShopController@submit_trader_reset_password');

Route::get('/trader_password_reseted', 'ShopController@trader_password_reseted');

Route::group(['middleware' => ['auth:shop','backHistory']], function()
{
    Route::get('/logout_trader','ShopController@logout_trader');

    Route::get('/shop_dashboard','ShopController@shop_dashboard');

    Route::get('/shop_products','ShopController@shop_products');

    Route::get('/out_of_stock_products','ShopController@out_of_stock_products');

    Route::get('/shop_categories','CategoryController@shop_categories');

    Route::get('/activate_category/{id}','CategoryController@activate_category');
    
    Route::get('/delete_category/{id}','CategoryController@delete_category');
    
    Route::get('/delete_image/{id}','ProductController@delete_image');

    Route::get('/create_new_category','CategoryController@create_new_category');

    Route::post('/add_new_category','CategoryController@add_new_category');
    
    Route::get('/activate_product/{id}','ShopController@activate_product');
    
    Route::get('/delete_product/{id}','ShopController@delete_product');

    Route::get('/create_new_product','ProductController@create_new_product');

    Route::post('/add_new_product','ProductController@add_new_product');

    Route::get('/shop_orders','OrderController@shop_orders');
    
    Route::get('/accept_order/{id}','OrderController@accept_order');
    
    Route::get('/ship_order/{id}','OrderController@ship_order');
    
    Route::get('/mark_as_delivered/{id}','OrderController@mark_as_delivered');

    Route::post('/open_close_shop','ShopController@open_close_shop');

    Route::post('/shop_edit_profile','ShopController@shop_edit_profile');

    Route::get('/edit_product/{id}','ProductController@shop_edit_product');

    Route::post('/shop_update_product','ProductController@shop_update_product');

    Route::get('/shop_edit_category/{id}','CategoryController@shop_edit_category');

    Route::post('/shop_update_category','CategoryController@shop_update_category');
    
    Route::get('/shop_account','ShopController@shop_account');

    Route::get('/shop_contact_us','ShopController@shop_contact_us');

    Route::get('/shop_settings','ShopController@shop_settings');

    Route::post('/shop_change_password','ShopController@shop_change_password');

    Route::post('request_product_display','ShopController@request_product_display');
    
    Route::get('/shop_cancel_order/{id}','OrderController@shop_cancel_order');
    
    Route::get('/category_products/{id}','CategoryController@category_products');

    Route::get('/shop_notifications',function(){return view('trader.shop_notifications');});
    Route::get('/shop_balance',function(){return view('trader.shop_balance');});
});


//----------------------------Customer Routes----------------------------------------------------------------------

Route::get('/', 'ShopController@customer_home');

Route::get('/verify_account/{token}', 'CustomerController@verify_account');

Route::post('/submit_client_forgot_password', 'CustomerController@submit_client_forgot_password');

Route::get('/client_reset_password/{token}', 'CustomerController@client_reset_password');

Route::post('/submit_client_reset_password','CustomerController@submit_client_reset_password');

Route::get('/client_password_reseted', 'CustomerController@client_password_reseted');

Route::get('/all_stores', 'ShopController@all_stores');

Route::get('/all_offers', 'ShopController@all_offers');

Route::get('/albalad_stores', 'ShopController@albalad_stores');

Route::get('/store_products/{id}', 'ShopController@store_products');

Route::post('/store_products/{id}/filter', 'ShopController@store_products_filter');    

Route::get('/product_details/{id}', 'ProductController@product_details');

Route::post('/signup_customer','CustomerController@signup_customer');

Route::post('/login_customer','CustomerController@login_customer');

Route::post('/add_to_cart','ProductController@add_to_cart');

Route::get('/load_cart_data','ProductController@load_cart_data');

Route::get('/cart','ProductController@cart');

Route::get('/remove_product_from_cart/{id}','ProductController@remove_product_from_cart');

Route::post('/update_cart_product_quantity','ProductController@update_cart_product_quantity');

Route::get('/empty_cart','ProductController@empty_cart');

Route::get('/checkout','ProductController@customer_checkout');

Route::post('/create_order','OrderController@create_order');

Route::get('/faqs','AccessoryController@faqs');

Route::get('/privacy_policy','AccessoryController@privacy_policy');

Route::get('/complains_and_suggestions','AccessoryController@complains_and_suggestions');

Route::post('/send_mail','AccessoryController@send_mail');

Route::post('/search_shop','ShopController@search_shop');

Route::post('/apply_coupon','OrderController@apply_coupon');

Route::get('/remove_coupon','OrderController@remove_coupon');

Route::group(['middleware' => ['auth:customer','backHistory']], function()
{
    Route::get('/logout_customer','CustomerController@logout_customer');

    Route::get('/my_account_customer','CustomerController@my_account_customer');

    Route::post('/customer_edit_profile','CustomerController@customer_edit_profile');

    Route::get('/customer_addresses','AddressController@customer_addresses');
    
    Route::get('/customer_wishlist','WishlistController@customer_wishlist');

    Route::get('/create_new_address','AddressController@create_new_address');

    Route::post('/add_new_address','AddressController@add_new_address');

    Route::get('/delete_address/{id}','AddressController@delete_address');
    
    Route::get('/customer_notifications','CustomerController@customer_notifications');

    Route::get('/unlike_product/{id}','WishlistController@unlike_product');

    Route::get('/like_product/{id}','WishlistController@like_product');

    Route::get('/remove_from_wishlist/{id}','WishlistController@remove_from_wishlist');

    Route::get('/customer_orders','OrderController@customer_orders');

    Route::get('/cancel_order/{id}','OrderController@cancel_order');

    Route::get('/customer_settings','CustomerController@customer_settings');

    Route::post('/customer_change_password','CustomerController@customer_change_password');

    Route::post('/mark_as_default','AddressController@mark_as_default');


});
