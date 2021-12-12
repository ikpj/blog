<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\{
    Foundation\Application,
    View\Factory,
    View\View
};
use Illuminate\Http\{
    RedirectResponse,
    Request,
    JsonResponse
};
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Show self defined Login View.
     */
    public function showLoginForm(): Factory|View|Application
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        // TODO add throttle

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()
            ->withInput()
            ->withErrors([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    public function logout(Request $request): JsonResponse|Redirector|Application|RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

}
