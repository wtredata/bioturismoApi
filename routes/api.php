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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::resource('albumRoom', 'AlbumRoomController');
Route::resource('albumService', 'AlbumServiceController');
Route::resource('city', 'CityController');
Route::resource('commentService', 'CommentServiceController');
Route::resource('group', 'GroupController');
Route::resource('partner', 'PartnerController');
Route::resource('room', 'RoomController');
Route::resource('sale', 'SaleController');
Route::resource('service', 'ServiceController');
Route::resource('state', 'StateController');
Route::resource('stateSale', 'StateSaleController');
Route::resource('typeRoom', 'TypeRoomController');
Route::resource('typeService', 'TypeServiceController');