<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;

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

Route::get('/login', [LoginController::class, 'login']);

Route::post('/process-login', [LoginController::class, 
    'processLogin'])->name('process-login');

Route::resource('user', UserController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/details/{slug}', [HomeController::class, 'product'])->name('details');

Route::post('/add-cart', [HomeController::class, 'addCart'])->name('addCart');

Route::get('/view-cart', [HomeController::class, 'viewCart'])->name('viewCart');

Route::post('/update-cart', [HomeController::class, 'updateCart'])
            ->name('updateCart');

Route::post('/delete-cart-item', [HomeController::class, 'deleteCartItem'])
            ->name('deleteCartItem');

// 'namespace' => 'admin'
Route::group(
    ['middleware' => 'islogin', 'as' => 'admin.'],
    function () {

        // route giỏ hàng, view cart để đây

        Route::group(
            ['middleware' => 'isadmin'],
            function () {
                Route::resource('product', ProductController::class);
            });
});