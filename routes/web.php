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
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');//verified user route

Route::get('/', 'EventsController@events')->name('events');//displays all events
Route::get('events/category/{slug}', 'EventsController@browsecategory');//browse by category page
Route::get('event/{slug}', 'EventsController@event');//show single event

//Contact Us Form
Route::get('contact', 'PagesController@contact')->name('contact');//shows Contact Us page
Route::post('/contactmail', 'PagesController@contactmail')->name('contactmail');//shows Contact Us page


Route::get('/checkout', 'PagesController@checkout');//shows checkout page


//ADMIN REPORTS ROUTES!
Route::group(['middleware'=>'auth'], function() {
    Route::get('/reports', 'PagesController@reports');//shows reports page
    Route::get('/sortreports', 'PagesController@sort');//shows sorted reports page
});

Route::get('/instructions', 'PagesController@instructions');//shows reports page

Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');//verify registered users

//qr-code test
Route::get('qrcode', function () {
    $image = QrCode::format('png')
        ->color(255, 0, 127)
        ->size(500)
        ->generate("jjjjppppp");

    return response($image)->header('Content-type','image/png');
});

//search for an event
Route::get('/search', 'EventsController@search')->name('search');

//bookmarking routes
Route::group(['middleware'=>'auth'], function() {
    Route::get('bookmark/{id}', 'bookmarksController@create')->name('bookmark');//add to bookmarks db
    Route::get('bookmarks', 'bookmarksController@index')->name('bookmarks');//show bookmarks view
    Route::get('delete_bookmark/{id}', 'bookmarksController@destroy')->name('delete_bookmark');//show bookmarks view
});

//buy tickets
Route::group(['middleware'=>'auth'], function(){
Route::get('event/buytickets/{slug}', function($slug){
    $event = App\Event::where('slug', '=', $slug)->firstOrFail();
    $user = auth()->user();
    return view('buytickets', compact('event','user'));
});
});
Route::post('saveBillingData', 'PaymentController@saveBillingData');

//pay with paypal
//payment form
Route::get('ticketpurchase', 'PaymentController@index');

// route for processing payment
Route::post('paypal', 'PaymentController@payWithpaypal');

// route for check status of the payment
Route::get('status/{event_id}/{quantity}', 'PaymentController@getPaymentStatus');



//USER ROUTES!
//route for viewing profile
Route::get('user', 'UsersController@index');

//Route for editing profile
Route::post('user/edit', 'UsersController@showedit')->name('edit');
Route::post('update-info', 'UsersController@editinfo')->name('editinfo');

//shows Report an issue page
Route::post('user/cancelticket', 'UsersController@cancelticket')->name('cancelticket');
Route::post('user/cancelticketmail', 'UsersController@cancelticketmail')->name('cancelticketmail');



//admin route
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
//HOME-PAGE ROUTE
Route::get('/home', 'HomeController@index')->name('home');
