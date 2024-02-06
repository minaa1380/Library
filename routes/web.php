<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Frontend\BooksController as FrontendBooksController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController;
use App\Http\Controllers\Frontend\ReservesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Models\Config;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/a', function () {
    $records = User::all();
    foreach ($records as $item) {
        $res = str_replace(' ', '-', $item->membershipID);
        $item->update(['membershipID' => $res]);
    }
});

Route::get('/panel', [UserController::class, 'index'])->middleware('auth')->name('panel');

Route::group(['prefix' => 'panel', 'middleware' => 'auth'], function () {
    Route::get('/books', [FrontendBooksController::class, 'index'])->name('panel.books.index');
    Route::post('/books/search', [FrontendBooksController::class, 'search'])->name('panel.books.search');
    Route::get('/reserves', [ReservesController::class, 'index'])->name('panel.reserves.index');
    Route::post('/reserves/search', [ReservesController::class, 'search'])->name('panel.reserves.search');
    Route::get('/about', [HomeController::class, 'aboutUs'])->name('about');
    Route::get('/contact', [HomeController::class, 'contactUs'])->name('contact');
    Route::post('/contact/store', [HomeController::class, 'store'])->name('contact.store');
});

Route::get('/', [UserController::class, 'check'])->middleware('auth');
Route::get('/profile/index', [FrontendProfileController::class, 'index'])->middleware('auth')->name('myProfile.index');
Route::post('/profile/update', [FrontendProfileController::class, 'update'])->middleware('auth')->name('myProfile.update');
Route::post('/user/register', [UserController::class, 'store'])->name('user.register');
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::resource('/users', UsersController::class)->except('show');
    Route::resource('/books', BooksController::class)->except('show');
    Route::resource('/categories', CategoriesController::class)->except('show', 'create', 'edit');
    Route::post('/books/search', [BooksController::class, 'search'])->name('books.search');
    Route::post('/reserve/search', [ReserveController::class, 'search'])->name('reserve.search');
    Route::get('/book/{id}/reserve', [BooksController::class, 'reserve'])->name('books.reserve');
    Route::post('/user/book/reserve', [UsersController::class, 'reserve'])->name('users.books.reserve');
    Route::post('/users/search/json', [UsersController::class, 'searchJson'])->name('users.search.json');
    Route::post('/books/search/json', [BooksController::class, 'searchJson'])->name('books.search.json');
    Route::resource('/reserve', ReserveController::class)->except(['show']);
    Route::get('/reserve/delivery/{id}', [ReserveController::class, 'delivery'])->name('reserve.delivery');
    Route::get('/config', [ConfigController::class, 'index'])->name('config.index');
    Route::post('/config/store', [ConfigController::class, 'store'])->name('config.store');
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

    Route::post('users/search', [UsersController::class, 'search'])->name('users.search');
    Route::post('category/search', [CategoriesController::class, 'search'])->name('category.search');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
