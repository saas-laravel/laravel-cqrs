<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Modules\User\Exceptions\UserException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', UserController::class);

Route::get('docs/exceptions/{code}', fn ($code) => $code)->name('docs.exceptions');

Route::get('/test', function () {


   throw UserException::userAlreadyExists();


});
