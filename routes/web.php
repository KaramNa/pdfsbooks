<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderReplyMail;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AddBookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RssFeedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderBookController;
use App\Http\Controllers\SingleBookController;
use App\Http\Controllers\DraftedBooksController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SearchResultsController;

Route::get('/', [BooksController::class, 'index'])->name('home');

Route::get('/book/{slug}', [SingleBookController::class, 'index'])->name('single.book');

Route::get('/how-to-download', [BooksController::class, 'howToDowload'])->name('how.to.download');
Route::get('/eBook-digital-formats', [BooksController::class, 'ebooksFormats'])->name('ebooks.formats');
Route::get('get-the-link/{slug}', [BooksController::class, 'getTheLink'])->name('get.the.link');

Route::get('/admin/login-to-hell', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/admin/login-to-hell', [LoginController::class, 'login']);

Route::get('/contact-us', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'sendEmail']);

Route::get('/suggest-a-book', [OrderBookController::class, 'index'])->name('order.book');
Route::post('/books-orders-store', [OrderBookController::class, 'store'])->name('books.orders.store');

Route::post('/post-comment', [CommentController::class, 'comment'])->name('comment');


Route::post('report-the-link/{slug}', [ReportController::class, 'reportTheLink'])->name('report.the.link');

Route::get("/feed", [RssFeedController::class, "feed"])->name("rss.feed");
Route::get("{category}/feed", [RssFeedController::class, "categoryFeed"])->name("rss.category.feed");

Route::middleware(['auth'])->group(function () {
    Route::get("/admin/dashboard", [AdminController::class, "dashboard"])->name('admin.dashboard');
    Route::get("/admin/panel", [AdminController::class, "index"])->name('admin.panel');

    Route::get('admin/admins-details', [AdminController::class, "adminsDetails"])->name('admins.details');

    Route::get('/admin/edit-password', [AdminController::class, 'editPassword'])->name('admin.edit.password');
    Route::post('/admin/update-password/{user}', [AdminController::class, 'updatePassword'])->name('admin.update.password');

    Route::get('notifications/get', [NotificationsController::class, 'getNotificationsData'])->name('notifications.get');
    Route::get('notifications/show', [NotificationsController::class, 'showNotifications'])->name('notifications.show');
    Route::get('/update-notification-status/{id}', [NotificationsController::class, 'updateStatus'])->name('update.notification.status');
    Route::post('/delete-notification/{id}', [NotificationsController::class, 'delete'])->name('delete.notif');

    Route::get("/admin/books/all", [AdminController::class, "allBooks"])->name('all.books');
    Route::get("/admin/books/published", [AdminController::class, "publishedBooks"])->name('published.books');
    Route::get("/admin/books/drafted", [AdminController::class, "draftedBooks"])->name('drafted.books');
    
    Route::get('/admin/reported-links', [ReportController::class, 'showReportedLinks'])->name('reported.links');
    Route::post('delete-report/{id?}', [ReportController::class, 'deleteReport'])->name('delete.report');

    Route::get('admin/search-queries', [SearchResultsController::class, 'index'])->name('search.queries');
    Route::post('admin/delete-query/{id?}', [SearchResultsController::class, 'delete'])->name('delete.query');

    Route::get('admin/category', [CategoryController::class, 'index'])->name('category');
    Route::post('admin/category', [CategoryController::class, 'store'])->name('add.category');
    Route::post('admin/category-delete/{id?}', [CategoryController::class, 'destroy'])->name('destroy.category');
    Route::post('admin/category-update/{id?}', [CategoryController::class, 'update'])->name('update.category');

    Route::get('/add-book', [AddBookController::class, 'index'])->name('add.book');
    Route::post('/add-book', [AddBookController::class, 'store'])->name('store.or.fill.book');
    Route::get('/edit-book/{book}', [AddBookController::class, 'edit'])->name('edit.book');
    Route::post('/update-book/{book}', [AddBookController::class, 'update'])->name('update.book');
    Route::post('/delete-book/{book?}', [AddBookController::class, 'delete'])->name('delete.book');

    Route::get('/admin/books-orders', [OrderBookController::class, 'showOrders'])->name('books.orders');
    Route::post('/delete-order/{id?}', [OrderBookController::class, 'delete'])->name('delete.order');
    Route::post('/order-done/{id}', [OrderBookController::class, 'done'])->name('order.done');

    Route::get('/admin/comments', [CommentController::class, 'index'])->name('all.comments');
    Route::post('/delete-comment/{id?}', [CommentController::class, 'delete'])->name('delete.comment');

    Route::post('/draft/{id}', [BooksController::class, 'draft'])->name('draft');
    Route::post('/publish/{id}', [BooksController::class, 'publish'])->name('publish');

    Route::post('/publish-drafted-books', [DraftedBooksController::class, 'publish'])->name('publish.drafted.books');
    Route::post('/draft-publihsed-books', [DraftedBooksController::class, 'draft'])->name('draft.published.books');

    Route::post('/send-email/{id?}', [OrderReplyMail::class, 'sendMail'])->name('order.reply.mail');
    Route::post('/send-email-report/{id?}', [OrderReplyMail::class, 'sendMailReport'])->name('reports.reply.mail');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

});



