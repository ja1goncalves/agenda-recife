<?php

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
    if(Auth::guest()){
        return Redirect::to('/login');
    }else{
        return Redirect::to('/home');
    }
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    //Events
    Route::get('/eventos', 'EventsController@index')->name('events');
    Route::post('/add-evento', 'EventsController@create')->name('add-event');

    //Users
    Route::get('/usuarios', 'UsersController@index')->name('users');
    Route::post('/permissoes-do-usuario', 'UsersController@updatePermissions')->name('user-permission');

    //Permissions
    Route::get('/permissoes', 'PermissionsController@index')->name('permissions');
    Route::get('/inativar-rota', 'PermissionsController@inactiveRoute')->name('inactive-route');
    Route::get('/update-routes', 'PermissionsController@updateRoutes')->name('update-routes');

    //Categories
    Route::get('/categorias', 'CategoriesController@index')->name('categories');
    Route::post('/add-categorias', 'CategoriesController@create')->name('add-category');

    //Tags
    Route::get('/tags', 'TagsController@index')->name('tags');
    Route::post('/add-tag', 'TagsController@create')->name('add-tag');

    //Ads
    Route::get('/publicidades', 'AdsController@index')->name('ads');
    Route::post('/add-publicidades', 'AdsController@create')->name('add-ad');

    //Reports
    Route::get('/contatos', 'ReportsController@index')->name('reports');
//    Route::post('/add-contatos', 'AdsController@create')->name('add-report');
});

