<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\BlogDetailController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginController as FrontendLoginController;
use App\Http\Controllers\Frontend\PrivacyPolicyController;
use App\Http\Controllers\Frontend\ProductCommentController;
use App\Http\Controllers\Frontend\ProductDetailsController;
use App\Http\Controllers\Frontend\ProductListController;
use App\Http\Controllers\Frontend\RegisterController as FrontendRegisterController;
use App\Http\Controllers\Frontend\TermController;
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
Route::group(['prefix' => 'admin'], function () {
    Route::get('/sign-up', [RegisterController::class, 'create'])->name('auth.register');
    Route::post('/sign-up', [RegisterController::class, 'store'])->name('auth.register.store');

    Route::get('/sign-in', [LoginController::class, 'create'])->name('auth.login');
    Route::post('/sign-in', [LoginController::class, 'store'])->name('auth.login.store');

    Route::group(['middleware' => ['auth:web', 'role:administrator|employee']], function () {
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');

        Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');

        Route::group(['prefix' => 'banner'], function () {
            Route::get('/', [BannerController::class, 'index'])->name('admin.banner.index')->middleware(['permission:read banner management']);
            Route::get('/create', [BannerController::class, 'create'])->name('admin.banner.create')->middleware(['permission:create banner management']);
            Route::post('/', [BannerController::class, 'store'])->name('admin.banner.store');
            Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('admin.banner.edit')->middleware(['permission:update banner management']);
            Route::patch('/{id}', [BannerController::class, 'update'])->name('admin.banner.update');
            Route::get('/{id}', [BannerController::class, 'destroy'])->name('admin.banner.destroy')->middleware(['permission:delete banner management']);
        });

        Route::group(['prefix' => 'brand'], function () {
            Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index')->middleware(['permission:read brand management']);
            Route::get('/create', [BrandController::class, 'create'])->name('admin.brand.create')->middleware(['permission:create brand management']);
            Route::post('/', [BrandController::class, 'store'])->name('admin.brand.store');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit')->middleware(['permission:update brand management']);
            Route::patch('/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
            Route::get('/{id}', [BrandController::class, 'destroy'])->name('admin.brand.destroy')->middleware(['permission:delete brand management']);
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', [ProductCategoryController::class, 'index'])->name('admin.category.index')->middleware(['permission:read category management']);
            Route::get('/create', [ProductCategoryController::class, 'create'])->name('admin.category.create')->middleware(['permission:create category management']);
            Route::post('/', [ProductCategoryController::class, 'store'])->name('admin.category.store');
            Route::get('/edit/{id}', [ProductCategoryController::class, 'edit'])->name('admin.category.edit')->middleware(['permission:update category management']);
            Route::patch('/{id}', [ProductCategoryController::class, 'update'])->name('admin.category.update');
            Route::get('/{id}', [ProductCategoryController::class, 'destroy'])->name('admin.category.destroy')->middleware(['permission:delete category management']);
        });

        Route::group(['prefix' => 'post-category'], function () {
            Route::get('/', [PostCategoryController::class, 'index'])->name('admin.post-category.index')->middleware(['permission:read blog management']);
            Route::get('/create', [PostCategoryController::class, 'create'])->name('admin.post-category.create')->middleware(['permission:create blog management']);
            Route::post('/', [PostCategoryController::class, 'store'])->name('admin.post-category.store');
            Route::get('/edit/{id}', [PostCategoryController::class, 'edit'])->name('admin.post-category.edit')->middleware(['permission:update blog management']);
            Route::patch('/{id}', [PostCategoryController::class, 'update'])->name('admin.post-category.update');
            Route::get('/{id}', [PostCategoryController::class, 'destroy'])->name('admin.post-category.destroy')->middleware(['permission:delete blog management']);
        });

        Route::group(['prefix' => 'post'], function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.post.index')->middleware(['permission:read blog management']);
            Route::get('/create', [PostController::class, 'create'])->name('admin.post.create')->middleware(['permission:create blog management']);
            Route::post('/', [PostController::class, 'store'])->name('admin.post.store');
            Route::get('/edit/{id}', [PostController::class, 'edit'])->name('admin.post.edit')->middleware(['permission:update blog management']);
            Route::patch('/{id}', [PostController::class, 'update'])->name('admin.post.update');
            Route::get('/{id}', [PostController::class, 'destroy'])->name('admin.post.destroy')->middleware(['permission:delete blog management']);
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('/comment/{id}', [ProductController::class, 'updateCommentStatus'])->name('admin.product.comment-status')->middleware(['permission:update product management']);
            Route::get('/', [ProductController::class, 'index'])->name('admin.product.index')->middleware(['permission:read product management']);
            Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create')->middleware(['permission:create product management']);
            Route::post('/', [ProductController::class, 'store'])->name('admin.product.store');
            Route::get('/show/{id}', [ProductController::class, 'show'])->name('admin.product.show')->middleware(['permission:read product management']);
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit')->middleware(['permission:update product management']);
            Route::patch('/{id}', [ProductController::class, 'update'])->name('admin.product.update');
            Route::get('/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy')->middleware(['permission:delete product management']);

        });

        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('admin.role.index')->middleware(['permission:read role management']);
            Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create')->middleware(['permission:create role management']);
            Route::post('/', [RoleController::class, 'store'])->name('admin.role.store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit')->middleware(['permission:update role management']);
            Route::patch('/{id}', [RoleController::class, 'update'])->name('admin.role.update');
            Route::get('/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy')->middleware(['permission:delete role management']);
        });

        Route::group(['prefix' => 'product-option'], function () {
            Route::get('/', [ProductOptionController::class, 'index'])->name('admin.product-option.index')->middleware(['permission:read product option management']);
            Route::get('/create', [ProductOptionController::class, 'create'])->name('admin.product-option.create')->middleware(['permission:create product option management']);
            Route::post('/', [ProductOptionController::class, 'store'])->name('admin.product-option.store');
            Route::get('/edit/{id}', [ProductOptionController::class, 'edit'])->name('admin.product-option.edit')->middleware(['permission:update product option management']);
            Route::patch('/{id}', [ProductOptionController::class, 'update'])->name('admin.product-option.update');
            Route::get('/{id}', [ProductOptionController::class, 'destroy'])->name('admin.product-option.destroy')->middleware(['permission:delete product option management']);
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('admin.order.index')->middleware(['permission:read order management']);
            Route::get('/show/{id}', [OrderController::class, 'show'])->name('admin.order.show')->middleware(['permission:read order management']);
            Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('admin.order.edit')->middleware(['permission:update order management']);
            Route::patch('/{id}', [OrderController::class, 'update'])->name('admin.order.update');
            Route::get('/{id}', [OrderController::class, 'destroy'])->name('admin.order.destroy')->middleware(['permission:delete order management']);
        });

        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', [ContactController::class, 'index'])->name('admin.contact.index')->middleware(['permission:read contact management']);
            Route::get('/show/{id}', [ContactController::class, 'show'])->name('admin.contact.show')->middleware(['permission:read contact management']);
            Route::get('/{id}', [ContactController::class, 'destroy'])->name('admin.contact.destroy')->middleware(['permission:delete contact management']);
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index')->middleware(['permission:read user management']);
            Route::get('/create', [UserController::class, 'create'])->name('admin.users.create')->middleware(['permission:create user management']);
            Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit')->middleware(['permission:edit user management']);
            Route::patch('/{id}', [UserController::class, 'update'])->name('admin.users.update');
            Route::get('/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy')->middleware(['permission:delete user management']);
        });
    });
});

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/order-track', [HomeController::class, 'orderTrack'])->name('order.track');
Route::post('product/track/order', [HomeController::class, 'productTrackOrder'])->name('product.track.order');


Route::get('/about-us', [AboutController::class, 'index']);

Route::get('/contact', [ContactController::class, 'createForm']);
Route::post('/contact', [ContactController::class, 'ContactUsForm'])->name('contact.store');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/blog-detail/{id}', [BlogDetailController::class, 'index'])->name('blog.detail');

Route::post('product-comment', [ProductCommentController::class, 'store'])->name('product.comment.store');

Route::get('/login', [FrontendLoginController::class, 'index']);
Route::post('/login', [FrontendLoginController::class, 'login'])->name('frontend.login');
Route::get('/logout', [FrontendLoginController::class, 'logout'])->name('frontend.logout');

Route::get('/register', [FrontendRegisterController::class, 'index']);
Route::post('/register', [FrontendRegisterController::class, 'register'])->name('frontend.register');

Route::get('/product-detail/{id}', [ProductDetailsController::class, 'index'])->name('product.detail');
Route::get('/product-detail-size', [ProductDetailsController::class, 'getSize'])->name('product.detail.size');
Route::get('/product-detail-size-price', [ProductDetailsController::class, 'getPriceBySize'])->name('product.detail.size.price');

Route::get('/shop', [ProductListController::class, 'index'])->name('shop');

Route::group(['middleware' => ['auth:web', 'verified']], function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('frontend.checkout.store');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    Route::prefix('/my-account')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('frontend.user.index');
        Route::patch('/{id}', [AccountController::class, 'update'])->name('frontend.user.update');
        Route::get('/order-detail/{id}', [AccountController::class, 'orderDetail'])->name('frontend.user.order-detail');
        Route::get('/order-cancel/{id}', [AccountController::class, 'orderCancel'])->name('frontend.user.order-cancel');
    });
});

Route::get('/payment-return', [CheckoutController::class, 'paymentReturn'])->name('frontend.checkout.vnpay');

Route::get('/cart', [CartController::class, 'index'])->middleware('auth:web')->name('cart');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/wishlist', [WishlistController::class, 'index']);

Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index']);

Route::get('/terms', [TermController::class, 'index']);

Route::get('/email/verify', function () {
    return view('frontend.pages.email-verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    toastr()->success(__('frontend.Email verified successfully!'));
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    toastr()->success(__('frontend.Email verification link sent successfully!'));
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Password Reset Routes...
Route::get('/forgot-password', function () {
    return view('frontend.pages.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    toastr()->success(__('frontend.Reset password link sent successfully!'));
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('frontend.pages.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {

    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    toastr()->success(__('frontend.Password reset successfully!'));

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('frontend.login')->with(['status', __($status)])
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

// End frontend routes
