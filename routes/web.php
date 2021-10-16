<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AnswerController;

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
/**
 * 非公開時は下記３つをauthグループの中に入れる
 */
Route::get('/', function () {
	return view('index');
})->name('index');

Route::get('/thanks', function () {
	return view('thanks');
})->name('thanks');

Route::post('/add', [FormController::class, 'add']);
/**
 * 非公開時は上記３つをauthグループの中に入れる
 */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

	Route::get('/chart', [ChartController::class, 'index']);
	Route::get('/chart/{page}', [ChartController::class, 'show']);
	Route::post('/chart/csv', [ChartController::class, 'csv']);

	Route::get('/answer', [AnswerController::class, 'index']);
	Route::get('/answer/{page}', [AnswerController::class, 'show']);

	Route::get('/sum', [FormController::class, 'sum']);

	Route::get('/dashboard', function () {
		return view('dashboard');
	})->name("dashboard");

	Route::group(['middleware' => 'can:admin'], function () {
		Route::get('/list', [FormController::class, 'list']);
	});

});
