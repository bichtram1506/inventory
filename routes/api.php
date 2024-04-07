<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Resources\UserCollection; 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('photos', PhotoController::class);

Route::apiResources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]);


Route::get('/users', function () {
    return new UserCollection(User::paginate());
});