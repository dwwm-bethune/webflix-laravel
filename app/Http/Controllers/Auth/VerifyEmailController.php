<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function index()
    {
        return view('auth.verify-email');
    }
    
    public function store(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function update(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/films');
    }
}
