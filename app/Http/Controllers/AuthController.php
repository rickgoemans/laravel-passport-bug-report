<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(): View
    {
        return view('auth.login')
            ->with([
                'processUrl' => route('auth.login-process'),
            ]);
    }

    public function loginProcess(Request $request): RedirectResponse
    {
        $guardName = 'web_new';

        if (!Auth::guard($guardName)->attempt($request->only('email', 'password'))) {
            return back()
                ->withInput()
                ->withErrors([
                    '_general' => 'Invalid credentials',
                ]);
        }

        return redirect()
            ->intended();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()
            ->invalidate();

        $request->session()
            ->regenerateToken();

        return redirect(RouteServiceProvider::HOME);
    }
}
