<?php

use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('index');
})->name('home');

Route::get('/about', App\Http\Controllers\AboutController::class)->name('about');

Route::controller(PostController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog');
    Route::get('/blog/{id}', 'show');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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

//    Route::get('posts', PostList::class);

});





