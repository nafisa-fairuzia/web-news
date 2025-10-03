<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('news.show');
Route::view('/contact', 'news.contact')->name('contact');
Route::get('/about', [NewsController::class, 'about'])->name('about');

Route::get('/login', fn() => view('auth.login'))->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }
    return back()->withErrors(['email' => 'Email atau password salah.']);
})->name('login.submit');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('news')->name('news.')->group(function () {
        Route::get('/create', [NewsController::class, 'create'])->name('create');
        Route::post('/', [NewsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [NewsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [NewsController::class, 'update'])->name('update');
        Route::delete('/{id}', [NewsController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/publish', [NewsController::class, 'publish'])->name('publish');
    });

    Route::get('/manage', [NewsController::class, 'manage'])->name('news.manage');

    Route::prefix('reporters')->name('reporters.')->middleware(RoleMiddleware::class . ':admin')->group(function () {
        Route::get('/', [ReporterController::class, 'index'])->name('index');
        Route::get('/create', [ReporterController::class, 'create'])->name('create');
        Route::post('/', [ReporterController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ReporterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ReporterController::class, 'update'])->name('update');
        Route::delete('/{id}', [ReporterController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(RoleMiddleware::class . ':admin,reporter')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    });
});
