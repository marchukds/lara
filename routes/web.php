<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Livewire\Admin\Tags\{EditTag, TagList};
use App\Livewire\Admin\Posts\{CreatePost, PostList, UpdatePost};
use App\Livewire\Main\{BlogShow, HomePage, BlogPage, Catalog, ShoppingCart};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController, BrandController};
use App\Livewire\Admin\Categories\{CategoryList, CreateCategory, EditCategory};
use App\Livewire\Admin\Products\{CreateProduct, ProductList, UpdateProduct};

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', HomePage::class)->name('home');
//Route::get('/blog', BlogPage::class)->name('blog');
//Route::get('/blog/show/{slug}', BlogShow::class)->name('blog.detail');

Route::get('/about', App\Http\Controllers\AboutController::class)->name('about');

Route::get('/shop', Catalog::class)->name('shop');
Route::get('/shopping-cart', ShoppingCart::class)->name('shopping.cart');

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

//Route::get('/checkout', function () {
//    return view('index');
//})->name('checkout.index');

//Route::controller(PostController::class)->group(function () {
//    Route::get('/blog', 'index')->name('blog');
//    Route::get('/blog/{id}', 'show');
//});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/checkout', [OrderController::class, 'checkout'])
        ->name('checkout.index');
    Route::post('/checkout/order', [OrderController::class, 'placeOrder'])
        ->name('checkout.place.order');
});


Route::prefix('admin')->group(function () {
    Route::get('', DashboardController::class)->name('admin');
    Route::controller(BrandController::class)->group(function () {
        Route::get('brands/trashed', 'trashed')->name('brands.trashed');
        Route::post('brands/restore/{id}', 'restore')->name('brands.restore');
        Route::delete('brands/force/{id}', 'force')->name('brands.force');
    });

    Route::resource('brands', BrandController::class);

    Route::get('categories', CategoryList::class)->name('categories.index');
    Route::get('categories/create', CreateCategory::class)->name('categories.create');
    Route::get('categories/{category}/edit', EditCategory::class)->name('categories.edit');
    Route::get('products', ProductList::class)->name('products.index');
    Route::get('products/create', CreateProduct::class)->name('products.create');
    Route::get('products/{product}/edit', UpdateProduct::class)->name('products.edit');

    Route::get('posts', PostList::class)->name('posts.index');
    Route::get('posts/create', CreatePost::class)->name('posts.create');
    Route::get('posts/{post}/edit', UpdatePost::class)->name('posts.edit');

    Route::get('tags', TagList::class);
    Route::get('tags/{tag}/edit', EditTag::class)->name('tags.edit');
});





