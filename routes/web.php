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
Route::group(['middleware' => ['logHttpRequest'] ], function () {
    
    Route::view('/',         'welcome');
    Route::get('blog',       function () { return view('pages.default',  ['page'=> 'blog']); });
    Route::get('about',      function () { return view('pages.default',  ['page'=> 'about']); });
    Route::get('team',       function () { return view('pages.default',  ['page'=> 'team']); });
    Route::get('services',   function () { return view('pages.default',  ['page'=> 'services']); });
    Route::get('leadership', function () { return view('pages.default',  ['page'=> 'leadership']); });
    Route::get('contact',    function () { return view('pages.default',  ['page'=> 'contact']); });

});


Auth::routes(['register'=> false]);


Route::group(['middleware' => ['auth']], function () {
    
    Route::redirect('/home', '/http-requests')->name('home');

    Route::resource('http-requests', 'HttpRequestController')->only('index');
});


Route::get('/headers', function (\Illuminate\Http\Request $request)
{
    // return $request->header();
    return $request->headers->get('user-agent');
});