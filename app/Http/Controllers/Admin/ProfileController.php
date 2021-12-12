<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\{
    Foundation\Application,
    View\Factory,
    View\View,
};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function edit(): View|Factory|Application
    {
        if (!$admin = Admin::getById(Auth::id())) {
            abort(404);
        }

        return view('admin.profile.edit', ['data' => $admin]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            Admin::NAME => ['required', 'string', 'max:255'],
            Admin::EMAIL => ['required', 'email', 'max:255'],
        ]);

        if (Admin::updateById(Auth::id(), $request->input(Admin::NAME), $request->input(Admin::EMAIL))) {
            Session::flash('successes', ['Updated']);
            return redirect()
                ->route('admin.profile.edit');
        } else {
            return back()
                ->withInput()
                ->withErrors(['Failed to update']);
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function editPassword(): View|Factory|Application
    {
        return view('admin.profile.editPassword');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        if (!$admin = Admin::getById(Auth::id())) {
            abort(404);
        }

        $request->validate([
            'currentPassword' => ['required', 'string', 'min:8'],
            Admin::PASSWORD => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->input('currentPassword'), $admin->{Admin::PASSWORD})) {
            return redirect()
                ->back()
                ->withErrors(['Current password not correct!']);
        }

        if (Admin::updatePasswordById(Auth::id(), $request->input(Admin::PASSWORD))) {
            Session::flash('successes', ['Updated']);
            return redirect()
                ->route('admin.profile.editPassword');
        } else {
            return back()
                ->withErrors(['Failed to update']);
        }
    }
}
