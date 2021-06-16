<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'App\Http\Controllers\AuthController@logout');
        Route::get('user', 'App\Http\Controllers\AuthController@user');
    });
});


Route::resource('albumService', 'App\Http\Controllers\AlbumServiceController');
Route::resource('city', 'App\Http\Controllers\CityController');
Route::resource('commentService', 'App\Http\Controllers\CommentServiceController');
Route::resource('group', 'App\Http\Controllers\GroupController');
Route::resource('partner', 'App\Http\Controllers\PartnerController');
Route::resource('experience', 'App\Http\Controllers\ExperienceController');
Route::resource('sale', 'App\Http\Controllers\SaleController');
Route::resource('service', 'App\Http\Controllers\ServiceController');
Route::resource('state', 'App\Http\Controllers\StateController');
Route::resource('stateSale', 'App\Http\Controllers\StateSaleController');
Route::resource('typeService', 'App\Http\Controllers\TypeServiceController');
Route::resource('form', 'App\Http\Controllers\FormController');
Route::resource('itinerary', 'App\Http\Controllers\ItineraryController');
Route::resource('typeExperience', 'App\Http\Controllers\TypeExperienceController');

/*
 * Custom Routes
 * */

Route::get('service/type/{type}/city/{city}', 'App\Http\Controllers\ServiceController@service_city_type');
Route::get('city/type/{type}', 'App\Http\Controllers\CityController@city_type');
Route::get('stateCity/{state}', 'App\Http\Controllers\StateCityController@index');
Route::get('typeService/{typeService}/services', 'App\Http\Controllers\ServicesTypeservicesController@index');
Route::post('service/{service}/typeExperience/{typeExperience}', 'App\Http\Controllers\ServiceController@addTypeExperienceInService');
Route::delete('service/{service}/typeExperience/{typeExperience}', 'App\Http\Controllers\ServiceController@delTypeExperienceInService');
Route::get('city/typeExperience/services', 'App\Http\Controllers\ServiceController@headerService');