<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\{
    Foundation\Application,
    View\Factory,
    View\View
};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.user.index', ['data' => User::getList()]);
    }

    /**
     * @param Request $request
     * @return View|Factory|Application
     */
    public function create(Request $request): View|Factory|Application
    {
        if ($request->user('admin')->cannot('admin-add-user', User::class)) {
            abort(403);
        }

        return view('admin.user.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('admin')->cannot('admin-add-user', User::class)) {
            abort(403);
        }

        $request->validate([
            User::NAME => ['required', 'string', 'max:100'],
            User::EMAIL => ['required', 'string', 'email', 'max:100', 'unique:users'],
            User::PASSWORD => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($result = User::add($request->input(User::NAME), $request->input(User::EMAIL), $request->input(User::PASSWORD))) {
            Session::flash('successes', [
                'Added a user, ID:' . $result ]);
            return redirect()->route('admin.user.index');
        } else {
            return back()
                ->withInput()
                ->withErrors(['Failed to create user']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(Request $request, $id): View|Factory|Application
    {
        if ($request->user('admin')->cannot('admin-update-user', User::class)) {
            abort(403);
        }

        if(!$data = User::getById($id)) {
            abort(404);
        }

        return view('admin.user.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        if ($request->user('admin')->cannot('admin-update-user', User::class)) {
            abort(403);
        }

        $request->validate([
            User::NAME => ['required', 'string', 'max:100'],
            User::EMAIL => ['required', 'string', 'email', 'max:100',
                Rule::unique('users')->ignore($id)],
            User::PASSWORD => ['nullable', 'string', 'min:8', 'confirmed']
        ]);

        if (User::updateAllById($id, $request->input(User::NAME), $request->input(User::EMAIL), $request->input(User::PASSWORD))) {
            Session::flash('successes', [
                'User ID: ' . $id . ' is updated'
            ]);
            return redirect()->route('admin.user.index');
        } else {
            return back()
                ->withInput()
                ->withErrors(['Failed to update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        if ($request->user('admin')->cannot('admin-destroy-user', User::class)) {
            abort(403);
        }

        if (User::deleteById($id)) {
            Session::flash('successes', [
                'User ID: ' . $id . ' is deleted'
            ]);
            return redirect()->route('admin.user.index');
        } else {
            return back()
                ->withErrors(['Failed to delete']);
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function restore(Request $request, $id): RedirectResponse
    {
        if ($request->user('admin')->cannot('admin-restore-user', User::class)) {
            abort(403);
        }

        if (User::restoreById($id)) {
            Session::flash('successes', [
                'User ID: ' . $id . ' is restored'
            ]);
            return redirect()->route('admin.user.index');
        } else {
            return back()
                ->withErrors(['Failed to restored']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroyAllPost($id): RedirectResponse
    {
        if (Post::deleteByUserId($id)) {
            Session::flash('successes', [
                'User ID: ' . $id . ' posts are deleted'
            ]);
            return redirect()->route('admin.user.index');
        } else {
            return back()
                ->withErrors(['Failed/Nothing to delete']);
        }
    }
}
