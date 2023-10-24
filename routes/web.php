<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ChangelogsController;
use App\Http\Controllers\UsermanagementController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Transactions Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('checkUserRole:1,2'); // Hanya mengizinkan akun dengan role "1" dan "2" untuk akses
Route::post('/cart', [CartController::class, 'store'])->name('cart.store')->middleware('checkUserRole:1,2');
Route::post('/cart/change-qty', [CartController::class, 'changeQty'])->middleware('checkUserRole:1,2');
Route::delete('/cart/delete', [CartController::class, 'delete'])->middleware('checkUserRole:1,2');
Route::delete('/cart/empty', [CartController::class, 'empty'])->middleware('checkUserRole:1,2');
Route::get('/invoice/{no_order}', [CartController::class, 'invoice'])->name('invoice');
// Route::get('/struk/{no_order}', [CartController::class, 'struk'])->name('struk');

//Order History Routes
Route::resource('orders', OrderController::class)->middleware('checkUserRole:1,2');
Route::get('/delete_order/{id}', [OrderController::class,'TransactionDelete'])->middleware('checkUserRole:1');

//User Account Routes
Route::post('/change_role/{id}', [App\Http\Controllers\UsermanagementController::class,'changeRole'])->name('user.changeRole')->middleware('checkUserRole:1');
Route::get('user_list', [App\Http\Controllers\UsermanagementController::class,'UserList'])->name('user.index')->middleware('checkUserRole:1');
Route::get('/edit_user/{id}', [App\Http\Controllers\UsermanagementController::class,'UserEdit'])->middleware('checkUserRole:1');
Route::post('/update_user/{id}', [App\Http\Controllers\UsermanagementController::class,'UserUpdate'])->middleware('checkUserRole:1');
Route::get('/delete_user/{id}', [App\Http\Controllers\UsermanagementController::class,'UserDelete'])->middleware('checkUserRole:1');

//Changelogs Routes
Route::get('changelogs', [App\Http\Controllers\ChangelogsController::class,'index'])->name('changelogs.index')->middleware('checkUserRole:1,2');

//Settings Routes
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index')->middleware('checkUserRole:1,2');
Route::post('/settings', [SettingController::class, 'store'])->name('settings.store')->middleware('checkUserRole:1,2');

//Products Routes
Route::resource('products', ProductController::class)->middleware('checkUserRole:1,2');
Route::post('/update-purchase-price', [ProductController::class, 'updatePurchasePrice'])->name('products.updatePurchasePrice')->middleware('checkUserRole:1');
Route::get('/delete_products/{id}', [ProductController::class,'ProductsDelete'])->middleware('checkUserRole:1');

//Export Routes
Route::get('/orders/export', 'OrderController@exportToExcel')->name('orders.export');
Route::get('export', [OrderController::class, 'export'])->name('orders.export');

//Struk Route
Route::get('/struk/{orders}', [OrderController::class, 'printStruk'])->name('struk');
