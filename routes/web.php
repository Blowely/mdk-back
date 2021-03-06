<?php

use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Books\BooksController;

Route::get('/', function(){
    return response()->json([
        'res' => 'ok',
        'sgdfg' => 'ok',
    ]);
});

Route::post('/register', [UsersController::class, 'reg'])->name('reg');
Route::post('/login', [UsersController::class, 'auth'])->name('login');
Route::post('/test', [UsersController::class, 'test'])->name('test');

Route::post('/add', [BooksController::class, 'addProduct'])->name('addProduct');
Route::post('/add-transaction', [BooksController::class, 'addTransaction'])->name('addTransaction');
Route::post('/add-customer', [BooksController::class, 'addCustomer'])->name('addCustomer');
Route::post('/add-user', [BooksController::class, 'addUser'])->name('addUser');
Route::post('/add-category', [BooksController::class, 'addCategory'])->name('addCategory');
Route::post('/update', [BooksController::class, 'updateProduct'])->name('updateProduct');
Route::post('/remove', [BooksController::class, 'removeProduct'])->name('removeProduct');

Route::get('/products', [BooksController::class, 'getProducts'])->name('getProducts');
Route::get('/categories/{slug}', [BooksController::class, 'getProductsCategory'])->name('getProductsCategory');
Route::get('/categories', [BooksController::class, 'getCategories'])->name('getCategories');
Route::get('/customers', [BooksController::class, 'getCustomers'])->name('getCustomers');
Route::get('/users', [BooksController::class, 'getUsers'])->name('getUsers');
Route::get('/transactions', [BooksController::class, 'getTransactions'])->name('getTransactions');
Route::get('/products/{slug}', [BooksController::class, 'getProduct'])->name('getProduct');

Route::get('/tours_date  ', [BooksController::class, 'getTourInExactDate'])->name('getTour');
//Route::get('/tours_date/{date_min}/{date_max}/{passengers}', [ToursControllers::class, 'getTourInExactDate'])->name('getTourInExactDate');

