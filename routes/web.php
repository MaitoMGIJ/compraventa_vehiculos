<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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
Route::middleware(['auth:sanctum'])->resource('transaction', TransactionController::class)->except(['show']);
Route::middleware(['auth:sanctum'])->resource('users', UserController::class);
Route::middleware(['auth:sanctum'])->resource('roles', RoleController::class);
Route::middleware(['auth:sanctum'])->resource('agents', AgentController::class);
Route::middleware(['auth:sanctum'])->get('admin', [AdminController::class, 'index'])->name('admin.index');
Route::middleware(['auth:sanctum'])->get('admin/expense', [AdminController::class, 'expense'])->name('admin.expense.list');
Route::middleware(['auth:sanctum'])->get('admin/expense/create', [AdminController::class, 'createExpense'])->name('admin.expense.create');
Route::middleware(['auth:sanctum'])->post('admin/expense/store', [AdminController::class, 'storeExpense'])->name('admin.expense.store');
Route::middleware(['auth:sanctum'])->get('admin/transaction/list', [TransactionController::class, 'index'])->name('admin.transaction.list');
Route::middleware(['auth:sanctum'])->get('transaction/end', [TransactionController::class, 'end'])->name('transaction.end');
Route::middleware(['auth:sanctum'])->get('transaction/income', [TransactionController::class, 'income'])->name('transaction.income');


Route::middleware(['auth:sanctum'])->get('reports', [ReportController::class, 'index'])->name('reports.index');
Route::middleware(['auth:sanctum'])->post('reports/transactions', [ReportController::class, 'transactions'])->name('reports.transactions');
Route::middleware(['auth:sanctum'])->post('reports/balance', [ReportController::class, 'balance'])->name('reports.balance');
Route::middleware(['auth:sanctum'])->post('reports/vehicles/active', [ReportController::class, 'activeVehicles'])->name('reports.vehicles.active');
Route::middleware(['auth:sanctum'])->post('reports/vehicles/inactive', [ReportController::class, 'inactiveVehicles'])->name('reports.vehicles.inactive');
Route::middleware(['auth:sanctum'])->post('reports/vehicles', [ReportController::class, 'vehicles'])->name('reports.vehicles');
Route::middleware(['auth:sanctum'])->post('reports/commissions', [ReportController::class, 'commissions'])->name('reports.commissions');
Route::middleware(['auth:sanctum'])->post('reports/topUnsold', [ReportController::class, 'topUnsold'])->name('reports.topUnsold');
Route::middleware(['auth:sanctum'])->post('reports/vehicles/inventory', [ReportController::class, 'inventory'])->name('reports.vehicles.inventory');
Route::middleware(['auth:sanctum'])->post('reports/expenses', [ReportController::class, 'expenses'])->name('reports.expenses');
Route::middleware(['auth:sanctum'])->post('reports/pawn', [ReportController::class, 'pawn'])->name('reports.pawn');

Route::post('brand/type', [FormController::class, 'brandType'])->name('brand.type');
Route::post('reference/brand/type', [FormController::class, 'referenceBrand'])->name('reference.brand');

//Please only in production
/*
Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path("app/public/$filename");

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->where('filename', '.*');
*/
