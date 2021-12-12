<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    Hash
};
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Show self defined Login View.
     *
     * @return Application|Factory|View
     */
    public function showRegistrationForm(): View|Factory|Application
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            User::NAME => ['required', 'string', 'max:100'],
            User::EMAIL => ['required', 'string', 'email', 'max:100', 'unique:users'],
            User::PASSWORD => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // create user
        $user = User::create([
            User::NAME => $request->input('name'),
            User::EMAIL => $request->input('email'),
            User::PASSWORD => Hash::make($request->input('password')),
        ]);

        if (isset($user)) {
            event(new Registered($user)); //send email to check email
            Auth::guard()->login($user);

            return redirect()->intended('/');
        } else {
            return back()
                ->withInput()
                ->withErrors([
                    'Registration failed',
                ]);
        }
    }
}

