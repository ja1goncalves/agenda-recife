<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/', function () {
    return redirect('/');
});

Route::group(['prefix' => 'events', 'middleware' => ['auth']], function () {

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoriesController@all')->name('api-categories');
        Route::post('/', 'CategoriesController@store')->name('api-add-category');
        Route::delete('/', 'CategoriesController@delete')->name('api-del-category');
        Route::put('/', 'CategoriesController@edit')->name('api-edit-category');
    });

    Route::group(['prefix' => 'tags'], function () {
        //Tags
        Route::get('/', 'TagsController@all')->name('api-tags');
        Route::post('/', 'TagsController@store')->name('api-add-tags');
        Route::delete('/', 'TagsController@delete')->name('api-del-tags');
        Route::put('/', 'TagsController@edit')->name('api-edit-tags');
    });

    Route::get('/', 'EventsController@all')->name('api-events');
    Route::post('/', 'EventsController@store')->name('api-add-event');
    Route::delete('/', 'EventsController@delete')->name('api-del-event');
    Route::put('/', 'EventsController@save')->name('api-edit-event');
});

Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', 'UsersController@all')->name('api-users');
    Route::post('/', 'RegisterController@register')->name('add-user');
    Route::delete('/', 'UsersController@delete')->name('api-del-user');
    Route::put('/', 'UsersController@edit')->name('api-edit-user');
    Route::post('/permissions', 'UsersController@savePermissions')->name('api-user-permission');
});

Route::group(['prefix' => 'permissions', 'middleware' => ['auth']], function () {
    Route::get('/', 'PermissionsController@all')->name('api-permissions');
    Route::get('/inactive', 'PermissionsController@inactive')->name('api-inactive-route');
    Route::get('/update', 'PermissionsController@refreshRoutes')->name('api-update-routes');
    Route::post('/', 'PermissionsController@delete')->name('api-del-route');
});

Route::group(['prefix' => 'ads', 'middleware' => ['auth']], function () {
    Route::get('/', 'AdsController@all')->name('api-ads');
    Route::post('/', 'AdsController@store')->name('api-add-ad');
    Route::post('/', 'AdsController@delete')->name('api-del-ad');
    Route::post('/', 'AdsController@edit')->name('api-edit-ad');
});

Route::group(['prefix' => 'reports', 'middleware' => ['auth']], function () {
    Route::get('/', 'ReportsController@all')->name('api-reports');
    Route::post('/', 'ReportsController@create')->name('api-add-report');
    Route::delete('/', 'AdsController@delete')->name('api-del-reports');
    Route::put('/', 'AdsController@edit')->name('api-edit-reports');
});

Route::group(['middleware' => ['auth']], function () {
    //Pictures
    Route::get('/delete-picture', 'PicturesController@delete')->name('api-del-img');
});
