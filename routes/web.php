<?php
/*
|-----------------------------------------------------------
| COMMON SECTION
|-----------------------------------------------------------
*/
Route::get('/test', function (){
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    dd('done');
});

Route::post('/password/email', 'CommonFunctionController@mail');
#authentication 
Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();

#corn job
Route::get('sms/jobs', 'Admin\SmsCampaignController@jobs');
Route::get('email/jobs', 'Admin\EmailCampaignController@jobs');

#client contact data
Route::get('client/contact/data', 'Admin\ClientController@getClientContactData');
Route::get('client/contact/email', 'Admin\ClientController@getEmail');
Route::get('client/contact/mobile', 'Admin\ClientController@getMobile');

/*
|-----------------------------------------------------------
| WEBSITE SECTION
|-----------------------------------------------------------
*/
#website
Route::get('/', 'Website\HomeController@index');
Route::get('website', 'Website\HomeController@index');

Route::post('website/auth/register', 'Website\AuthController@register');
Route::post('website/auth/login', 'Website\AuthController@login');
Route::get('website/auth/logout', 'Website\AuthController@logout');
// need to completion
// not working yet!
Route::get('website/auth/account_confirmation', 'Website\AuthController@accountConfirmation');
// Route::post('website/auth/forgot_password', 'Website\AuthController@forgotPassword');
 
Route::post('website/mail/send', 'Website\MailController@send');
Route::get('website/language/{name}', 'Website\LanguageController@switchLanguage');
Route::get('website/home/parking/prices', 'Website\HomeController@getPrices');


/* Common Route For Admin and Website */

Route::get('load-parking-spot-by-parking-owner/{parkingOwnerId}', 'CommonFunctionController@getOwnerWiseParkingSpotData');

Route::get('load-state-by-country/{countryId}', 'CommonFunctionController@getCountryWiseStateData');
Route::get('load-city-by-state/{stateId}', 'CommonFunctionController@getStateWiseCityData');
Route::get('load-zone-by-city/{cityId}', 'CommonFunctionController@getCityWiseZoneData');


Route::group(["middleware" => ["roles:client"]], function() {

	Route::get('website/profile', 'Website\AuthController@profile');
	Route::get('website/profile/edit', 'Website\AuthController@profileEdit');
	Route::post('website/profile/edit', 'Website\AuthController@profileUpdate');
	Route::post('website/vehicle', 'Website\AuthController@newVehicle');
	Route::get('website/vehicle/status/{status}/{id}', 'Website\AuthController@statusVehicle');

	// Booking
	Route::get('website/booking', 'Website\BookingController@showForm');
	Route::post('website/booking/place_order', 'Website\BookingController@placeOrder');
	Route::get('website/booking/status', 'Website\BookingController@paymentStatus');

	Route::post('website/booking/period', 'Website\BookingController@getZoneAndVehicleWisePriceList');
	Route::post('website/booking/show-schedule', 'Website\BookingController@findScheduleAndPrice');
	Route::post('website/booking/promocode', 'Website\BookingController@getDiscount');

	Route::get('website/history', 'Website\BookingController@history');
	Route::get('website/booking/history-data', 'Website\BookingController@historyData');
	Route::get('website/booking/invoice', 'Website\BookingController@invoice');
});

/*
|-----------------------------------------------------------
| SUPER ADMIN & ADMIN SECTION
|-----------------------------------------------------------
*/

Route::group(["middleware" => ["auth", "roles:superadmin,admin,parkingowner"]], function() {
	# dashboard
	Route::get('dashboard', 'Admin\DashboardController@index');
	Route::get('admin/dashboard', 'Admin\DashboardController@index');

	# client
	Route::get('admin/client/new', 'Admin\ClientController@form');
	Route::post('admin/client/new', 'Admin\ClientController@create');
	Route::get('admin/client/list', 'Admin\ClientController@list');
	Route::get('admin/client/edit/{id}', 'Admin\ClientController@edit');
	Route::post('admin/client/edit', 'Admin\ClientController@update');
	Route::get('admin/client/delete/{id}', 'Admin\ClientController@delete');
	Route::get('admin/client/data', 'Admin\ClientController@getClientData');
	Route::get('admin/client/profile/{id}', 'Admin\ClientController@profile');

	Route::post('admin/client/vehicle', 'Admin\ClientController@newVehicle');
	Route::post('admin/client/vehicle/edit/{id}', 'Admin\ClientController@updateVehicle');
	Route::get('admin/client/vehicle/status/{status}/{id}', 'Admin\ClientController@statusVehicle');

	# vehicle list
	Route::get('admin/vehicle_type/new', 'Admin\VehicleTypeController@form');
	Route::post('admin/vehicle_type/new', 'Admin\VehicleTypeController@create');
	Route::get('admin/vehicle_type/list', 'Admin\VehicleTypeController@show');
	Route::get('admin/vehicle_type/edit/{id}', 'Admin\VehicleTypeController@editForm');
	Route::post('admin/vehicle_type/edit', 'Admin\VehicleTypeController@update');
	Route::get('admin/vehicle_type/delete/{id}', 'Admin\VehicleTypeController@delete');
	Route::get('admin/vehicle_type/data', 'Admin\VehicleTypeController@getAdminData');

	# place or park location
	Route::get('admin/place/new', 'Admin\PlaceController@form');
	Route::post('admin/place/new', 'Admin\PlaceController@create');
	Route::get('admin/place/list', 'Admin\PlaceController@list');
	Route::get('admin/place/edit/{id}', 'Admin\PlaceController@edit');
	Route::post('admin/place/edit', 'Admin\PlaceController@update');
	Route::get('admin/place/delete/{id}', 'Admin\PlaceController@delete');
	Route::get('admin/place/show/{id}', 'Admin\PlaceController@show');
	Route::get('admin/place/data', 'Admin\PlaceController@getListData');

	# price
	Route::get('admin/price/list', 'Admin\PriceController@list');
	Route::get('admin/price/data', 'Admin\PriceController@getPriceData');
	Route::get('admin/price/new', 'Admin\PriceController@form');
	Route::post('admin/price/new', 'Admin\PriceController@create');
	Route::get('admin/price/edit/{p_id}', 'Admin\PriceController@edit');
	Route::post('admin/price/edit', 'Admin\PriceController@update');
	Route::get('admin/price/delete/{p_id}', 'Admin\PriceController@delete');
	Route::get('admin/price/show/{p_id}', 'Admin\PriceController@show');

	# promocode
	Route::get('admin/promocode/new', 'Admin\PromocodeController@form');
	Route::post('admin/promocode/new', 'Admin\PromocodeController@create');
	Route::get('admin/promocode/edit/{id}', 'Admin\PromocodeController@edit');
	Route::post('admin/promocode/edit', 'Admin\PromocodeController@update');
	Route::get('admin/promocode/list', 'Admin\PromocodeController@show');
	Route::get('admin/promocode/data', 'Admin\PromocodeController@getPromocodeData');
	Route::get('admin/promocode/delete/{id}', 'Admin\PromocodeController@delete');

	# email
	Route::get('admin/email/new', 'Admin\EmailCampaignController@form');
	Route::post('admin/email/new', 'Admin\EmailCampaignController@send');
	Route::get('admin/email/list', 'Admin\EmailCampaignController@show');
	Route::get('admin/email/delete/{id}', 'Admin\EmailCampaignController@delete');
	Route::get('admin/email/data', 'Admin\EmailCampaignController@getCampaignData');
	Route::get('admin/email/setting', 'Admin\EmailCampaignController@setting');
	Route::post('admin/email/setting', 'Admin\EmailCampaignController@updateSetting');
	Route::get('admin/email/bulk', 'Admin\EmailCampaignController@bulk');
	Route::post('admin/email/bulk', 'Admin\EmailCampaignController@sendBulk');

	# sms
	Route::get('admin/sms/new', 'Admin\SmsCampaignController@form');
	Route::post('admin/sms/new', 'Admin\SmsCampaignController@send');
	Route::get('admin/sms/list', 'Admin\SmsCampaignController@show');
	Route::get('admin/sms/delete/{id}', 'Admin\SmsCampaignController@delete');
	Route::get('admin/sms/data', 'Admin\SmsCampaignController@getData');
	Route::get('admin/sms/setting', 'Admin\SmsCampaignController@setting');
	Route::post('admin/sms/setting', 'Admin\SmsCampaignController@updateSetting');

	# booking
	Route::get('admin/booking/form', 'Admin\BookingController@form');
	Route::post('admin/booking/place_order', 'Admin\BookingController@placeOrder');
	Route::get('admin/booking/invoice', 'Admin\BookingController@invoice');
	Route::get('admin/booking/release', 'Admin\BookingController@release');
	Route::get('admin/booking/fine', 'Admin\BookingController@fine');
	Route::get('admin/booking/payment_status', 'Admin\BookingController@paid');
	Route::get('admin/booking/{type}', 'Admin\BookingController@show');
	Route::get('admin/booking/get-data/{type}', 'Admin\BookingController@getData');
	Route::get('admin/booking/delete/{id_no}', 'Admin\BookingController@delete');

	Route::post('admin/booking/getZoneAndVehicleWisePriceList', 'Admin\BookingController@getZoneAndVehicleWisePriceList');
	Route::post('admin/booking/findScheduleAndPrice', 'Admin\BookingController@findScheduleAndPrice');
	Route::post('admin/booking/getPriceList', 'Admin\BookingController@getPriceList');
	Route::post('admin/booking/getDiscount', 'Admin\BookingController@getDiscount');
	Route::post('admin/booking/checkClientID', 'Admin\BookingController@checkClientID');
	Route::post('admin/booking/createClient', 'Admin\BookingController@createClient');

	# report
	Route::get('admin/report', 'Admin\ReportController@index');

	#message  
	Route::get('admin/message/new','Admin\MessageController@form'); 
	Route::post('admin/message/new','Admin\MessageController@new'); 
	Route::get('admin/message/inbox','Admin\MessageController@inbox');
	Route::get('admin/message/inbox/data','Admin\MessageController@getInboxData');
	Route::get('admin/message/sent','Admin\MessageController@sent'); 
	Route::get('admin/message/sent/data','Admin\MessageController@getSentData'); 
	Route::get('admin/message/details/{id}/{type}','Admin\MessageController@details'); 
	Route::get('admin/message/delete/{id}/{type}','Admin\MessageController@delete');
	Route::get('admin/message/notify','Admin\MessageController@notify'); 

	#Language
	Route::get('admin/language/setting', 'Admin\LanguageController@setting');
	Route::post('admin/language/add', 'Admin\LanguageController@addLanguage');
	Route::get('admin/language/default/{name}', 'Admin\LanguageController@defaultLanguage');
	Route::get('admin/language/delete/{name}', 'Admin\LanguageController@deleteLanguage');
	Route::get('admin/language/label', 'Admin\LanguageController@label');
	Route::get('admin/language/label/delete/{id}', 'Admin\LanguageController@deleteLabel');
	Route::post('admin/language/label/add', 'Admin\LanguageController@addLabel');
	Route::post('admin/language/label/update', 'Admin\LanguageController@updateLabel');

	# user list
	Route::get('admin/user/new', 'Admin\UserController@form');
	Route::post('admin/user/new', 'Admin\UserController@create');
	Route::get('admin/user/list', 'Admin\UserController@show');

	Route::get('admin/user/clients', 'Admin\UserController@clientShow');
	Route::get('admin/user/client-list', 'Admin\UserController@getClientData');

	Route::get('admin/user/edit/{id}', 'Admin\UserController@editForm');
	Route::post('admin/user/edit', 'Admin\UserController@update');
	Route::get('admin/user/delete/{id}', 'Admin\UserController@delete');
	Route::get('admin/user/data', 'Admin\UserController@getAdminData');

	#profile
	Route::get('admin/setting/profile', 'Admin\ProfileController@profile');
	Route::post('admin/setting/profile', 'Admin\ProfileController@profileUpdate');

	# setting
	Route::get('admin/setting/app', 'Admin\SettingController@app');
	Route::post('admin/setting/app', 'Admin\SettingController@updateApp');
	Route::post('admin/setting/map', 'Admin\SettingController@updateMap');
	Route::post('admin/setting/price', 'Admin\SettingController@updatePrice');
	Route::post('admin/setting/paypal', 'Admin\SettingController@updatePayPal');
	Route::post('admin/setting/notification', 'Admin\SettingController@updateNotification');
	Route::post('admin/setting/website', 'Admin\SettingController@website');


	/* written by Md.Saiful Islam  */
    # Biggipon
    Route::resource('admin/biggapons', 'Admin\BiggaponController');
    Route::get('admin/biggapons-data', 'Admin\BiggaponController@getBiggaponData');


    Route::resource('admin/faqs','Admin\FaqController');
    Route::get('admin/faqs-data','Admin\FaqController@getFaqData');

    Route::resource('admin/parking-rules','Admin\ParkingRuleController');
    Route::get('admin/parking-rules-data','Admin\ParkingRuleController@getParkingRuleData');

    Route::resource('admin/zones','Admin\ZoneController');
    Route::get('admin/zones-data','Admin\ZoneController@getCityData');

    Route::resource('admin/cities','Admin\CityController');
    Route::get('admin/cities-data','Admin\CityController@getCityData');

    Route::resource('admin/states','Admin\StateController');
    Route::get('admin/states-data','Admin\StateController@getCountryData');

    Route::resource('admin/countries','Admin\CountryController');
    Route::get('admin/country-data','Admin\CountryController@getCountryData');

    Route::resource('admin/point-system','Admin\PointSystemController');
    Route::get('admin/point-system-data','Admin\PointSystemController@getPointSystemData');
});
 
/*
|-----------------------------------------------------------
| OPERATOR SECTION
|-----------------------------------------------------------
*/

Route::group(["middleware" => ["auth","roles:operator"]], function() {
	# dashboard
	Route::get('dashboard', 'Operator\DashboardController@index');
	Route::get('operator/dashboard', 'Operator\DashboardController@index');

	#profile
	Route::get('operator/setting/profile', 'Operator\ProfileController@profile');
	Route::post('operator/setting/profile', 'Operator\ProfileController@profileUpdate'); 

	# client
	Route::get('operator/client/new', 'Operator\ClientController@form');
	Route::post('operator/client/new', 'Operator\ClientController@create');
	Route::get('operator/client/list', 'Operator\ClientController@list');
	Route::get('operator/client/data', 'Operator\ClientController@getClientData');
	Route::get('operator/client/profile/{id}', 'Operator\ClientController@profile');

	# parking zone info
	Route::get('operator/parking_zone', 'Operator\ZoneInfoController@parking_zone');
	Route::get('operator/parking_zone/{id}', 'Operator\ZoneInfoController@parkingZoneDetails');

	# email  
	Route::get('operator/email/new', 'Operator\EmailCampaignController@form');
	Route::post('operator/email/new', 'Operator\EmailCampaignController@send');
	Route::get('operator/email/list', 'Operator\EmailCampaignController@show');
	Route::get('operator/email/data', 'Operator\EmailCampaignController@getData');

	# sms 
	Route::get('operator/sms/new', 'Operator\SmsCampaignController@form');
	Route::post('operator/sms/new', 'Operator\SmsCampaignController@send');
	Route::get('operator/sms/list', 'Operator\SmsCampaignController@show');
	Route::get('operator/sms/data', 'Operator\SmsCampaignController@getData');

	# booking
	Route::get('operator/booking/form', 'Operator\BookingController@form');
	Route::post('operator/booking/place_order', 'Operator\BookingController@placeOrder');
	Route::get('operator/booking/invoice', 'Operator\BookingController@invoice');
	Route::get('operator/booking/release', 'Operator\BookingController@release');
	Route::get('operator/booking/fine', 'Operator\BookingController@fine');
	Route::get('operator/booking/payment_status', 'Operator\BookingController@paid');
	Route::get('operator/booking/{type}', 'Operator\BookingController@show');
	Route::get('operator/booking/get-data/{type}', 'Operator\BookingController@getData');

	Route::post('operator/booking/getZoneAndVehicleWisePriceList', 'Operator\BookingController@getZoneAndVehicleWisePriceList');
	Route::post('operator/booking/findScheduleAndPrice', 'Operator\BookingController@findScheduleAndPrice');
	Route::post('operator/booking/getPriceList', 'Operator\BookingController@getPriceList');
	Route::post('operator/booking/getDiscount', 'Operator\BookingController@getDiscount');
	Route::post('operator/booking/checkClientID', 'Operator\BookingController@checkClientID');
	Route::post('operator/booking/createClient', 'Operator\BookingController@createClient');

	# report
	Route::get('operator/report', 'Operator\ReportController@index');

	#message  
	Route::get('operator/message/new','Operator\MessageController@form');
	Route::post('operator/message/new','Operator\MessageController@new');
	Route::get('operator/message/inbox','Operator\MessageController@inbox'); 
	Route::get('operator/message/inbox/data','Operator\MessageController@getInboxData');
	Route::get('operator/message/sent','Operator\MessageController@sent'); 
	Route::get('operator/message/sent/data','Operator\MessageController@getSentData'); 
	Route::get('operator/message/details/{id}/{type}','Operator\MessageController@details'); 
	Route::get('operator/message/delete/{id}/{type}','Operator\MessageController@delete');
	Route::get('operator/message/notify','Operator\MessageController@notify'); 

	 
});