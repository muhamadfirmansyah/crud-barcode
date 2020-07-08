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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true, 'middleware' => ['auth', 'verified']]);

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('products', 'ProductsController');

// Route::get('qr-code', function () {
    // return QrCode::size(500)->generate('Welcome to kerneldev.com!');
// });

// Route::get('/intervention', function()
// {
//     $img = Image::make('https://dummyimage.com/300.png/09f/fff')->fit(200);

//     return $img->response('jpg');
// });