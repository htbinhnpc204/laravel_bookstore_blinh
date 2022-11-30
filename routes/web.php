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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::prefix('')->group(function () {
    Route::get('/', [
        'as' => 'index',
        'uses' => 'HomeController@index'
    ]);

    Route::get('/2',function (){
        return view('layout');
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/category/{cd_id}', [
        'as' => 'home.category',
        'uses' => 'HomeController@category'
    ]);

    Route::get('/test', function (){
        $details =  DB::table('order_details')->where('book_id',4);
        $result =
            DB::table('orders')->where('orders.user_id',\auth()->user()->id)
                ->join('order_details', 'order_details.order_id', '=', 'orders.id')
                ->where('order_details.book_id', 2);

        dd($result->get());
    });


    Route::get('/book/{book_id}', [
        'as' => 'buy',
        'uses' => 'HomeController@buy'
    ]);

    Route::post('/review/{detail}', [
        'as' => 'review',
        'uses' => 'HomeController@review'
    ]);

    Route::post('/search', [
        'as' => 'search',
        'uses' => 'LiveSearchController@doSearch'
    ]);

    Route::get('/xmlsearch/{query}', [
        'as' => 'xmlsearch',
        'uses' => 'LiveSearchController@xmlsearch'
    ]);

    Route::get('/cart', [
        'as' => 'cart.details',
        'uses' => 'CartController@view'
    ]);

    Route::post('/cart_add/{id}', [
        'as' => 'cart.add',
        'uses' => 'CartController@addToCart'
    ]);

    Route::get('/create_order', [
        'as' => 'cart.create_order',
        'uses' => 'CartController@create_order'
    ]);

    Route::view('/checkout', 'checkout')->name('checkout');

    Route::post('/cart/update', [
        'as' => 'cart.update',
        'uses' => 'CartController@updateCart'
    ]);

    Route::get('/cart_delete/{id}', [
        'as' => 'cart.delete',
        'uses' => 'CartController@deleteItem'
    ]);

    Route::get('/get_bill/{id}', [
        'as' => 'cart.bill',
        'uses' => 'CartController@printBill'
    ]);

    Route::get('/profile', [
        'as' => 'profile',
        'uses' => 'HomeController@profile'
    ]);

    Route::get('/profile/update', [
        'as' => 'profile.update',
        'uses' => 'HomeController@updateinfo'
    ]);

    Route::post('/profile/update/{id}', [
        'as' => 'profile.doUpdateuser',
        'uses' => 'HomeController@doUpdateuser'
    ]);

    Route::get('/category/{cd_id}', [
        'as' => 'home.category',
        'uses' => 'HomeController@category'
    ]);

    Route::get('/all-product', [
        'as' => 'home.shop',
        'uses' => 'HomeController@all_product'
    ]);

    Route::post('/product/filter', [
        'as' => 'shop.filter',
        'uses' => 'HomeController@filter'
    ]);

    Route::get('/product/filter', [
        'as' => 'shop.filter',
        'uses' => 'HomeController@filter'
    ]);
});

//region google login
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

Route::get('google/callback', [
        'as' => 'login.google',
        'uses' => 'Auth\LoginController@handleProviderCallback'
]);
//endregion

Route::prefix('admin')->group(function () {
    Route::get('/', [
        'as' => 'admin.index',
        'uses' => 'AdminController@index']);

    Route::get('/dashboard', [
        'as' => 'admin.dashboard',
        'uses' => 'AdminController@dashboard']);

    Route::get('/category', [
        'as' => 'category',
        'uses' => 'CategoryController@index'
    ]);

    Route::get('/category/delete/{id}', [
        'as' => 'category.delete',
        'uses' => 'CategoryController@delete'
    ]);

    Route::post('/category/add', [
        'as' => 'category.add',
        'uses' => 'CategoryController@add'
    ]);

    Route::post('/category/edit/{id}', [
        'as' => 'category.edit',
        'uses' => 'CategoryController@edit'
    ]);

    Route::get('/updateinfo', [
        'as' => 'admin.info',
        'uses' => 'AdminController@updateinfo'
    ]);

    Route::get('/book', [
        'as' => 'admin.book',
        'uses' => 'BookController@index'
    ]);

    Route::get('/book/edit/{id}', [
        'as' => 'book.edit',
        'uses' => 'BookController@edit'
    ]);

    Route::post('/book/store', [
        'as' => 'book.store',
        'uses' => 'BookController@store'
    ]);

    Route::post('/book/insert/list', [
        'as' => 'book.insert.list',
        'uses' => 'BookController@insertList'
    ]);

    Route::get('/book/delete/{id}', [
        'as' => 'book.delete',
        'uses' => 'BookController@delete'
    ]);

    Route::get('/book/export', [
        'as' => 'book.export',
        'uses' => 'BookController@export'
    ]);

    Route::get('/user', [
        'as' => 'admin.user',
        'uses' => 'UserController@index'
    ]);

    Route::post('/user/store', [
        'as' => 'user.store',
        'uses' => 'UserController@store'
    ]);

    Route::post('/user/update', [
        'as' => 'user.update',
        'uses' => 'UserController@update'
    ]);

    Route::get('/user/edit/{id}', [
        'as' => 'user.edit',
        'uses' => 'UserController@edit'
    ]);

    Route::get('/user/delete/{id}', [
        'as' => 'user.delete',
        'uses' => 'UserController@delete'
    ]);

    Route::get('/order', [
        'as' => 'admin.order',
        'uses' => 'OrderController@index'
    ]);

    Route::post('/order', [
        'as' => 'order.store',
        'uses' => 'OrderController@store'
    ]);

    Route::get('/order/view/{id}', [
        'as' => 'order.view',
        'uses' => 'OrderController@view'
    ]);

    Route::get('/order/approve/{id}', [
        'as' => 'order.approve',
        'uses' => 'OrderController@approve'
    ]);

    Route::get('/order/delete/{id}', [
        'as' => 'order.delete',
        'uses' => 'OrderController@delete'
    ]);

    Route::post('/update/profile/{id}', [
        'as' => 'profile.doUpdate',
        'uses' => 'ProfileController@doUpdate'
    ]);
});


