<?php

declare(strict_types=1);

use App\Http\Controllers\Front\CatalogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\QuoteCartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])
    ->name('catalog.index');

Route::get('/catalog/{category:slug}', [CatalogController::class, 'category'])
    ->name('catalog.category');

Route::get('/equipment/{product:slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::post('/equipment/{product:slug}/quote', [ProductController::class, 'quote'])
    ->name('products.quote');

Route::get('/quote', [QuoteCartController::class, 'index'])
    ->name('quote.index');

Route::post('/quote/{product:slug}/add', [QuoteCartController::class, 'add'])
    ->name('quote.add');

Route::delete('/quote/{product:slug}/remove', [QuoteCartController::class, 'remove'])
    ->name('quote.remove');

Route::post('/quote/submit', [QuoteCartController::class, 'submit'])
    ->name('quote.submit');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');
