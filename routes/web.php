<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardInfoController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Error405Controller;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OffersController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ReplyController;
use App\Http\Controllers\User\StripePaymentController;
use Illuminate\Support\Facades\Route;

        /* Routes for users or guests  */

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/{product_name}/{product_id}/details',[HomeController::class,'showProductDetails'])->name('product.details');
Route::post('/{product_name}/cart/add/{product_id}',[HomeController::class,'addToCart'])->name('cart.add')->middleware('auth:sanctum');
Route::get('/cart/show',[CartController::class,'showCart'])->name('cart.show')->middleware('auth:sanctum');
Route::get('/cart/product/{cart_id}/cancel',[CartController::class,'cancelCart'])->name('cart-item.cancel')->middleware('auth:sanctum');
Route::get('/pay/order/cash',[OrderController::class,'payOrderCash'])->name('order.cash')->middleware('auth:sanctum','verified');
Route::get('/pay/order/card/stripe/{total_price}',[StripePaymentController::class,'showFormStripe'])->name('stripe.show')->middleware('auth:sanctum','verified');
Route::post('/pay/order/card/stripe/{total_price}',[StripePaymentController::class,'StoreStripe'])->name('stripe.post')->middleware('auth:sanctum','verified');
Route::get('/orders/show',[OrderController::class,'showOrders'])->name('orders.show')->middleware('auth:sanctum','verified');
Route::get('/order/{order_id}/cancel',[OrderController::class,'cancelOrder'])->name('order.cancel')->middleware('auth:sanctum','verified');
Route::post('/product/{product_id}/comment/store',[CommentController::class,'store'])->name('comment.store')->middleware('auth:sanctum');
Route::POST('/comment/{commentId}/update',[CommentController::class,'update'])->name('comment.modify')->middleware('auth:sanctum');
Route::get('/comment/{id}/delete',[CommentController::class,'destroy'])->name('comment.delete')->middleware('auth:sanctum');
Route::post('/product/{product_id}/comment/{comment_id}/reply/store',[ReplyController::class,'store'])->name('reply.store')->middleware('auth:sanctum');
Route::post('/comment/{comment_id}/reply/{reply_id}',[ReplyController::class,'update'])->name('reply.modify')->middleware('auth:sanctum');
Route::get('/reply/{id}/delete',[ReplyController::class,'delete'])->name('reply.delete')->middleware('auth:sanctum');
Route::get('/product/search',[HomeController::class,'searchInProducts'])->name('product.search');
Route::get('/redirect-to-register',[HomeController::class,'redirectToRegisterForm'])->name('redirect.register');
Route::get('/offers',[OffersController::class,'index'])->name('offers.index');
Route::get('/log_out/user',[HomeController::class,'userLogout'])->name('log_out.user');




        /*  Routes for Admin Login and Logout  */

Route::middleware('admin:admin')->group(function (){
    Route::get('/admin/mido/admin/login', [AdminLoginController::class,'LoginForm']); //show admin login
    Route::post('/admin/mido/admin/login', [AdminLoginController::class,'store'])->name('admin.login'); //store login
});
Route::get('/log_out/admin',[AdminLoginController::class,'destroy'])->name('log_out.admin'); //Do logout


        /*  Routes for Admin  */

Route::middleware(['auth:sanctum,admin', config('jetstream.auth_session')])->group(function ()
{
    Route::prefix('admin')->group(function ()
    {

        Route::get('dashboard/users/info',[AdminDashboardInfoController::class,'showUsersInfo'])->name('admin.dashboard.users.info')->middleware('auth:admin');

        Route::get('dashboard/products/info',[AdminDashboardInfoController::class,'showProductsInfo'])->name('admin.dashboard.products.info')->middleware('auth:admin');

        Route::get('dashboard/orders/info',[AdminDashboardInfoController::class,'showOrdersInfo'])->name('admin.dashboard.orders.info')->middleware('auth:admin');

        Route::get('dashboard/processing-orders/info',[AdminDashboardInfoController::class,'showProcessingOrdersInfo'])->name('admin.dashboard.processing_orders.info')->middleware('auth:admin');

        Route::get('dashboard/delivered-orders/info',[AdminDashboardInfoController::class,'showDeliveredOrdersInfo'])->name('admin.dashboard.delivered_orders.info')->middleware('auth:admin');

        Route::get('/dashboard',[AdminDashboardInfoController::class,'showAdminDashboardStatistics'])->name('admin.dashboard')->middleware('auth:admin');

        Route::get('/categories',[AdminCategoryController::class,'index'])->name('categories.index')->middleware('auth:admin');

        Route::post('/category/store',[AdminCategoryController::class,'store'])->name('category.store')->middleware('auth:admin');

        Route::get('/category/destroy/{id}',[AdminCategoryController::class,'destroy'])->name('category.destroy')->middleware('auth:admin');

        Route::post('/product/store',[AdminProductController::class,'store'])->name('product.store')->middleware('auth:admin');

        Route::get('/product/show',[AdminProductController::class,'show'])->name('products.show')->middleware('auth:admin');

        Route::get('/product/create',[AdminProductController::class,'create'])->name('product.create')->middleware('auth:admin');

        Route::get('/product/edit/{id}',[AdminProductController::class,'edit'])->name('product.edit')->middleware('auth:admin');

        Route::PUT('/product/update/{id}',[AdminProductController::class,'update'])->name('product.update')->middleware('auth:admin');

        Route::get('/product/delete/{id}',[AdminProductController::class,'destroy'])->name('product.destroy')->middleware('auth:admin');

        Route::get('/orders',[AdminOrderController::class,'index'])->name('orders.index')->middleware('auth:admin');

        Route::get('/delivered/{id}',[AdminOrderController::class,'delivered'])->name('delivered')->middleware('auth:admin');

        Route::get('print/pdf/{id}',[AdminOrderController::class,'printPDF'])->name('pdf.print');

        Route::get('/send/email/{id}',[AdminOrderController::class,'sendEmail'])->name('email.send')->middleware('auth:admin');

        Route::post('/send/email/{id}',[AdminOrderController::class,'sendUserEmail'])->name('email.user.send')->middleware('auth:admin');

        Route::get('/orders/search',[AdminOrderController::class,'searchInProducts'])->name('orders.search')->middleware('auth:admin');
    });
});


        /* Handle The Error of 405 Method Not Found */

Route::controller(Error405Controller::class)->group(function (){

    // Handle routes for users and guests
    Route::get('/logout','returnNotFoundPage');
    Route::get('/user/two-factor-authentication','returnNotFoundPage');
    Route::get('/user/password','returnNotFoundPage');
    Route::get('/user/confirmed-two-factor-authentication','returnNotFoundPage');
    Route::get('/user/profile-information','returnNotFoundPage');
    Route::get('/user/password','returnNotFoundPage');
    Route::get('/user/confirmed-two-factor-authentication','returnNotFoundPage');
    Route::get('/two-factor-challenge','returnNotFoundPage');
    Route::get('/_ignition/execute-solution','returnNotFoundPage');
    Route::get('/_ignition/update-config','returnNotFoundPage');
    Route::get('/email/verification-notification','returnNotFoundPage');
    Route::get('/livewire/message/{name}','returnNotFoundPage');
    Route::get('/livewire/upload-file','returnNotFoundPage');
    Route::get('/reset-password','returnNotFoundPage');
    Route::get('/{product_name}/cart/add/{id}','returnNotFoundPage');
    Route::get('product/{product_id}/comment/store','returnNotFoundPage');
    Route::get('/comment/{id}/update','returnNotFoundPage');
    Route::get('/product/{product_id}/comment/{comment_id}/reply/store','returnNotFoundPage');
    Route::get('comment/{comment_id}/reply/{reply_id}','returnNotFoundPage');

  // Handle routes for admin
 Route::prefix('/admin')->group(function (){
     Route::get('/category/store','returnNotFoundAdminPage');
     Route::get('/product/store','returnNotFoundAdminPage');
     Route::get('/product/update/{id}','returnNotFoundAdminPage');
    });
});


