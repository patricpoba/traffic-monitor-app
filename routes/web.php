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

Route::view('/', 'welcome');
 
Route::view('blog',         "pages.blog");
Route::view('about',        "pages.about");
Route::view('team',         "pages.team");
Route::view('services',     "pages.services");
Route::view('leadership',   "pages.leadership");
Route::view('contact',      "pages.contact");

Route::get('blog',       function () { return view('pages.default',  ['page'=> 'blog']); });
Route::get('about',      function () { return view('pages.default',  ['page'=> 'about']); });
Route::get('team',       function () { return view('pages.default',  ['page'=> 'team']); });
Route::get('services',   function () { return view('pages.default',  ['page'=> 'services']); });
Route::get('leadership', function () { return view('pages.default',  ['page'=> 'leadership']); });
Route::get('contact',    function () { return view('pages.default',  ['page'=> 'contact']); });


Auth::routes(['register'=> false]);


Route::group(['middleware' => ['auth']], function () {
    
    Route::redirect('/home', '/http-requests')->name('home');

    Route::resource('http-requests', 'HttpRequestController')->only('index');
});

