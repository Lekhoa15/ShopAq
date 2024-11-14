<?php


use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Banner\BannerController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\shop\ShopController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\Testimonial\TestimonialController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Why\WhyController;

//login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

//logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


//register
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

//password reset
// Form yêu cầu gửi mã xác nhận
Route::get('/password/forgot', [ForgotPasswordController::class, 'showForgotPassForm'])->name('password.forgot');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');

// Form đặt lại mật khẩu
Route::get('/password/reset', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.reset.form');
Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');



//home
Route::get('home', [HomeController::class, 'index'])->name('home');
// Route::get('/products', [HomeController::class, 'allProducts'])->name('products.all');

//verify-email
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::get('/load-more-products/{page}', [HomeController::class, 'loadMoreProducts'])->name('products.load_more');


Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('/products/{id}/update', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');


// cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
// Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');


// contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact');
Route::get('/thankyou', function () {
    return view('shop.thankyou');
})->name('thankyou');

//shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// why us

Route::get('/why', [WhyController::class, 'index'])->name('why');

// testimonial

Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');


//banner
Route::resource('banners', BannerController::class);


Route::post('/checkout', [StripePaymentController::class, 'checkout'])->name('checkout');
Route::get('/payment/success', [StripePaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [StripePaymentController::class, 'cancel'])->name('payment.cancel');


//refund
Route::post('/payment/refund/{payment}', [StripePaymentController::class, 'refund'])->name('payment.refund');

