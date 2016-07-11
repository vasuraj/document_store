<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index');

Route::get('/dashboard', [
	'as' => 'dashboard',
	'uses' => 'DashboardController@index',
	'middleware' => 'auth'
]);

	Route::group(['middleware' => ['auth', 'authorize']], function(){
	Route::resource('users', 'UsersController');
	Route::get('user/profile/{id}', 'UsersController@profile');
	Route::get('user/profile/{id}/edit', 'UsersController@editProfile');
	Route::patch('user/profileUpdate', 'UsersController@updateProfile');
	

	Route::resource('roles', 'RolesController');
	Route::resource('permissions', 'PermissionsController');
	Route::get('/role_permission', 'RolesPermissionsController@index');
	Route::post('/role_permission', 'RolesPermissionsController@store');

	
	Route::POST('fileUpload/store','FileUploadController@adminFileStore');
	Route::get('fileUpload/delete/{file_id}/{return_to}','FileUploadController@delete');
	Route::POST('fileUpload/delete/{file_id}/{return_to}','FileUploadController@delete');
	Route::get('fileUpload/viewSummary/{user_id}','FileUploadController@viewSummary');
	Route::get('fileUpload/getSummaryJson/{month}/{year}/{user_id}','FileUploadController@getSummaryJson');
	Route::get('fileUpload/deadline','FileUploadController@fileUploadDeadline');
	Route::get('fileUpload/getdeadline/{abbreviation}/{deadline}','FileUploadController@getDeadline');
	Route::get('fileUpload/{userType}','FileUploadController@adminFileUpload');
	
	

	Route::resource('fileUpload','FileUploadController');

	Route::get('fileDownload/download/{fileName}','FileDownloadController@download');
	Route::get('fileDownload/show/{month?}/{year?}','FileDownloadController@show');

	Route::resource('fileDownload','FileDownloadController');


	Route::get('userAmountReceived','FinanceController@index');
	Route::get('userAmountDelete/{transaction_id}/{return_to}','FinanceController@deleteAmountReceived');
	Route::post('userAmountReceived/store','FinanceController@storeUserAmountReceived');
	

	Route::get('UCUpload','FinanceController@UCUploadForm');
	Route::post('UCUpload/store','FinanceController@storeUC');
	Route::get('UCUpload/delete/{id}/{return_to}','FinanceController@ucDelete');


	Route::get('AuditReportUpload','FinanceController@AuditReportForm');
	Route::post('AuditReportUpload/store','FinanceController@storeAuditReport');
	Route::get('AuditReportUpload/delete/{id}/{return_to}','FinanceController@auditReportDelete');

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
