<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\View\Composers\UserComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;


Route::resource('users.posts', UserPostController::class)->except(['', '', '']);
Route::get('/emergency', function () {
    Log::emergency('The system is down!');
    return 'Emergency log recorded!';
});

Route::get('/debug', function () {
    Log::debug('An informational message.');
    return 'Debug log recorded!';
});