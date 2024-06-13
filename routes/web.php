<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     // return view('welcome');
//     return view('index');
// })->name('home')->middleware('auth');

// Route::get('/squad', function () {
//     return view('squad');
// })->name('squad')->middleware('auth');

// Route::get('/schedule', function () {
//     return view('schedule');
// })->name('schedule')->middleware('auth');

// Route::get('/results', function () {
//     return view('results');
// })->name('results')->middleware('auth');

// Route::get('/stats', function () {
//     return view('stats');
// })->name('stats')->middleware('auth');

// Route::get('/login', function () {
//     return view('login');
// })->name('login');

// Route::get('/register', function () {
//     return view('register');
// })->name('register');

// Route::get('/forgot-password', function () {
//     return view('forgot_password');
// })->name('forgot_password');
Route::get('/', [UserController::class, 'homePage'])->name('home')->middleware('auth');

Route::get('/squad', [UserController::class, 'squadPage'])->name('squad')->middleware('auth');

Route::get('/schedule', [UserController::class, 'schedulePage'])->name('schedule')->middleware('auth');

Route::get('/results', [UserController::class, 'resultsPage'])->name('results')->middleware('auth');

Route::get('/stats', [UserController::class, 'statsPage'])->name('stats')->middleware('auth');

Route::get('/profile', [UserController::class, 'profilePage'])->name('profile')->middleware('auth');

Route::get('/editprofile', [UserController::class, 'edit_profilePage'])->name('editprofile')->middleware('auth');

Route::get('/addnewevent', [UserController::class, 'add_new_eventPage'])->name('addnewevent')->middleware('auth');

Route::get('/createteam', [UserController::class, 'create_teamPage'])->name('createteam')->middleware('auth');

Route::get('/login', [UserController::class, 'loginPage'])->name('login');

Route::get('/register', [UserController::class, 'registerPage'])->name('register');

Route::get('/forgot-password', [UserController::class, 'forgot_passwordPage'])->name('forgot_password');

Route::get('/requestjoin', [UserController::class, 'request_joinPage'])->name('requestjoin')->middleware('auth');

Route::get('/approve', [UserController::class, 'approvePage'])->name('approve')->middleware('auth');

Route::get('/match', [UserController::class, 'matchPage'])->name('match')->middleware('auth');



Route::group(['prefix' => 'api'], function () {
    Route::post('/user-register', [UserController::class, 'register'] )->name('userRegister');
    Route::post('/user-login', [UserController::class, 'login'] )->name('userLogin');
    Route::post('/user-logout', [UserController::class, 'logout'] )->name('userLogout');
    Route::post('/forgot-password', [UserController::class, 'forgotPassword'] )->name('userForgotPassword');
    Route::post('/editprofile', [UserController::class, 'editProfile'] )->name('userEditProfile');
    Route::post('/createteam', [UserController::class, 'createteam'] )->name('userCreateTeam');
    Route::post('/requesttojointeamapi', [UserController::class, 'requesttojointeamapi'] )->name('userrequesttojointeamapi');
    Route::post('/applicationApprovalApi', [UserController::class, 'applicationApprovalApi'] )->name('applicationApprovalApi');
    Route::post('/addNewEventApi', [UserController::class, 'addNewEventApi'] )->name('addNewEventApi');
});