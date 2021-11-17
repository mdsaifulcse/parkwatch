<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//


Route::group(['middleware' => 'api','namespace' => 'Api\V1',], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('login-driveway', 'AuthController@drivewayLogin');

    Route::post('logout', 'AuthController@logout');
    //Route::post('logout-driveway', 'AuthController@drivewayLogout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
// --------- Client-My Profile Related  ----------
Route::group(['namespace'=>'Api\V1','middleware' => ['auth:api']],function (){

    // --------- Schedule & Booking ----------
    Route::POST('/booking/place-booking-order','BookingApiController@storeBookingOrder');


    // --------- My Profile Related  ----------
    Route::get('my-profile','MyProfileController@getMyProfileData');
    Route::PUT('my-profile-update','MyProfileController@myProfileUpdate');
    Route::POST('my-password-change','ResetPasswordApiController@changeMyPassword');

    Route::resource('app-preference-setting','AppPreferenceController');

    Route::get('find-parking-spot','SearchController@findParkingSpot');
    Route::GET('find-parking-spot-by-id/{parkingId}','SearchController@findParkingSpotByParkingId');

    Route::POST('rent-out-my-parking-space','MyProfileController@rentOutMyParkingSpot');

    // --------- Point Calculation & Point Notification  ----------
    Route::POST('store-point','UserPointController@store');
    Route::get('choose-point-gift/{notificationId}','UserPointController@generatePointGift');
    Route::get('user-wise-point-notification/{clientId?}','UserPointController@getUserWisePointNotification');
    Route::POST('save-point-notification','UserPointController@savePointNotification');

});

// --------- Driveway My Profile Related  ----------
Route::group(['namespace'=>'Api\V1','middleware' => ['drivewayApi']],function (){

    Route::GET('driveway-profile','DrivewayController@getMyProfileData');
    Route::PUT('driveway-profile-update','DrivewayController@myProfileUpdate');

    Route::GET('driveway-parking-spots','DrivewayController@myParkingSpots');
    Route::GET('driveway-parking-spot-by-id/{parkingId}','DrivewayController@parkingSpotByParkingId');


    Route::POST('rent-out-driveway-parking-space','DrivewayController@rentOutMyParkingSpot');
    Route::PUT('update-driveway-parking-space','DrivewayController@updateDrivewayParkingSpot');
});


Route::group(['namespace'=>'Api\V1'],function (){
    Route::post('register','ClientRegisterController@register');


    Route::get('parking-interest','CommonFunctionController@clientParkingInterest');
    Route::get('parking-price-unit','CommonFunctionController@parkingPriceUnite');
    Route::get('vehicle-size','CommonFunctionController@getVehicleSizeData');
    Route::post('check-user-unique-identity','CommonFunctionController@uniqueUserValidation');

    Route::get('/faq-term-policy/{type?}','FaqApiController@getActiveFaqTermPolicy');
    Route::get('/about-company','CommonFunctionController@getAboutCompany');

    // --------- Send OTP & Reset Password  ----------
    Route::POST('send-reset-password-otp','ResetPasswordApiController@getResetPasswordOptToEmail');
    Route::POST('reset-password-by-otp','ResetPasswordApiController@verifyOtpAndResetPassword');

    // --------- Biggapon Related  ----------
    Route::GET('biggapon-data/{place?}','BiggaponApiController@getBiggaponInfo');

});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
