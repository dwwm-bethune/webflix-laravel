<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Exception\CardException;

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

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'update'])
    ->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/email/verify', [VerifyEmailController::class, 'index'])
    ->middleware('auth')->name('verification.notice');
Route::get('/email/verification-notification', [VerifyEmailController::class, 'store'])
    ->middleware(['auth', 'throttle:2,1'])->name('verification.send');

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
    ->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])
    ->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest')->name('password.update');

Route::get('/profil', function () {
    return Auth::user();
})->middleware('auth');

Route::get('/panier', [CartController::class, 'index'])->name('cart');
Route::post('/panier/{movie}', [CartController::class, 'store'])->name('cart.store');

Route::post('/paiement', function (Request $request) {
    // On récupère le film à payer
    $movie = Movie::findOrFail($request->movie);

    // On crée un client Stripe (Optionnel)
    $request->user()->createOrGetStripeCustomer();
    // $request->user()->updateDefaultPaymentMethod($request->payment_method);

    // On fait le paiement (simple sans facture)
    $request->user()->charge(
        ceil($movie->price * 1.20), $request->payment_method
    );
    // Paiement complexe avec facture stripe
    // $request->user()->invoiceFor(
    //     'Achat de '.$movie->title, ceil($movie->price * 1.20)
    // );

    // @todo (Créer une table et stocker l'historique des paiements => Prix payé, date, l'ID du film, l'ID du client)
    // Stocker le paiement dans une table "orders"

    return back()
        ->with('payment_success', 'Votre film '.$movie->title.' a été payé.');
})->name('pay')->middleware('auth');

Route::post('/paiement-2', function (Request $request) {
    $price = collect(session('products'))->sum('price');

    // On crée un client Stripe (Optionnel)
    $request->user()->createOrGetStripeCustomer();

    // On fait le paiement (simple sans facture)
    try {
        $request->user()->charge(
            ceil($price * 1.20), $request->payment_method
        );
        // Paiement impossible
    } catch (CardException $e) {
        return back()->withErrors([
            'payment' => $e->getMessage()
        ]);
        // 3D secure
    } catch (IncompletePayment $exception) {
        return redirect()->route(
            'cashier.payment',
            [$exception->payment->id, 'redirect' => route('cart')]
        )->with('payment_success', 'Votre panier a été payé.');
    }

    session()->forget('products');

    return back()->with('payment_success', 'Votre panier a été payé.');
})->name('pay-2')->middleware('auth');
