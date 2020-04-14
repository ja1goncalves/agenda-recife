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
        Route::post('/create', 'CategoriesController@store')->name('api-add-category');
        Route::put('/edit', 'CategoriesController@edit')->name('api-edit-category');
        Route::delete('/delete', 'CategoriesController@delete')->name('api-del-category');
    });

    Route::group(['prefix' => 'tags'], function () {
        //Tags
        Route::get('/', 'TagsController@all')->name('api-tags');
        Route::post('/create', 'TagsController@store')->name('api-add-tags');
        Route::put('/edit', 'TagsController@edit')->name('api-edit-tags');
        Route::delete('/delete', 'TagsController@delete')->name('api-del-tags');
    });

    Route::get('/', 'EventsController@all')->name('api-events');
    Route::post('/create', 'EventsController@store')->name('api-add-event');
    Route::put('/edit', 'EventsController@save')->name('api-edit-event');
    Route::delete('/delete', 'EventsController@delete')->name('api-del-event');
});

Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', 'UsersController@all')->name('api-users');
    Route::put('/edit', 'UsersController@edit')->name('api-edit-user');
    Route::delete('/delete', 'UsersController@delete')->name('api-del-user');
    Route::post('/permissions', 'UsersController@savePermissions')->name('api-user-permission');
});

Route::group(['prefix' => 'permissions', 'middleware' => ['auth']], function () {
    Route::get('/', 'PermissionsController@all')->name('api-permissions');
    Route::get('/update', 'PermissionsController@refreshRoutes')->name('api-update-routes');
});

Route::group(['prefix' => 'ads', 'middleware' => ['auth']], function () {
    Route::get('/', 'AdsController@all')->name('api-ads');
    Route::post('/create', 'AdsController@store')->name('api-add-ad');
    Route::post('/edit', 'AdsController@edit')->name('api-edit-ad');
    Route::delete('/delete', 'AdsController@delete')->name('api-del-ad');
});

Route::group(['prefix' => 'reports', 'middleware' => ['auth']], function () {
    Route::get('/', 'ReportsController@all')->name('api-reports');
    Route::post('/create', 'ReportsController@store')->name('api-add-report');
//    Route::put('/edit', 'AdsController@edit')->name('api-edit-reports');
//    Route::delete('/delete', 'AdsController@delete')->name('api-del-reports');
});

Route::group(['middleware' => ['auth']], function () {
    //Pictures
    Route::get('/delete-picture', 'PicturesController@delete')->name('api-del-img');
});
