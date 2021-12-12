<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\{
    Foundation\Application,
    View\Factory,
    View\View
};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.admin.index', ['data' => Admin::getList()]);
    }

    /**
     * @param Request $request
     * @return View|Factory|Application
     */
    public function create(Request $request): View|Factory|Application
    {
        if ($request->user('admin')->cannot('admin-add-admin', Admin::class)) {
            abort(403);
        }

        return view('admin.admin.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('admin')->cannot('admin-add-admin', Admin::class)) {
            abort(403);
        }

        $request->validate([
            Admin::NAME => ['required', 'string', 'max:100'],
            Admin::EMAIL => ['required', 'string', 'email', 'max:100', 'unique:admins'],
            Admin::PASSWORD => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($result = Admin::add($request->input(Admin::NAME), $request->input(Admin::EMAIL), $request->input('password'))) {
            Session::flash('successes', [
                'Added a admin, ID:' . $result ]);
            return redirect()->route('admin.admin.index');
        } else {
            return back()
                ->withInput()
                ->withErrors(['Failed to create admin']);
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
        if ($request->user('admin')->cannot('admin-update-admin', Admin::class)) {
            abort(403);
        }

        if(!$data = Admin::getById($id)) {
            abort(404);
        }

        return view('admin.admin.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if ($request->user('admin')->cannot('admin-update-admin', Admin::class)) {
            abort(403);
        }

        $request->validate([
            Admin::NAME => ['required', 'string', 'max:100'],
            Admin::EMAIL => ['required', 'string', 'email', 'max:100',
                Rule::unique('admins')->ignore($id)],
            Admin::PASSWORD => ['nullable', 'string', 'min:8', 'confirmed']
        ]);

        if (Admin::updateAllById($id, $request->input(Admin::NAME), $request->input(Admin::EMAIL), $request->input(Admin::PASSWORD))) {
            Session::flash('successes', [
                'Admin ID: ' . $id . ' is updated'
            ]);
            return redirect()->route('admin.admin.index');
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
        if ($request->user('admin')->cannot('admin-destroy-admin', Admin::class)) {
            abort(403);
        }

        if (Admin::deleteById($id)) {
            Session::flash('successes', [
                'Admin ID: ' . $id . ' is deleted'
            ]);
            return redirect()->route('admin.admin.index');
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
        if ($request->user('admin')->cannot('admin-restore-admin', Admin::class)) {
            abort(403);
        }

        if (Admin::restoreById($id)) {
            Session::flash('successes', [
                'Admin ID: ' . $id . ' is restored'
            ]);
            return redirect()->route('admin.admin.index');
        } else {
            return back()
                ->withErrors(['Failed to restored']);
        }
    }
}
