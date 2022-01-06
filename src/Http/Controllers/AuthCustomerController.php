<?php

namespace OpenJournalTeam\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use OpenJournalTeam\Core\Models\User;

class AuthCustomerController extends BaseController
{
    public function index()
    {
        return render('core::pages.auth.customer.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $credentials = [$fieldType => $request->email, 'password' => $request->password];

            $user = User::where($fieldType, $request->email)->firstOr(fn () => false);

            if (!$user) {
                return response_error("Email or Password incorrect");
            }

            if (!$user->status) {
                return response_error("Failed to login");
            }

            if (Auth::attempt($credentials, $request->input('remember_me', false))) {
                $request->session()->regenerate();

                return response_success(['msg' => 'Login Success..', 'redirect' => route('core.customer.home')]);
            }

            return response_error('Email or Password incorrect');
        } catch (\Throwable $e) {
            return Log::debug($e->getMessage());
        }
    }

    /**
     * Handle an redirect authorize.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginWithOAuth2(Request $request)
    {
        try {
            $request->session()->put('state', $state = Str::random(40));
    
            $query = http_build_query([
                'client_id' => "9547b81d-fc05-4252-8ebd-326b3f3aefe0",
                'redirect_uri' => 'http://127.0.0.1:8000/customer/auth/callback',
                'response_type' => 'code',
                'scope' => '',
                'state' => $state,
                // "redirect_uri"  => route('core.customer.auth.callback'),
            ]);
    
            return redirect('http://127.0.0.1:8000/oauth/authorize?' . $query);
        } catch (\Throwable $e) {
            return Log::debug($e->getMessage());
        }
    }
}