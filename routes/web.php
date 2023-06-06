<?php

use Illuminate\Support\Facades\Route;
 
Route::get('/reports', 'ReportsController@index');
Route::get('/settings', 'SettingsController@index');
Route::patch('/settings', 'SettingsController@update');
Route::get('/change-password', 'UserUpdatePassword@index');
Route::patch('/change-password', 'UserUpdatePassword@update');
Route::get('/donation-reports', 'ReportsController@donations');
Route::get('/pdf', 'PdfController@index')->name('pdf');
Route::get('/pdf-donation', 'PdfController@donations')->name('pdf-donation');

Route::get('/update-phone', 'PhoneNumberController@index');
Route::patch('/update-phone', 'PhoneNumberController@update');

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware' => 'prevent-back-history'], function() {

	Auth::routes();
		Route::group(['middleware' => 'auth'], function(){
			Route::middleware('role:Chairman,Parish Priest,Commission Head,PPC,PFC,PFC Admin')->group(function () {
				//Chairmans
				Route::get('/chairmans', 'UsersController@index');
				Route::post('/chairmans', 'UsersController@store');
				Route::get('/chairmans/{chairman}/edit', 'UsersController@edit');
				Route::patch('/chairmans/{chairman}', 'UsersController@update');
				Route::patch('/chairmans/{chairman}/disable', 'UsersController@disable')->name('disable_chairman');
				Route::patch('/chairmans/{chairman}/enable', 'UsersController@enable')->name('enable_chairman');
				Route::delete('/chairmans/{chairman}', 'UsersController@destroy');
				Route::get('/chairmans/{chairman}/show', 'UsersController@show');
				
				// Temporarily 
				Route::get('/chairmans/{chairman}/send-credentials', 'UsersController@send')->name('send-credentials');

				//PFC Chairmans
				Route::get('/pfc-chairmans', 'UsersPFCController@index');
				Route::post('/pfc-chairmans', 'UsersPFCController@store');
				Route::get('/pfc_chairmans/{pfc_chairman}/edit', 'UsersPFCController@edit')->name('pfc_chairmans.edit');
				Route::patch('/pfc-chairmans/{pfc_chairman}', 'UsersPFCController@update');
				Route::patch('/pfc_chairmans/{pfc_chairman}/disable', 'UsersPFCController@disable');
				Route::patch('/pfc_chairmans/{pfc_chairman}/enable', 'UsersPFCController@enable');
				Route::delete('/pfc-chairmans/{pfc_chairman}', 'UsersPFCController@destroy');
				Route::get('/pfc_chairmans/{pfc_chairman}/show', 'UsersPFCController@show');

				//Parish Priest

				Route::get('/parish-priest', 'ParishPriestController@index');
				Route::post('/parish-priests', 'ParishPriestController@store');
				Route::get('/parish-priests/{priest}/edit', 'ParishPriestController@edit');
				Route::get('/parish-priests/{priest}/show', 'ParishPriestController@show');
				Route::patch('/parish-priests/{priest}', 'ParishPriestController@update');
				Route::delete('/parish-priests/{priest}', 'ParishPriestController@destroy');
				Route::patch('/parish-priests/{priest}/disable', 'ParishPriestController@disable')->name('disable_priest');
				Route::patch('/parish-priests/{priest}/enable', 'ParishPriestController@enable')->name('enable_priest');

				//Commission Head 
				Route::resource('/commission-heads', 'CommsionsHeadController');
				Route::get('/commission-heads/{commission_head}/show', 'CommsionsHeadController@show');
				Route::get('/commission-heads/{chairman}/edit', 'CommsionsHeadController@edit');
				Route::patch('/commission-heads/{chairman}', 'CommsionsHeadController@update');
				Route::patch('/commission-heads/{chairman}/disable', 'CommsionsHeadController@disable')->name('disable_commission-heads');
				Route::patch('/commission-heads/{chairman}/enable', 'CommsionsHeadController@enable')->name('enable_commission-heads');


				Route::resource('/ppc', 'PpcController');
				Route::get('/ppcs/{ppc}/show', 'PpcController@show');
				Route::get('/ppcs/{ppc}/edit', 'PpcController@edit');
				Route::patch('/ppcs/{ppc}', 'PpcController@update');
				Route::patch('/ppcs/{ppc}/disable', 'PpcController@disable')->name('disable_ppcs');
				Route::patch('/ppcs/{ppc}/enable', 'PpcController@enable')->name('enable_ppcs');



				Route::resource('/pfc', 'PfcController');
				Route::get('/pfcs/{pfc}/show', 'PfcController@show');
				Route::get('/pfcs/{pfc}/edit', 'PfcController@edit');
				Route::patch('/pfcs/{pfc}', 'PfcController@update');
				Route::patch('/pfcs/{pfc}/disable', 'PfcController@disable')->name('disable_pfcs');
				Route::patch('/pfcs/{pfc}/enable', 'PfcController@enable')->name('enable_pfcs');


				Route::get('/home', 'HomeController@index')->name('home');


				Route::get('/archived-projects', 'ProjectsController@archivedP');
				Route::get('/cancelled-projects', 'ProjectsController@cancelledP');
				Route::get('/approved-projects', 'ProjectsController@approvedP');
				Route::get('/pending-projects', 'ProjectsController@pending');
				Route::resource('/projects', 'ProjectsController');

				Route::get('/projects/{project}/show', 'ProjectsController@show');
				
				
				Route::patch('/projects/{project}/approved', 'ProjectsController@approved');
				Route::patch('/projects/{project}/cancelled', 'ProjectsController@cancelled');
				Route::patch('/projects/{project}/archived', 'ProjectsController@archived');


				Route::resource('/events', 'EventsController');
				Route::get('/pending-events', 'EventsController@pending');
				Route::get('/rejected-events', 'EventsController@cancelledView');
				Route::get('/approved-events', 'EventsController@approvedView');
				Route::get('/events/{event}/show', 'EventsController@show');
				Route::get('/archived-events', 'EventsController@archivedView');


				Route::patch('/events/{event}/approved', 'EventsController@approved');
				Route::patch('/events/{event}/cancelled', 'EventsController@cancelled');
				Route::patch('/events/{event}/archived', 'EventsController@archived');

				Route::resource('/donations', 'DonationsController');
				Route::get('/donations', 'DonationsController@index');
				Route::patch('/donations/{donation}/archive', 'DonationsController@archive');
				Route::get('/archived-donations', 'DonationsController@archiveDonations');

				Route::resource('/expenses', 'ExpensesController');
				Route::get('/donations/total', 'DonationsController@getTotalDonation')->name('donations.total');
				Route::get('/expenses', 'ExpensesController@index');
				Route::get('/expenses/{expense}/show', 'ExpensesController@show');
				Route::patch('/expenses/{expense}/archive', 'ExpensesController@archive');
				Route::get('archived-expenses', 'ExpensesController@archiveExpenses');

				
				

				Route::patch('/meetings/{meeting}/approved', 'MeetingsController@approved');
				Route::patch('/meetings/{meeting}/rejected', 'MeetingsController@rejected');
				Route::patch('/meetings/{meeting}/archive', 'MeetingsController@archive');

				Route::get('/meetings', 'MeetingsController@index');
				Route::get('/pending-meetings', 'MeetingsController@pending');
				Route::get('/approved-meetings', 'MeetingsController@approvedMeetings');
				Route::get('/rejected-meetings', 'MeetingsController@rejectedMeetings');
				Route::get('/archived-meetings', 'MeetingsController@archivedMeetings');

				Route::post('/meetings', 'MeetingsController@store');
				Route::get('/meetings/{meeting}/edit','MeetingsController@edit');
				Route::get('/meetings/{meeting}/show','MeetingsController@show');
				Route::patch('/meetings/{meeting}', 'MeetingsController@update');
				Route::delete('/meetings/{meeting}', 'MeetingsController@destroy');
		});

				Route::middleware('role:Parish Priest')->group(function () {

					Route::get('/home/parish', 'HomeController@index');
				});


				Route::middleware('role:Commission Head')->group(function () {

					Route::get('/home/commission-head', 'HomeController@index');
				});


				Route::middleware('role:PPC')->group(function () {

					Route::get('/home/ppc', 'HomeController@index');
				});

				Route::middleware('role:PFC')->group(function () {

					Route::get('/home/pfc', 'HomeController@index');
				});

	});
});

// Route::get('/generate-reports', 'ReportsController@generate');