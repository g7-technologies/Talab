<?php

use Illuminate\Http\Request;

//-----------------------------Customer Signup Routes-----------------------------
Route::post('/register_customer','API\CustomerController@register_customer');
Route::post('/customer_social_login','API\CustomerController@customer_social_login');

//-----------------------------Customer Auth Routes-----------------------------
Route::post('/login_customer','API\CustomerController@login_customer');

//-----------------------------Customer Profile Routes-----------------------------
Route::post('/customer_change_email','API\CustomerController@customer_change_email');
Route::post('/customer_change_phone','API\CustomerController@customer_change_phone');
Route::post('/customer_change_password','API\CustomerController@customer_change_password');
Route::post('/customer_update_profile','API\CustomerController@customer_update_profile');
Route::post('/customer_set_password','API\CustomerController@customer_set_password');
Route::post('/customer_orders','API\CustomerController@customer_orders');

//-----------------------------Customer Address Routes-----------------------------
Route::post('/customer_get_address','API\AddressController@customer_get_address');
Route::post('/customer_add_address','API\AddressController@customer_add_address');
Route::post('/customer_delete_address','API\AddressController@customer_delete_address');

//-----------------------------Customer Send Otp-----------------------------
Route::post('/customer_send_otp','API\CustomerController@customer_send_otp');

//-----------------------------FAQS Routes------------------------------------------
Route::post('/get_faqs','API\FaqsController@get_faqs');

//-----------------------------Privacy policy Routes---------------------------------
Route::post('/get_privacy_policy','API\PrivacyPolicyController@get_privacy_policy');

//-----------------------------Terms & conditions Routes-----------------------------
Route::post('/get_terms_and_conditions','API\TermsAndConditionsController@get_terms_and_conditions');

//-----------------------------Customer Home Screen Routes---------------------------
Route::post('/customer_home','API\CustomerController@customer_home');

//-----------------------------Customer Like unlike resturant route------------------
Route::post('/like_unlike_resturant','API\LikedResturantsController@like_unlike_resturant');
Route::post('/liked_resturant','API\LikedResturantsController@liked_resturant');


//-----------------------------Customer switch notifications------------------
Route::post('/customer_switch_notifications','API\CustomerController@customer_switch_notifications');

//-----------------------------Delivery boy Auth route--------------------------------
Route::post('/delivery_boy_login','API\DeliveryBoyController@delivery_boy_login');

//-----------------------------Delivery boy Signup Routes-----------------------------
Route::post('/delivery_boy_register','API\DeliveryBoyController@register_delivery_boy');
Route::post('/pending_orders','API\DeliveryBoyController@pending_orders');

//-----------------------------Delivery Boy Profile Routes-----------------------------
Route::post('/delivery_boy_update_profile','API\DeliveryBoyController@delivery_boy_update_profile');
Route::post('/delivery_boy_change_email','API\DeliveryBoyController@delivery_boy_change_email');
Route::post('/delivery_boy_change_phone','API\DeliveryBoyController@delivery_boy_change_phone');
Route::post('/delivery_boy_change_password','API\DeliveryBoyController@delivery_boy_change_password');
Route::post('/delivery_boy_set_password','API\DeliveryBoyController@delivery_boy_set_password');
Route::post('/check_delivery_availability','API\DeliveryBoyController@check_delivery_availability');
//-------------------------------Card Detail-------------------------------------------------
Route::post('/card_details','API\CardController@save_card_details');
Route::post('/cards_list','API\CardController@cards_list');
Route::post('/delete_card','API\CardController@delete_card');

//-------------------------------Place Order-------------------------------------------------
Route::post('/place_order','API\MealOrderController@place_order');
Route::post('/pickup_order','API\MealOrderController@pickup_order');

Route::post('/customer_review','API\MealOrderController@customer_review');
Route::post('/complete_order','API\MealOrderController@complete_order');

//-------------------------------create dispute-------------------------------------------------
Route::post('/create_dispute','API\DisputeController@create_dispute');



Route::get('/test/{id}','API\MealOrderController@test');