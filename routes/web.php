<!-- Route::middleware(['auth'])->group(function () {

    Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard', [
            'totalUsers' => \App\Models\User::count(),
            'totalProducts' => \App\Models\Product::count(),
        ]);
    })->name('dashboard');

});

    Route::resource('products', ProductController::class);

    Route::get('/export', [ProductController::class, 'export'])
        ->middleware('can:export-product');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

}); -->

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'totalUsers' => User::count(),
            'totalProducts' => Product::count(),
        ]);
    })->name('dashboard');

    // PRODUCT CRUD
    Route::resource('products', ProductController::class);

    // EXPORT (ADMIN ONLY)
    Route::get('/export', [ProductController::class, 'export'])
        ->middleware('can:export-product')
        ->name('export');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';