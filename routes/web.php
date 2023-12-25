<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Livewire\Admin\Tags\{EditTag, TagList};
use App\Livewire\Admin\Roles\{RoleList, EditRole};
use App\Livewire\Admin\Users\{UserList, EditUser};
use App\Livewire\Admin\Posts\{CreatePost, PostList, UpdatePost};
use App\Livewire\Main\{BlogShow, HomePage, BlogPage, Catalog, ShoppingCart};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController, BrandController};
use App\Livewire\Admin\Categories\{CategoryList, CreateCategory, EditCategory};
use App\Livewire\Admin\Products\{CreateProduct, ProductList, UpdateProduct};
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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

Route::get('/about', App\Http\Controllers\AboutController::class)->name('about');

Route::get('/shop', Catalog::class)->name('shop');
Route::get('/shopping-cart', ShoppingCart::class)->name('shopping.cart');

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

//Email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
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
    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/order', [OrderController::class, 'placeOrder'])->name('checkout.place.order');

    Route::group(['middleware' => ['role:admin|writer']], function () {
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

            Route::get('roles', RoleList::class);
            Route::get('roles/{role}/edit', EditRole::class)->name('roles.edit');

            Route::get('users', UserList::class);
            Route::get('users/{user}/edit', EditUser::class)->name('users.edit');
        });
    });
});






