<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
//all forntend route are here 
Route::get('/', [FontendController::class, 'index'])->name('/');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/adminhome', [HomeController::class, 'adminhome'])->name('admin.adminhome')->middleware('is_admin');

//all admin route are here
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');



// ==============Category Route are here===================
Route::get('category.index', [CategoryController::class, 'index'])->name('category.index');
Route::post('admin.category.categoryadd', [CategoryController::class, 'insertcategory'])->name('category.categoryadd');
Route::get('admin.category.edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::post('admin.category.update/{id}', [CategoryController::class, 'update'])->name('update.category');
Route::get('admin.category.delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
Route::get('admin.category.dective/{id}', [CategoryController::class, 'deactive'])->name('admin.category.deactive');
Route::get('admin.category.active/{id}', [CategoryController::class, 'active'])->name('admin.category.active');


// =======================Brand Route are here=======================
Route::get('brand.index', [BrandController::class, 'index'])->name('brand.index');
Route::post('admin.brand.brandadd', [BrandController::class, 'insertbrand'])->name('brand.brandadd');
Route::get('admin.brand.edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
Route::post('admin.brand.update/{id}', [BrandController::class, 'update'])->name('update.brand');
Route::get('admin.brand.delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
Route::get('admin.brand.deactive/{id}', [BrandController::class, 'deactive'])->name('admin.deactive');
Route::get('admin.brand.active/{id}', [BrandController::class, 'active'])->name('admin.active');

// =============================Products Route are here===========================
Route::get('admin.product.add_products', [ProductController::class, 'addproduct'])->name('add.products');
Route::post('admin.product.store', [ProductController::class, 'storeProduct'])->name('store.product');
Route::get('admin.product.manage_products', [ProductController::class, 'manageproduct'])->name('manage.products');
Route::get('admin.product.edit_product/{id}', [ProductController::class, 'editproduct'])->name('product.edit');
Route::post('admin.product.update_product/{id}', [ProductController::class, 'updateproduct'])->name('product.update');
Route::post('admin.product.update_image', [ProductController::class, 'imageUpdate'])->name('product.image_update');
Route::get('admin.product.delete/{id}', [ProductController::class, 'deleteproduct'])->name('product.delete');
Route::get('admin.product.deactive/{id}', [ProductController::class, 'deactiveproduct'])->name('product.deactive');
Route::get('admin.product.active/{id}', [ProductController::class, 'activeproduct'])->name('product.active');

// ==============================Cupon Route are here========================
Route::get('admin.cupon.index', [CuponController::class, 'index'])->name('cupon.index');
Route::post('admin.cupon.cupon_add', [CuponController::class, 'insertCupon'])->name('cupon.cuponadd');
Route::get('admin.cupon.edit/{id}', [CuponController::class, 'edit'])->name('admin.cupon.edit');
Route::post('admin.cupon.update', [CuponController::class, 'update'])->name('update.cupon');
Route::get('admin.cupon.delete/{id}', [CuponController::class, 'delete'])->name('admin.cupon.delete');
Route::get('admin.cupon.deactive/{id}', [CuponController::class, 'deactive'])->name('admin.deactive');
Route::get('admin.cupon.active/{id}', [CuponController::class, 'active'])->name('admin.active');

// ==================================Order Route are here=======================
Route::prefix('order')->group(function () {
    Route::get('index', [OrderController::class, 'Index'])->name('orders.index');
    Route::get('view/{id}', [OrderController::class, 'View'])->name('order.view');
    Route::get('delete/{id}', [OrderController::class, 'Delete'])->name('order.delete');
});









// =====================All fontend Route are here========================
Route::post('add_to_cart/{product_id}', [CartController::class, 'addToCart']);




// =======================all cart route are here=====================
Route::get('cart_page', [CartController::class, 'Cart']);
Route::get('cart_page', [CartController::class, 'Cart']);
Route::post('cart/update_quary/{id}', [CartController::class, 'cartQutyupdate']);
Route::get('card/quantity/delete/{cart_id}', [CartController::class, 'cartQutydelete']);
Route::post('apply_cuppon', [CartController::class, 'apply_cuppon']);
Route::get('cupon/destroy', [CartController::class, 'Cupondestroy']);
Route::get('checkOut', [CartController::class, 'CheckOut']);



// ======================= all wishlist route are here=================
Route::get('/add/to_wishlist/{product_id}', [WishlistController::class, 'AddToWishlist']);
Route::get('wishlist', [WishlistController::class, 'Wishlist']);
Route::get('card/wishlist/delete/{cart_id}', [WishlistController::class, 'cartwishlistdelete']);

// =========================all product details route are here===================
Route::get('product_details/{product_id}', [FontendController::class, 'ProductDetails']);

// =======checkout controller====================
Route::prefix('checkout')->group(function () {
});

// ==============Order controller are here=================
Route::prefix('Order')->group(function () {
    Route::post('store', [OrderController::class, 'Store'])->name('Order.store');
    Route::get('success', [OrderController::class, 'OrderSuccess'])->name('Order.success');
});

// ===============User controller =========================
Route::prefix('profile')->group(function () {
    Route::get('order', [UserController::class, 'order'])->name('profile.order');
    Route::get('order-view/{order_id}', [UserController::class, 'OrderView'])->name('profile.order-view');
});

// ==========================Shop cotroller and route are here=================
Route::prefix('Shop')->group(function () {
    Route::get('shop-page', [FontendController::class, 'Shop'])->name('Shop.shop-page');
});
// ===========Category wises product show===============
Route::get('category-wises-product-show/{id}', [FontendController::class, 'CatWisePooShow'])->name('category-wises-product-show');





// ====================Search Option are======================
Route::get('search', [FontendController::class, 'search'])->name('search');
