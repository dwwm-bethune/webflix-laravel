<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/', function () {
    return view('home', [
        'name' => 'toto',
        'html' => '<p>Salut</p>',
        'cars' => ['Ferrari', 'Porsche', 'Renault'],
    ]);
})->name('home');

Route::get('/accueil', [HomeController::class, 'index']);
Route::get('/a-propos', [AboutController::class, 'index'])->name('about');
Route::get('/a-propos/{user}', [AboutController::class, 'show'])->name('about.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/nouvelle', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/nouvelle', [CategoryController::class, 'store']);
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/modifier', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}/modifier', [CategoryController::class, 'update']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');

Route::get('/films', [MovieController::class, 'index'])->name('movies');
Route::get('/films/creer', [MovieController::class, 'create'])->name('movies.create')->middleware('verified');
Route::post('/films/creer', [MovieController::class, 'store'])->middleware('verified');
Route::get('/films/{movie}', [MovieController::class, 'show'])->name('movies.show');
// Faire la modification des films
// (Si l'image change, on upload la nouvelle et on supprime l'ancienne sinon on fait rien)
Route::get('/films/{movie}/modifier', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('/films/{movie}/modifier', [MovieController::class, 'update']);
// Faire la suppression d'un film (Supprimer la cover du film)
Route::delete('/films/{movie}', [MovieController::class, 'destroy'])->name('movies.delete');

Route::resource('actors', ActorController::class);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::get('/inscription', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/inscription', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/films');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:2,1'])->name('verification.send');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::get('/profil', function () {
    return Auth::user();
})->middleware('auth');
