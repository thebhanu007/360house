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
//new site routes
Route::get('/new-site', 'WebsiteController@index');
Route::get('/new-site/sale', 'WebsiteController@sale');
Route::get('/new-site/sale/{id}', 'WebsiteController@page_ads');
Route::get('/new-site/help', 'WebsiteController@help');
Route::get('/new-site/tariffs', 'WebsiteController@tariffs');
Route::get('/new-site/register', 'WebsiteController@registerForm')->middleware('guest')->name('register');
Route::post('/new-site/register', 'WebsiteController@register');
Route::get('/new-site/login', 'WebsiteController@loginForm')->middleware('guest')->name('login');
Route::post('/new-site/login', 'WebsiteController@login');



// old site routes
Route::get('/', 'PageController@index')->name('index');
Route::get('/login', 'UserController@loginForm')->middleware('guest')->name('login');
Route::post('/login', 'UserController@login');
Route::get('/register', 'UserController@registerForm')->middleware('guest')->name('register');
Route::post('/register', 'UserController@register');
Route::get('/restore', 'UserController@restoreForm')->middleware('guest')->name('restore');
Route::post('/restore', 'UserController@restore');
Route::get('/password', 'UserController@passwordForm')->middleware('guest')->name('password');
Route::post('/password', 'UserController@password');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/sale', 'ObjectController@index')->name('sale');
Route::get('/rent', 'ObjectController@index')->name('rent');
Route::get('/sale/{id}', 'ObjectController@show')->name('sale.show');
Route::get('/rent/{id}', 'ObjectController@show')->name('rent.show');
Route::get('/pano/{id}', 'ObjectController@show')->name('pano.show');
Route::post('/phone/{id}', 'ObjectController@phone')->name('object.phone');
Route::post('mapobjects', 'ObjectController@mapObjects');
Route::post('create/scene', 'ObjectController@addScene');
Route::get('js/pano/{id}', 'ObjectController@panoramaJs');
Route::post('cities', 'ObjectController@ajaxCity');
Route::get('embed/{id}', 'ObjectController@embed')->name('objects.embed');
Route::get('convert', 'ConvertController@form')->name('convert');
Route::post('convert', 'ConvertController@convert');
Route::get('contacts', 'PageController@contacts');
Route::get('help', 'PageController@help');
Route::get('partners', 'PageController@feedback')->name('feedback');
Route::post('partners', 'PageController@feedbackSend')->name('partners');
Route::post('order-form', 'PageController@feedbackSend');
Route::post('report-form', 'PageController@reportSend');

Route::get('about', 'PageController@about')->name('about');
Route::get('education', 'PageController@education')->name('education');
Route::post('contact-form', 'PageController@contactSend');
//Route::get('contact-form', 'PageController@contactSend');

Route::get('scenes/{id}/{file_name}', 'ObjectController@sceneImage');
Route::post('upload-documents', 'ObjectController@upload_documents');

Route::group(['middleware' => ['login']], function() {
	Route::post('delete/scene/{id}', 'ObjectController@deleteScene');
	Route::post('delete/mark/{id}', 'ObjectController@deleteMark');
	Route::get('edit/{id}', 'ObjectController@edit')->name('object.edit');
	Route::post('edit/{id}', 'ObjectController@update');
	Route::get('create', 'ObjectController@create')->name('object.create');
	Route::post('create', 'ObjectController@store');
	Route::get('profile', 'UserController@profile')->name('profile');
	Route::post('profile', 'UserController@profileSave');
	Route::get('objects', 'ObjectController@userObjects')->name('objects');
	Route::delete('objects/{id}', 'ObjectController@destroy')->name('objects.destroy');
	Route::get('pay/success', 'PaymentController@paymentSuccess')->name('pay.success');
	Route::get('pay/error', 'PaymentController@paymentError')->name('pay.error');
	Route::get('pay/{id}/choose', 'PaymentController@paymentPage')->name('pay.choose');
	Route::post('pay/{id}/choose', 'PaymentController@paymentPageSubmit');
	Route::get('pay/{id}', 'PaymentController@paymentRedirectPage')->name('pay');
	Route::post('pay/{id}', 'PaymentController@paymentRedirectPageSubmit');
	Route::get('pay/new/{id}', 'PaymentController@newObjectPayment')->name('pay.new');
	Route::get('pay/extend/{id}', 'PaymentController@extend')->name('pay.extend');
	Route::get('packs', 'PackController@buyPage')->name('packs');
	Route::get('packs/{id}', 'PackController@buy')->name('packs.buy');
	Route::post('cost/{id}', 'ObjectController@cost');
	//Route::get('download/{id}', 'ObjectController@download')->name('objects.download');


	Route::get('/new-site/objects', 'WebsiteController@userObjects');

});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['admin']], function() {
	Route::get('options', 'OptionsController@edit')->name('admin.options');
	Route::post('options', 'OptionsController@update');
	Route::resource('users', 'UserController', ['as' => 'admin']);
});