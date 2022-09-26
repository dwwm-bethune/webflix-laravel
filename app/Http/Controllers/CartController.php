<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // S'il vient du 3D secure
        if ($request->boolean('success')) {
            session()->forget('products');
        }

        $totalWithoutTaxes = collect(session('products'))->sum('price');

        return view('cart', [
            'totalWithTaxes' => number_format($totalWithoutTaxes / 100 * 1.2, 2, ',', ' ').' €',
        ]);
    }

    public function store(Movie $movie)
    {
        session()->push('products', $movie);

        return redirect('/panier');
    }
}
