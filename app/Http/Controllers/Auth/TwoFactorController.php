<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

class TwoFactorController extends Controller
{
    /**
     * Show the 2FA setup form.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('auth.two-factor-setup');
    }

    /**
     * Enable Two-Factor Authentication (2FA) for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Request $request)
    {
        $user = Auth::user();

        if (!$user->two_factor_secret && Features::enabled(Features::twoFactorAuthentication())) {
            $user->forceFill([
                'two_factor_secret' => encrypt($request->input('two_factor_secret')),
            ])->save();

            return redirect(route('two-factor.verification'));
        }

        return back();
    }

    /**
     * Show the 2FA verification challenge.
     *
     * @return \Illuminate\View\View
     */
    public function showVerificationForm()
    {
        return view('auth.two-factor-verify');
    }

    /**
     * Verify the 2FA code.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $user = Auth::user();

        if (Fortify::confirmTwoFactorAuthenticationStatus($user)) {
            if ($request->hasValidTwoFactorCode()) {
                Fortify::loginUsingId($user->id, true);

                return redirect(config('fortify.home'));
            }

            return back()->withErrors(['two_factor' => __('The two-factor code is invalid.')]);
        }

        return redirect(config('fortify.home'));
    }
}
