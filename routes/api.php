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
Route::get('mail/send', 'App\Http\Controllers\MailController@send');
Route::post('albumService/{albumService}', 'App\Http\Controllers\AlbumServiceController@update');
Route::post('city/{city}', 'App\Http\Controllers\CityController@update');
Route::post('commentService/{commentService}', 'App\Http\Controllers\CommentServiceController@update');
Route::post('group/{group}', 'App\Http\Controllers\GroupController@update');
Route::post('partner/{partner}', 'App\Http\Controllers\PartnerController@update');
Route::post('experience/{experience}', 'App\Http\Controllers\ExperienceController@update');
Route::post('sale/{sale}', 'App\Http\Controllers\SaleController@update');
Route::post('service/{service}', 'App\Http\Controllers\ServiceController@update');
Route::post('state/{state}', 'App\Http\Controllers\StateController@update');
Route::post('stateSale/{stateSale}', 'App\Http\Controllers\StateSaleController@update');
Route::post('typeService/{typeService}', 'App\Http\Controllers\TypeServiceController@update');
Route::post('form/{form}', 'App\Http\Controllers\FormController@update');
Route::post('itinerary/{itinerary}', 'App\Http\Controllers\ItineraryController@update');
Route::post('typeExperience/{typeExperience}', 'App\Http\Controllers\TypeExperienceController@update');
Route::post('tag/{tag}', 'App\Http\Controllers\TagController@update');
Route::post('dateExperience/{dateExperience}', 'App\Http\Controllers\DateExperienceController@update');


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
Route::resource('tag', 'App\Http\Controllers\TagController');
Route::resource('dateExperience', 'App\Http\Controllers\DateExperienceController');

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
Route::get('tag/{tag}/services', 'App\Http\Controllers\TagController@services');
Route::post('service/{service}/tag/{tag}', 'App\Http\Controllers\ServiceController@addTagInService');
Route::delete('service/{service}/tag/{tag}', 'App\Http\Controllers\ServiceController@delTagInService');
Route::get('serviceRecomended', 'App\Http\Controllers\ServiceController@indexRecommended');
Route::get('serviceInclusive', 'App\Http\Controllers\ServiceController@indexInclusive');


//Route::post('service/{service}', 'App\Http\Controllers\ServiceController@update');

Route::post('passwordReset', 'App\Http\Controllers\PasswordResetController@store');
Route::post('passwordReset/update', 'App\Http\Controllers\PasswordResetController@update');


Route::get('indicator/{stateSale}', 'App\Http\Controllers\DashboardController@index');

