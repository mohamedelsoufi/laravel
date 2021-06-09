<?php

use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//Route::get('/', function () {
//    return view('welcome');
//});

// Route::get('/test1', function () {
//     return 'Welcome';
// })->name('a');

//Route::get('/show-number/{id}', function ($id) {
//    return $id;
//})->name('b');

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

define('PAGINATION_COUNT', 2);

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function() {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes(['verify' => true]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

###################### Begin Facebook register #########################################################################
    Route::get('/redirect/{service}', 'SocialController@redirect');
    Route::get('/callback/{service}', 'SocialController@callback');
###################### End Facebook register ###########################################################################

    Route::get('fillable', 'CrudController@getOffers');

###################### Begin CRUD ######################################################################################
    Route::group(['prefix' => 'offers'], function () {

        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('create', 'CrudController@create')->name('offers.create');
        Route::get('index', 'CrudController@index')->name('offers.index');
        Route::get('get-all-inactive-offers', 'CrudController@getAllInActiveOffers')->name('offers.index');
        Route::get('edit/{id}', 'CrudController@edit');
        Route::get('delete/{id}', 'CrudController@delete')->name('offers.delete');
        Route::post('update/{id}', 'CrudController@update')->name('offers.update');
    });
###################### End CRUD ########################################################################################

###################### Begin Youtube Viewers Counter ###################################################################
    Route::group(['middleware' => 'auth'], function () {
        Route::get('youtube', 'CrudController@getVideo')->name('youtube');
    });
###################### End Youtube Viewers Counter #####################################################################


###################### Begin Ajax CRUD #################################################################################
    Route::group(['prefix' => 'ajax-offers'], function () {
        Route::get('create', 'OfferController@create')->name('ajaxOffers.create');
        Route::post('store', 'OfferController@store')->name('ajaxOffers.store');
        Route::get('index', 'OfferController@index')->name('ajaxOffers.index');
        Route::post('delete', 'OfferController@delete')->name('ajaxOffers.delete');
        Route::get('edit/{id}', 'OfferController@edit')->name('ajaxOffers.edit');
        Route::post('update', 'OfferController@update')->name('ajaxOffers.update');
    });
###################### End Ajax CRUD ###################################################################################


###################### Begin Middleware ################################################################################

    Route::group(['middleware' => 'CheckAge', 'namespace' => 'Auth'], function () {
        Route::get('adults', 'CustomAuthController@adult')->name('adults');

    });
###################### End Middleware ##################################################################################

###################### Begin Authentication and Guards #################################################################
    Route::get('admin/admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');
    Route::get('front/user', 'Auth\CustomAuthController@user')->middleware('auth:web')->name('user');
    Route::get('admin/login', 'Auth\CustomAuthController@login')->name('Admin.login');
    Route::post('admin/logins', 'Auth\CustomAuthController@Checklogin')->name('save.admin.login');
###################### End Authentication and Guards ###################################################################

###################### Begin Relation Routes ###########################################################################
    Route::get('one-To-one', 'RelationsController@oneToOne');
    Route::get('one-To-one-reverse', 'RelationsController@oneToOneReverse');
    Route::get('get-user-has-phone', 'RelationsController@getUserHasPhone');
    Route::get('get-user-not-has-phone', 'RelationsController@getUserNotHasPhone');
###################### End Relation Routes #############################################################################

####################### Begin Relation One To Many Routes ##############################################################
    Route::get('hospitals-one-To-many', 'RelationsController@getHospitalDoctors');
    Route::get('hospitals', 'RelationsController@hospitals');
    Route::get('doctors/{id}', 'RelationsController@doctors')->name('hospital.doctors');
    Route::get('hospital/{id}', 'RelationsController@deleteHospital')->name('hospital.delete');

    Route::get('hospitals_has_doctors', 'RelationsController@hospitals_has_doctors');
    Route::get('hospitals_has_doctors_male', 'RelationsController@hospitals_has_doctors_male');
    Route::get('hospitals_has_not_doctors', 'RelationsController@hospitals_has_not_doctors');
###################### End Relation One To Many Routes  ################################################################

###################### Begin Relation Many To Many Routes ##############################################################
    Route::get('doctors-services', 'RelationsController@getDoctorService');
    Route::get('service-doctors', 'RelationsController@getServiceDoctors');

    Route::get('doctor-services/{id}', 'RelationsController@getDoctorServices')->name('doctor.services');
    Route::post('save-services-to-doctor', 'RelationsController@SaveServicesToDoctor')->name('save.doctor.services');
###################### End Relation Many To Many Routes  ###############################################################

###################### Begin Relation has one through Routes  ##########################################################
    Route::get('has-one-through', 'RelationsController@getPatientDoctor');
    Route::get('has-many-through', 'RelationsController@getCountryDoctors');
###################### End Relation has one throughy Routes  ###########################################################


####################### Begin Accessors and Mutators Routes  ##########################################################
    Route::get('accessors', 'RelationsController@getDoctors');
###################### End Accessors and Mutators Routes  ###########################################################
});

