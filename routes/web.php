<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Ecommerce\FrontController;
use App\Http\Controllers\Ecommerce\LoginController;
use App\Http\Controllers\Ecommerce\OrderController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Ecommerce\RegisterController;
use App\Http\Controllers\Admin\OrderController as DashboardOrderController;

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

Route::get('/', [FrontController::class, 'front'])->name('front.index');

Route::get('/product', [FrontController::class, 'product'])->name('front.product');
Route::get('/product/search', [FrontController::class, 'search'])->name('front.product_search');
Route::get('/category/{slug}', [FrontController::class, 'categoryProduct'])->name('front.category');
Route::get('/brand/{slug}', [FrontController::class, 'brandProduct'])->name('front.brand');
Route::get('/size/{slug}', [FrontController::class, 'sizeProduct'])->name('front.size');
Route::get('/product/{slug}', [FrontController::class, 'show'])->name('front.show');

Route::post('cart', [CartController::class, 'addToCart'])->name('front.cart');
Route::get('/cart', [CartController::class, 'listCart'])->name('front.list_cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('front.update_cart');
Route::delete('/cart/delete', [CartController::class, 'deleteCart'])->name('front.delete_cart');

Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');
Route::post('/checkout/processCheckout', [CartController::class, 'processCheckout'])->name('front.store_checkout');
Route::get('/checkout/{invoice}', [CartController::class, 'checkoutFinish'])->name('front.finish_checkout');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/roles', RoleController::class);
    Route::post('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/admin/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::patch('/admin/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

        Route::resource('/admin/category', CategoryController::class)->except(['create', 'show']);
        Route::resource('/admin/brand', BrandController::class)->except(['create', 'show']);
        Route::resource('/admin/size', SizeController::class)->except(['create', 'show']);
        Route::resource('/admin/product', ProductController::class)->except(['create', 'show']);
        Route::resource('/admin/customer', CustomerController::class)->except(['create', 'show']);
        Route::resource('/admin/banner', BannerController::class)->except(['create', 'show']);

        Route::group(['prefix' => 'admin'], function() {
            Route::get('/order', [DashboardOrderController::class, 'index'])->name('order.index');
            Route::get('/order/{invoice}', [DashboardOrderController::class, 'view'])->name('order.view');
            Route::get('/order/payment/{invoice}', [DashboardOrderController::class, 'acceptPayment'])->name('order.approve_payment');
            Route::post('/order/shipping', [DashboardOrderController::class, 'shippingOrder'])->name('order.shipping');
            Route::get('/order/return/{invoice}', [DashboardOrderController::class, 'return'])->name('order.return');
            Route::post('/order/return', [DashboardOrderController::class, 'approveReturn'])->name('order.approveReturn');
            Route::delete('/order/{id}', [DashboardOrderController::class, 'destroy'])->name('order.destroy');
        });

        Route::group(['prefix' => 'admin'], function() {
            Route::get('/report/order', [DashboardController::class, 'orderReport'])->name('report.order');
            Route::get('/report/order/pdf/{daterange}', [DashboardController::class, 'orderReportPdf'])->name('report.orderPDF');
            Route::get('/report/return', [DashboardController::class, 'returnReport'])->name('report.return');
            Route::get('/report/return/pdf/{daterange}', [DashboardController::class, 'returnReportPdf'])->name('report.returnPDF');
            Route::get('/report/product', [DashboardController::class, 'productReport'])->name('report.product');
            Route::get('/report/product/pdf/{daterange}', [DashboardController::class, 'productReportPdf'])->name('report.productPDF');
        });
    });

    Route::middleware(['role:owner'])->group(function () {
        Route::get('/owner/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/owner/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::patch('/owner/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

        Route::group(['prefix' => 'owner'], function() {
            Route::get('/report/order', [DashboardController::class, 'orderReport'])->name('report.order');
            Route::get('/report/order/pdf/{daterange}', [DashboardController::class, 'orderReportPdf'])->name('report.orderPDF');
            Route::get('/report/return', [DashboardController::class, 'returnReport'])->name('report.return');
            Route::get('/report/return/pdf/{daterange}', [DashboardController::class, 'returnReportPdf'])->name('report.returnPDF');
            Route::get('/report/product', [DashboardController::class, 'productReport'])->name('report.product');
            Route::get('/report/product/pdf/{daterange}', [DashboardController::class, 'productReportPdf'])->name('report.productPDF');
        });
    });
});

Route::group(['prefix' => 'member', 'namespace' => 'Ecommerce'], function() {
    Route::get('login', [LoginController::class, 'loginForm'])->name('customer.login');
    Route::post('login', [LoginController::class, 'login'])->name('customer.post_login');

    Route::get('register', [RegisterController::class, 'registerForm'])->name('customer.register');
    Route::post('register', [RegisterController::class, 'register'])->name('customer.post_register');
    Route::get('verify/{token}', [FrontController::class, 'verifyCustomerRegistration'])->name('customer.verify');
});

Route::prefix('customer')->middleware(['customer'])->group(function () {
    Route::get('account', [LoginController::class, 'account'])->name('customer.account');
    Route::get('logout', [LoginController::class, 'logout'])->name('customer.logout');

    Route::get('orders', [OrderController::class, 'index'])->name('customer.orders');
    Route::post('orders/accept', [OrderController::class, 'acceptOrder'])->name('customer.order_accept');
    Route::get('orders/{invoice}', [OrderController::class, 'view'])->name('customer.view_order');
    Route::get('orders/pdf/{invoice}', [OrderController::class, 'pdf'])->name('customer.order_pdf');

    Route::get('payment/{invoice}', [OrderController::class, 'paymentForm'])->name('customer.paymentForm');
    Route::post('payment/save', [OrderController::class, 'storePayment'])->name('customer.storePayment');

    Route::get('address', [FrontController::class, 'addressForm'])->name('customer.addressForm');
    Route::get('setting', [FrontController::class, 'customerSettingForm'])->name('customer.settingForm');
    Route::post('setting', [FrontController::class, 'customerUpdateProfile'])->name('customer.setting');

    Route::get('orders/return/{invoice}', [OrderController::class, 'returnForm'])->name('customer.order_return');
    Route::put('orders/return/{invoice}', [OrderController::class, 'processReturn'])->name('customer.return');

    Route::get('afiliasi', [FrontController::class, 'listCommission'])->name('customer.affiliate');
});
