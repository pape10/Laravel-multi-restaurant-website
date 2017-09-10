<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'PagesController@getIndex');

//this route is for doing all the things with Restaurants
Route::resource('Restaurants','RestaurantController');

//this route is for seeing all hotels with locations------------middleware
  Route::group(['middleware' => 'location_session'], function () {

//this routes will be used to do all stuffs with cart
Route::post('Cart/{slug}',['as'=>'cart.set','uses'=>'CartsController@SetCart']);


//this route is for showing pages after location variable is present in the session
Route::get('Hotel/{slug}',['as'=>'Hotel.single','uses'=>'HotelController@getSingle'])->where('slug','[\w\d\-\_]+');

Route::get('Hotel/{slug}/filter/{cat_id}',['as'=>'Hotel.singlecategory','uses'=>'HotelController@getSingleCategory'])->where('slug','[\w\d\-\_]+');
Route::get('Location',['as'=>'Location.get','uses'=>'PagesController@GetLocationData']);

//this route is for seeing the cart
Route::get('cart',['as'=>'cart.get','uses'=>'CartsController@getCart']);
Route::get('checkout',['as'=>'checkout','uses'=>'CartsController@checkOut']);
Route::post('order',['as'=>'ordercomplete','uses'=>'CartsController@complete']);
Route::get('remove/{menu_id}',['as'=>'removefromcart','uses'=>'CartsController@remove']);
Route::get('remove',['as'=>'removeall','uses'=>'CartsController@Destroy']);
Route::post('coupon',['as'=>'coupon.set','uses'=>'CartsController@setCoupon']);
Route::get('contshop',['as'=>'continue.shopping','uses'=>'CartsController@bringSlug']);
 });


//this route iss for showing restaurants when the location is not set
Route::get('Hotels',['as'=>'Hotels.all','uses'=>'HotelWithoutLocationController@getAllWithoutLocation']);
Route::get('Hotels/{slug}',['as'=>'Hotels.single','uses'=>'HotelWithoutLocationController@getSingle'])->where('slug','[\w\d\-\_]+');

Route::get('Hotels/{slug}/filters/{cat_id}',['as'=>'Hotels.singlecategory','uses'=>'HotelWithoutLocationController@getSingleCategory'])->where('slug','[\w\d\-\_]+');



//this routes are for authentication
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('restaurant_owner/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('restaurant_owner/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/restaurant_owner', 'AdminController@index')->name('admin.dashboard');
Route::get('/restaurant_owner/orders','AdminController@orders')->name('admin.orders');


//this route is to do stuff with locations
Route::resource('Admin/locations','LocationsController');


//this route is to do stuff with services
Route::resource('Admin/services','ServicesController');

//this route is to do stuffs with coupons
Route::resource('Admin/coupons','CouponsController');


//this route is to do stuffs with coupons
Route::resource('Admin/tables','TablesController');


//this route is to do stuff with categories
Route::get('Admin/categories/create/{rest_id}',['as'=>'categories.create','uses'=>'CategoriesController@createPage']);
Route::post('Admin/categories/{rest_id}',['as'=>'categories.store','uses'=>'CategoriesController@store']);
Route::get('Admin/categories/{rest_id}',['as'=>'categories.index','uses'=>'CategoriesController@index']);


//this routes will do stuff with menus
Route::get('Admin/restaurant/categories/{cat_id}/create',['as'=>'menus.create','uses'=>'MenuController@create']);
Route::post('Admin/restaurant/categories/{cat_id}/store',['as'=>'menus.store','uses'=>'MenuController@store']);
Route::get('Admin/restaurant/categories/{cat_id}/index',['as'=>'menus.index','uses'=>'MenuController@index']);
Route::delete('Admin/restaurant/categories/{cat_id}/index',['as'=>'menus.destroy','uses'=>'MenuController@destroy']);


//this route is to take location id from select location form and go to controller that will save the session

Route::post('Location',['as'=>'Location.set','uses'=>'PagesController@SetLocation']);




//this routes will show contact us ,faqs,about us and all those
Route::get('about',['as'=>'aboutus','uses'=>'PagesController@getAboutUs']);
Route::get('terms',['as'=>'terms','uses'=>'PagesController@getTerms']);
Route::get('polices',['as'=>'privacypolicies','uses'=>'PagesController@privacyPolices']);
Route::get('faqs',['as'=>'faqs','uses'=>'PagesController@getFaqs']);

//for saving message
Route::post('message/save',['as'=>'savemessage','uses'=>'PagesController@saveMessage']);


//this routes are for showing orders
Route::get('showOrders',['as'=>'show.orders','uses'=>'OrdersController@showAll']);
Route::get('ShowOrders/{rest_id}',['as'=>'show.order.ind','uses'=>'OrdersController@showInd']);

Route::get('table',['as'=>'table.show','uses'=>'PagesController@tableShow']);
Route::get('table/{id}/book',['as'=>'table.book','uses'=>'PagesController@tableBookForm']);
Route::post('table{id}',['as'=>'table.confirm','uses'=>'PagesController@completeTable']);