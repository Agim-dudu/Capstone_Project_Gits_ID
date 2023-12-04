<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ShopController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PerusahaanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;

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

Route::get('/403', function () {return view('403');})->name('403');
Route::get('/404', function () {return view('404');})->name('404');

Route::get('/', [IndexController::class, 'index']);
Route::get('/', [IndexController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactFormController::class, 'index'])->name('contact');


Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

Route::get('/product/detail/{id}', [ShopController::class, 'show'])->name('product.show');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::middleware('auth', 'verified')->group(function () {

    Route::get('/payment', [PaymentController::class, 'index'])->name('checkout.index');
    Route::post('/payments', [PaymentController::class, 'create'])->name('checkout.create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('update.avatar');
    Route::put('/update-address', [ProfileController::class, 'updateAddress'])->name('profile.address');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add.item');
    Route::delete('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove.item');

    Route::get('/product{id}', [CartController::class, 'addToCart'])->name('add_to_cart');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart', [CartController::class, 'CekOngkir']);
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    
    Route::get('/cek-ongkir', [CartController::class, 'index'])->name('cek-ongkir');

    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    Route::post('/contact', [ContactFormController::class, 'sendEmail'])->name('contact.send');

    Route::get('/my-order', [MyOrderController::class, 'index'])->name('my-order');
    Route::get('/detail-order/{orderId}', [MyOrderController::class, 'showOrderDetail'])->name('order-detail.show');
    Route::delete('/my-orders/{orderId}', [MyOrderController::class, 'deleteOrder'])->name('delete-order');
    Route::get('/order/{orderId}/pdf/invoice', [MyOrderController::class, 'DownloadInvoicePDF'])->name('eksport.pdf.invoice');


    Route::group(['prefix' => 'role', 'middleware' => 'role', 'as' => 'role.'], function () {

        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
        Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/admin/user/{id}/delete', [UserController::class, 'destroy'])->name('admin.user.destroy');
        Route::get('/admin/user/search', [UserController::class, 'search'])->name('admin.user.search');

        Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/admin/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/admin/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/admin/product/{id}/delete', [ProductController::class, 'destroy'])->name('admin.product.delete');
        Route::get('/admin/product/search', [ProductController::class, 'search'])->name('admin.product.search');

        Route::get('/admin/transaction', [TransactionController::class, 'index'])->name('admin.transactions');
        Route::get('/admin/transaction/{userId}/{paymentId}/edit', [TransactionController::class, 'edit'])->name('admin.transaction.edit');
        Route::put('/admin/transaction/{orderId}/update', [TransactionController::class, 'update'])->name('admin.transaction.update');
        Route::get('/admin/transaction/search', [TransactionController::class, 'search'])->name('admin.transaction.search');
        Route::delete('/admin/transaction/{orderId}/delete', [TransactionController::class, 'destroy'])->name('admin.transaction.delete');

        Route::get('/admin/perusahaan', [PerusahaanController::class, 'index'])->name('admin.perusahaan');
        Route::get('/admin/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('admin.perusahaan.edit');
        Route::put('/admin/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('admin.perusahaan.update');
        Route::delete('/admin/perusahaan/{id}', [PerusahaanController::class, 'delete'])->name('admin.perusahaan.delete');

        Route::get('/admin/eksport/pdf/perusahaan', [PerusahaanController::class, 'DownloadPerusahaanPDF'])->name('admin.eksport.pdf.perusahaan');
        Route::get('/admin/eksport/pdf/user', [UserController::class, 'DownloadUserPDF'])->name('admin.eksport.pdf.user');
        Route::get('/admin/eksport/pdf/transaksi', [TransactionController::class, 'DownloadTransactionPDF'])->name('admin.eksport.pdf.transaction');
        Route::get('/admin/eksport/pdf/product', [ProductController::class, 'DownloadProductPDF'])->name('admin.eksport.pdf.product');

        Route::get('/admin/transaction/export-excel', [TransactionController::class, 'exportTransaction'])->name('admin.export.excel.transaction');
        Route::get('/admin/perusahaan/export-excel', [PerusahaanController::class, 'exportPerusahaans'])->name('admin.export.excel.perusahaan');
        Route::get('/admin/user/export-excel', [UserController::class, 'exportUsers'])->name('admin.export.excel.user');
        Route::get('/admin/product/export-excel', [ProductController::class, 'exportProduct'])->name('admin.export.excel.product');

    });

    
});

require __DIR__.'/auth.php';
