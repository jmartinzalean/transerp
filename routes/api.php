<?php

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

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});


Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');

    Route::get('cities', 'Api\CitiesController@getCities')->name('cities');
    Route::get('cities/states/{id}', 'Api\CitiesController@getCitiesByStateId')->name('cities.states');

    Route::get('states', 'Api\StatesController@getStates')->name('states');

    Route::get('clients', 'Api\ClientsController@getClients')->name('clients');
    Route::get('client/name/{name}', 'Api\ClientsController@getClientByName')->name('client.name');
    Route::get('client/nif/{nif}', 'Api\ClientsController@getClientBynif')->name('client.nif');

    Route::group(['middleware' => 'isAdmin'], function() {
        Route::post('clients', 'Api\ClientsController@setClient')->name('clients.store');
        Route::put('clients/{id}', 'Api\ClientsController@updateClient')->name('clients.update');
    });

    Route::get('projects', 'Api\ProjectsController@getProjects')->name('projects');
    Route::get('projects/{id}', 'Api\ProjectsController@getProjectById')->name('projects.show');

    Route::group(['middleware' => 'isAdmin'], function() {
        Route::post('projects', 'Api\ProjectsController@setProject')->name('projects.store');
        Route::put('projects/{id}', 'Api\ProjectsController@updateProject')->name('projects.update');
    });
});