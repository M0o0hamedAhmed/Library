<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;

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






Route::get('/', function () { return view('welcome'); })->name('main');
Route::post('/message/send',[MessageController::class,'send'] )->name('message.send');
// Route::get('/authors', 'AuthorController@index');





// Auth

// register
Route::get('/register',[AuthController::class,'register'])->name('auth.register') ;
Route::post('/do-register',[AuthController::class,'doRegister'])->name('auth.doRegister') ;

// login
Route::get('/login',[AuthController::class,'login'])->name('auth.login') ;
Route::post('/do-login',[AuthController::class,'doLogin'])->name('auth.doLogin') ;



//logout
//Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout') ;





//  Authors
//  Read
Route::get('/authors/index',[AuthorController::class, 'index'])->name('authors.allAuthors') ;
Route::get('/authors/latest',[AuthorController::class, 'latest'])->name('authors.latestAuthors') ;
Route::get('/authors',[AuthorController::class, 'paginate'])->name('authors.paginateAuthors') ;
Route::get('/authors/show/{id}',[AuthorController::class, 'show'])->name('authors.showAuthors') ;
Route::get('/authors/search/{word}',[AuthorController::class, 'search'])->name('authors.searchAuthors') ;

// Create
//Route::get('/authors/create',[AuthorController::class, 'create'])->name('authors.createAuthors') ;
Route::post('/author/store',[AuthorController::class,'store'])->name('authors.store') ;

// Update
//Route::get('/authors/edit/{id}',[AuthorController::class,'edit'])->name('authors.edit');
Route::post('/authors/update/{id}',[AuthorController::class,'update'])->name('authors.update') ;

//  Delete
//Route::get('/authors/delete/{id}',[AuthorController::class,'delete'])->name('authors.delete') ;







//  Books
//  Read
//Route::get('/books/index',[BookController::class, 'index'])->name('books.allBooks') ;
//Route::get('/books/latest',[BookController::class, 'latest'])->name('books.latestBooks') ;

Route::get('/books',[BookController::class, 'paginate'])->name('books.paginateBooks');
Route::get('/books/show/{id}',[BookController::class, 'show'])->name('books.showBooks') ;
//Route::get('/books/search/{word}',[BookController::class, 'search'])->name('books.searchBooks') ;

// Create
//Route::get('/books/create',[BookController::class, 'create'])->name('books.createBooks') ;
Route::post('/books/store',[BookController::class,'store'])->name('books.store') ;

// Update
//Route::get('/books/edit/{id}',[BookController::class,'edit'])->name('books.edit');
Route::post('/books/update/{id}',[BookController::class,'update'])->name('books.update') ;

//  Delete
//Route::get('/books/delete/{id}',[BookController::class,'delete'])->name('books.delete') ;

// Send message





Route::middleware('userAuth')->group(function (){
    Route::middleware('isAdmin')->group(function (){
        Route::get('/books/delete/{id}',[BookController::class,'delete'])->name('books.delete') ;
        Route::get('/authors/delete/{id}',[AuthorController::class,'delete'])->name('authors.delete') ;
    });

//logout
    Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout') ;

//  Authors
// Create
    Route::get('/authors/create',[AuthorController::class, 'create'])->name('authors.createAuthors') ;

// Update
    Route::get('/authors/edit/{id}',[AuthorController::class,'edit'])->name('authors.edit');

//  Delete


//  Books
//  Read


// Create
    Route::get('/books/create',[BookController::class, 'create'])->name('books.createBooks') ;

// Update
    Route::get('/books/edit/{id}',[BookController::class,'edit'])->name('books.edit');


}) ;

