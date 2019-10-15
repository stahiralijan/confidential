<?php
	
	Route::get('/', function ()
	{
		return view('auth.login');
	})
		 ->middleware('guest');
	
	Auth::routes();
	
	Route::get('/home', 'HomeController@index')
		 ->name('home');
	
	Route::group(['middleware' => 'auth'], function ()
	{
		Route::resource('enquiries', 'EnquiryController');
		Route::resource('enquiry-statuses', 'StatusController');
		Route::resource('penalties', 'PenaltyController');
		Route::resource('penalty-types', 'PenaltyTypeController');
		Route::resource('employees', 'EmployeeController');
		Route::resource('designations', 'DesignationController');
		Route::resource('offices', 'OfficeController');
		Route::resource('action-taken', 'ActionTakenController');
		Route::resource('charges', 'ChargeController');
		Route::resource('cases', 'EnquiryCaseController');
		Route::resource('finalized-cases', 'FinzalizedCasesController');
		Route::resource('competent-authority', 'ComptentAuthorityController');
		Route::resource('punishments', 'PunishmentsController');
		
		Route::get('search-employees', 'EmployeeController@search');
	});