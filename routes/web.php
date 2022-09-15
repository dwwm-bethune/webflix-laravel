<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

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
Route::get('/films/creer', [MovieController::class, 'create'])->name('movies.create');
Route::post('/films/creer', [MovieController::class, 'store']);
Route::get('/films/{movie}', [MovieController::class, 'show'])->name('movies.show');
// Faire la modification des films
// (Si l'image change, on upload la nouvelle et on supprime l'ancienne sinon on fait rien)
Route::get('/films/{movie}/modifier', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('/films/{movie}/modifier', [MovieController::class, 'update']);
// Faire la suppression d'un film (Supprimer la cover du film)
Route::delete('/films/{movie}', [MovieController::class, 'destroy'])->name('movies.delete');
