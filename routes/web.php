<?php


use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// ==== Frontend Routes ==== //

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/books', [FrontendController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [FrontendController::class, 'show'])->name('books.show');

Route::get('/google-search', [FrontendController::class, 'searchGoogleBooks'])->name('books.google-search');



// ==== Authentication Routes ==== //

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==== Admin Routes ==== //
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [BookController::class, 'dashboard'])->name('admin.dashboard');

    // Books
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('admin.books.index');
        Route::get('/create', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('/', [BookController::class, 'store'])->name('admin.books.store');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
        Route::put('/{book}', [BookController::class, 'update'])->name('admin.books.update');
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');
        Route::put('/{id}/toggle-availability', [BookController::class, 'toggleAvailability'])
            ->name('admin.books.toggle');
    });

    // Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });
});
