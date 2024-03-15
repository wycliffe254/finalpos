<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider, and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/setDateTime', [HomeController::class, 'setDateTime'])->name('setDateTime');

Route::post('/users/{id}', 'UserController@update')->name('users.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::post('products/{product}', [ProductController::class, 'update'])->name('products.update');


Route::resource('orders', OrderController::class);
Route::resource('products', ProductController::class); 
Route::resource('suppliers', SupplierController::class);
Route::resource('users', UserController::class);
Route::resource('companies', CompanyController::class);
Route::resource('transactions', TransactionController::class)->middleware('adminonly');
Route::get('/customers', [OrderController::class, 'show_unique_customers'])->name('customers')->middleware('adminonly');
Route::get('/receipt', [TransactionController::class, 'print_receipt'])->name('receipt');
Route::get('/export', [TransactionController::class, 'export'])->name('export');