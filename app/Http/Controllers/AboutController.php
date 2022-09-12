<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        return view('about', [
            'title' => 'Webflix',
            'team' => [
                ['name' => 'Fiorella', 'job' => 'DG'],
                ['name' => 'Marina', 'job' => 'PDG'],
            ],
        ]);
    }

    public function show($user)
    {
        return view('about-show', [
            'user' => ucfirst($user),
        ]);
    }
}
