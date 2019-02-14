<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

Route::get('/', 'EventsController@events')->name('events');//displays all events
Route::get('/contact', 'PagesController@contact');//shows Contact Us page
Route::get('events/category/{slug}', 'EventsController@browsecategory');//browse by category page
Route::get('event/{slug}', 'EventsController@event');//show single event

//cart
Route::get('cart', 'CartController@index')->name('cart');
Route::post('cart', 'CartController@store');
Route::post('removeitem', 'CartController@remove');

//buy tickets
Route::group(['middleware'=>'auth'], function(){
Route::get('event/buytickets/{slug}', function($slug){
    $event = App\Event::where('slug', '=', $slug)->firstOrFail();
    return view('buytickets', compact('event'));
});
});
Route::post('saveBillingData', 'PaymentController@saveBillingData');

//pay with paypal
//payment form
Route::get('ticketpurchase', 'PaymentController@index');

// route for processing payment
Route::post('paypal', 'PaymentController@payWithpaypal');

// route for check status of the payment
Route::get('status', 'PaymentController@getPaymentStatus');

//route for viewing profile
Route::get('user/{id}', 'UsersController@index');
//Route for editing profile
Route::get('user/{id}/edit', 'UsersController@showedit');

//admin route
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
