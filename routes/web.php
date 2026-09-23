<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Public\PublicArticleController;
use App\Http\Controllers\Public\PublicCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Auth::routes();

Route::name('')->group(function () {
    Route::get('/', [GeneralController::class, 'home'])->name('general.home');
    Route::get('/news', [PublicArticleController::class, 'index'])->name('articles.index');
    Route::get('/news/{slug}', [PublicArticleController::class, 'show'])->name('articles.show');
    Route::get('/categories', [PublicCategoryController::class, 'index'])->name('categories.index');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', function (): View {
        return view('pages.admin.dashboard');
    })->name('dashboard');

    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article_slug}', [AdminArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{article_slug}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article_slug}', [AdminArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article_slug}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');

    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category_slug}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category_slug}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category_slug}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
});
