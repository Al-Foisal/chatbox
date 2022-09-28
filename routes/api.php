<?php

use App\Http\Controllers\Api\Friend\FriendAuthController;
use App\Http\Controllers\Api\Friend\FriendOperationController;
use App\Http\Controllers\Api\Friend\PostController;
use App\Http\Controllers\Api\Friend\UserSelectionController;
use App\Http\Controllers\Api\GeneralController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/friend')->group(function () {
    Route::controller(FriendAuthController::class)->prefix('/auth')->group(function () {
        Route::post('/check', 'checkFriend');
        Route::post('/otp-verify', 'otpVerify');
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/forgot-password', 'forgotPassword');
        Route::post('/reset-password', 'resetPassword');

        //profile update
        Route::post('/update-profile', 'updateProfile');
    });

    Route::controller(UserSelectionController::class)->prefix('/us')->group(function () {
        Route::get('/{id}', 'us');
        Route::post('/user-choice-as', 'userChoiceAs');
        Route::post('/approve-choice-user', 'approveChoiceUser');
    });

    Route::controller(FriendOperationController::class)->prefix('/connect')->group(function () {
        Route::get('/list/{user_id}', 'friendList');
    });

    Route::controller(PostController::class)->prefix('/post')->group(function () {
        Route::get('/index/{user_id}', 'index');
        Route::post('/create', 'create');
        Route::get('/details/{post_id}', 'details');
        Route::delete('/delete', 'delete');

        Route::post('/comment/create', 'commentCreate');
        Route::delete('/comment/delete', 'commentDelete');

        Route::post('/like-dislike', 'likeDislike');
    });
});

Route::controller(GeneralController::class)->prefix('/general')->group(function () {
    Route::get('/help', 'help');
});

/**********************************************Marriage-Registration***************************************** */

Route::post('/Marriage-Registration-otp', [

    'uses' => 'App\Http\Controllers\RegistrationMarriageController@otp',

]);

Route::post('/Marriage-Registration', [

    'uses' => 'App\Http\Controllers\RegistrationMarriageController@addRegistration',

]);
Route::post('/Marriage-Registration-Update', [

    'uses' => 'App\Http\Controllers\RegistrationMarriageController@addRegistrationUpdate',

]);

Route::post('/Marriage-Registration-login', [

    'uses' => 'App\Http\Controllers\RegistrationMarriageController@login',

]);

Route::get('/Marriage-Registration-Get-Users', [

    'uses' => 'App\Http\Controllers\RegistrationMarriageController@GetUsers',

]);
Route::get('/Marriage-Registration-Get-User/{id?}', [

    'uses' => 'App\Http\Controllers\RegistrationMarriageController@GetUser',

]);

Route::get('/Get-friend/{id?}', [

    'uses' => 'App\Http\Controllers\Api\Friend\FriendAuthController@Getuser',

]);
Route::get('/find-user/{id?}', [

    'uses' => 'App\Http\Controllers\Api\Friend\FriendAuthController@finduser',

]);
/**********************************************Marriage-Registration***************************************** */
Route::get('/', function (Request $request) {

    return ip();
});
