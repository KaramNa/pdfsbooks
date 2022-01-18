<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AddBookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderBookController;
use App\Http\Controllers\SingleBookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DraftedBooksController;
use App\Http\Controllers\OrderReplyMail;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RssFeedController;
use App\Http\Controllers\SearchResultsController;

Route::get('/', [BooksController::class, 'index'])->name('home');

Route::get('/categories/{category:slug}', [BooksController::class, 'index'])->name('category.show');
Route::get('/how-to-download', [BooksController::class, 'howToDowload'])->name('how.to.download');
Route::get('/eBook-digital-formats', [BooksController::class, 'ebooksFormats'])->name('ebooks.formats');
Route::get('get-the-link/{slug}', [BooksController::class, 'getTheLink'])->name('get.the.link');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/book/{slug}', [SingleBookController::class, 'index'])->name('single.book');

Route::get('/contact-us', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'sendEmail']);

Route::get('/order-a-book', [OrderBookController::class, 'index'])->name('order.book');
Route::post('/books-orders-store', [OrderBookController::class, 'store'])->name('books.orders.store');

Route::post('/post-comment', [CommentController::class, 'comment'])->name('comment');

Route::get('/update-notification/{id}', [NotificationController::class, 'update'])->name('notif.seen');
Route::post('/delete-notification/{id}', [NotificationController::class, 'delete'])->name('delete.notif');

Route::post('report-the-link/{slug}', [ReportController::class, 'reportTheLink'])->name('report.the.link');

Route::get("/feed", [RssFeedController::class, "feed"])->name("rss.feed");

Route::middleware(['auth'])->group(function () {
    Route::get('reported-links', [ReportController::class, 'showReportedLinks'])->name('reported.links');
    Route::post('delete-report/{id}', [ReportController::class, 'deleteReport'])->name('delete.report');
    Route::get('search-results', [SearchResultsController::class, 'index'])->name('search.results');
    Route::post('delete-query/{id}', [SearchResultsController::class, 'delete'])->name('delete.query');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category', [CategoryController::class, 'store'])->name('add.category');
    Route::get('/add-book', [AddBookController::class, 'index'])->name('add.book');
    Route::post('/add-book', [AddBookController::class, 'store'])->name('store.or.fill.book');
    Route::get('/edit-book/{book}', [AddBookController::class, 'edit'])->name('edit.book');
    Route::post('/update-book/{book}', [AddBookController::class, 'update'])->name('update.book');
    Route::post('/delete-book/{book}', [AddBookController::class, 'delete'])->name('delete.book');
    Route::get('/books-orders', [OrderBookController::class, 'showOrders'])->name('books.orders');
    Route::post('/delete-order/{id}', [OrderBookController::class, 'delete'])->name('delete.order');
    Route::post('/order-done/{id}', [OrderBookController::class, 'done'])->name('order.done');
    Route::post('/delete-comment/{id}', [CommentController::class, 'delete'])->name('delete.comment');
    Route::post('/draft/{id}', [BooksController::class, 'draft'])->name('draft');
    Route::post('/publish/{id}', [BooksController::class, 'publish'])->name('publish');
    Route::get('/drafted-books-show', [DraftedBooksController::class, 'index'])->name('drafted.books');
    Route::post('/drafted-books-publish', [DraftedBooksController::class, 'publish'])->name('publish.drafted.books');

    Route::post('/send-email/{id}', [OrderReplyMail::class, 'sendMail'])->name('order.reply.mail');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
