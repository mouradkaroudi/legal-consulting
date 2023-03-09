<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * 
     */
    public function index( Request $request )
    {

        return view('pages.auth.login', [
            'redirect' => $request->input('redirect')
        ]);
    }

    /**
     * Handle forget password
     */
    public function forgotPassword( Request $request ) {
        return view('pages.auth.forgot-password');
    }

    /**
     * Handle reset password
     */
    public function resetPassword( Request $request, $token ) {
        return view('pages.auth.reset-password', ['token' => $token, 'email' => $request->input('email')]);
    }

    /**
     * Display the email verification prompt.
     */
    public function verifyEmailPrompt( Request $request ) {
        return $request->user()->hasVerifiedEmail()
        ? redirect()->intended(RouteServiceProvider::HOME)
        : view('pages.auth.verify-email');

    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function verifyEmail(EmailVerificationRequest $request): RedirectResponse
    {
        
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }

    /**
     * Send a new email verification notification.
     */
    public function resendVerification(Request $request): RedirectResponse {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');

    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
