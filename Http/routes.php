<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['prefix' => 'reservation', 'middleware' => ['web']], function () {
	//
});



// Routes in this group must be authorized.
Route::group(['middleware' => 'authorize'], function () {

    // Reservation routes
    Route::group(['prefix' => 'reservation'], function () {
        Route::get(   '/',                        ['as' => 'reservation.index',               'uses' => 'ReservationController@index']);
        Route::post(  '/',                        ['as' => 'reservation.store',               'uses' => 'ReservationController@store']);
        Route::get(   'create',                   ['as' => 'reservation.create',              'uses' => 'ReservationController@create']);
        Route::get(   '{itemID}',                 ['as' => 'reservation.show',                'uses' => 'ReservationController@show']);
        Route::patch( '{itemID}',                 ['as' => 'reservation.patch',               'uses' => 'ReservationController@update']);
        Route::get(   '{itemID}/edit',            ['as' => 'reservation.edit',                'uses' => 'ReservationController@edit']);
        Route::get(   '{itemID}/confirm-delete',  ['as' => 'reservation.confirm-delete-item', 'uses' => 'ReservationController@getModalDeleteItem']);
        Route::get(   '{itemID}/delete',          ['as' => 'reservation.delete',              'uses' => 'ReservationController@destroyItem']);
        Route::get(   '{itemID}/sign-out',        ['as' => 'reservation.sign-out',            'uses' => 'ReservationController@getSignOut']);
        Route::post(  '{itemID}/sign-out',        ['as' => 'reservation.post-sign-out',       'uses' => 'ReservationController@postSignOut']);
        Route::get(   '{itemID}/confirm-sign-in', ['as' => 'reservation.confirm-sign-in',     'uses' => 'ReservationController@getModalSignIn']);
        Route::get(   '{itemID}/sign-in',         ['as' => 'reservation.sign-in',             'uses' => 'ReservationController@signIn']);

    }); // End of Reservation group


}); // end of AUTHORIZE middleware group
