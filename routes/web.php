<?php

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if(Auth::check())
        return redirect()->route('dashboard');
    else
        return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->resource('vehicle', VehicleController::class);
Route::middleware(['auth:sanctum'])->resource('transaction', TransactionController::class)->only('create', 'store');
Route::middleware(['auth:sanctum'])->get('transaction/end', [TransactionController::class, 'end'])->name('transaction.end');
Route::middleware(['auth:sanctum'])->get('transaction/income', [TransactionController::class, 'income'])->name('transaction.income');

Route::post('brand/type', [FormController::class, 'brandType'])->name('brand.type');
Route::post('reference/brand/type', [FormController::class, 'referenceBrand'])->name('reference.brand');
