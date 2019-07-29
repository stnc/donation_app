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
//https://appdividend.com/2018/09/06/laravel-5-7-crud-example-tutorial/


///https://designrevision.com/demo/shards-dashboards/index.html





// backend routes http://www.w3programmers.com/laravel-route-groups/



//Route::resource('posts','PostsController');
Route::get('/author/add', 'AuthorsController@add')->name('author.add');


//https://stackoverflow.com/questions/50427439/larael-add-custom-middleware-to-route-group
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/', 'Auth\LoginController@showLoginForm');

    Route::get('home', 'HomeController@index');
    Route::resource('kumbara', 'KumbaraAdminController');
    Route::resource('rehber', 'RehberAdminController');
    Route::resource('smstaslak', 'SmsTaslakAdminController');
    Route::resource('sendSms', 'SendSmsAdminController');



        //ajax il ve ilçe 
    Route::get('get-state-list','KumbaraAdminController@getStateList');

    //ajax sms draft list
    Route::get('get-smstaslak-list','SendSmsAdminController@getSmsTaslakList');


    Route::group(['prefix' => 'account'], function () {
        Route::get('login', 'Auth\LoginController@showLoginForm');
        Route::post('login', 'Auth\LoginController@login')->name('admin.login');
        Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');
        Route::get('register', 'Auth\RegisterController@showRegistrationForm');
        Route::post('register', 'Auth\RegisterController@register')->name('admin.register');
    });




});

Route::get('posts/getfaproduct', 'Admin\KumbaraAdminController@dtajax')->name('posts/getfaproduct');
Route::get('posts/getrehberlist', 'Admin\RehberAdminController@dtajax')->name('posts/getrehberlist');
Route::get('posts/getsmstaslaklist', 'Admin\SmsTaslakAdminController@dtajax')->name('posts/getsmstaslaklist');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
