<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Services\Newsletter;
use Illuminate\Validation\ValidationException;

// Single action controller
class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate([
            'email' => ['required', 'email']
        ]);


        try {
            $newsletter->subscribe(request('email'));
        } catch (\Throwable $th) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list'
            ]);
        }

        return redirect(RouteServiceProvider::HOME)
            ->with('success', 'You are now signed up for our newsletter!');
    }
}
