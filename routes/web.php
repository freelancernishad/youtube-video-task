<?php

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UddoktapayController;



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

Route::get('/ip/check', function (Request $request) {
    $clientIP = request()->ip();
    dd($clientIP);
});

Route::post('/ip/check', function (Request $request) {
    $clientIP = request()->ip();
    dd($clientIP);
});


Route::get( 'pay', [UddoktapayController::class, 'show'] )->name( 'uddoktapay.payment-form' );

Route::get( 'success', [DepositController::class, 'paymentSuccess'] )->name( 'uddoktapay.success' );
Route::get( 'cancel', [UddoktapayController::class, 'cancel'] )->name( 'uddoktapay.cancel' );

// Auth::routes();

Route::post('login',[LoginController::class,'login']);
Route::post('logout',[LoginController::class,'logout']);

// Route::group(['middleware' => ['is_admin']], function() {
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// });

// Route::group(['middleware' => ['CustomerMiddleware']], function() {
// Route::get('/sub', [App\Http\Controllers\HomeController::class, 'sub'])->name('sub');
// });

Route::group(['prefix' => 'dashboard','middleware' => ['auth']], function() {
    Route::get('/{vue_capture?}', function () {
        // return   Auth::user()->roles->permission;

        $roles = Role::all();

        return view('layout',compact('roles'));
    })->where('vue_capture', '[\/\w\.-]*')->name('dashboard');

});


Route::get('/{vue_capture?}', function () {
    return view('frontlayout');
})->where('vue_capture', '[\/\w\.-]*')->name('frontend');
