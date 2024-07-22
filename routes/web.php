<?php


use App\Http\Controllers\Admin\HomeController as AdminHomeController;

use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductOptionController;

use App\Http\Controllers\Admin\UserController;


use App\Http\Controllers\Frontend\ProductCommentController;
use App\Http\Controllers\Frontend\ProductDetailsController;
use App\Http\Controllers\Frontend\ProductListController;

use App\Http\Controllers\Frontend\WishlistController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('{page}-detail/locale/{locale}', function ($page, $locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->where('page', 'blog|product');

Route::prefix('admin')->group(function () {
    Route::get('{page}/locale/{locale}', function ($page, $locale) {
        Session::put('locale', $locale);
        return redirect()->back();
    })->where('page', 'contact|product');
});

// Admin Routes


// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/order-track', [HomeController::class, 'orderTrack'])->name('order.track');
Route::post('product/track/order', [HomeController::class, 'productTrackOrder'])->name('product.track.order');






Route::post('product-comment', [ProductCommentController::class, 'store'])->name('product.comment.store');



Route::get('/product-detail/{id}', [ProductDetailsController::class, 'index'])->name('product.detail');
Route::get('/product-detail-size', [ProductDetailsController::class, 'getSize'])->name('product.detail.size');
Route::get('/product-detail-size-price', [ProductDetailsController::class, 'getPriceBySize'])->name('product.detail.size.price');

Route::get('/shop', [ProductListController::class, 'index'])->name('shop');










// Password Reset Routes...




// End frontend routes
