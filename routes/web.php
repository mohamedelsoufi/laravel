<?php

use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/test1', function () {
//     return 'Welcome';
// })->name('a');

Route::get('/show-number/{id}', function ($id) {
    return $id;
})->name('b');

// Route::get('/show-string/{id?}', function () {
//     return 'wel';
// });

//// route namespace

//Route::namespace('Front')->group(function (){
//    // all routes only access to controller or methods in Front
//
//    Route::get('users', 'UserController@ShowUserName');
//});

//prefix

//Route::prefix('users')->group(function (){
//    Route::get('users', 'UserController@ShowUserName');
//    Route::delete('users', 'UserController@ShowUserName');
//    Route::post('users', 'UserController@ShowUserName');
//    Route::put('users', 'UserController@ShowUserName');
//    Route::patch('users', 'UserController@ShowUserName');
//});

// grouping

// Route::group(['prefix' => 'users'], function () {
//     //set of routes
//     Route::get('/', function () {
//         return 'work';
//     });
//     Route::get('users', 'UserController@ShowUserName');
//     Route::delete('users', 'UserController@ShowUserName');
//     Route::post('users', 'UserController@ShowUserName');
//     Route::put('users', 'UserController@ShowUserName');
//     Route::patch('users', 'UserController@ShowUserName');
// });

// Route::get('second', 'Admin\SecondController@ShowString' );

// Route::namespace('Admin')->group(function(){
//     Route::get('second', 'SecondController@ShowString' );
// });

// Route::group(['namespace' => 'Admin'], function () {
//     Route::get('second', 'SecondController@ShowString')->middleware('auth');
//     Route::get('second2', 'SecondController@ShowString2');
//     Route::get('second3', 'SecondController@ShowString3');
//     Route::get('second4', 'SecondController@ShowString4');
// });

// Route::get('login', function () {
//     return 'you must login first';
// })->name('login');

// Route::resource('news', 'NewsController');

// Route::get('landing', function () {
//     return view('landing');
// });

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/redirect/{service}', 'SocialController@redirect');
Route::get('/callback/{service}', 'SocialController@callback');

Route::get('fillable','CrudController@getOffers');

Route::group(['prefix'=>'offers'], function (){
    //Route::get('store', 'CrudController@store');

    Route::get('create','CrudController@create');
    Route::post('store','CrudController@store') -> name('offers.store');
});
