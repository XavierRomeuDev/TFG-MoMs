<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{

    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request, $lang = null): RedirectResponse|View
    {
        $lang = $lang ?? $request->segment(1);

        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::GUEST)
                    : view('auth.verify-email', compact('lang'));
    }
}
