<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\{
    Foundation\Application,
    View\Factory,
    View\View
};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.post.index', ['data' => Post::getList()]);
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
        if ($request->user('admin')->cannot('admin-update-post', Post::class)) {
            abort(403);
        }

        $data = Post::getById($id);

        return view('admin.post.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        if ($request->user('admin')->cannot('admin-update-post', Post::class)) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:65535'],
        ]);

        if (Post::updateById($id, $request->input('title'), $request->input('content'))) {
            Session::flash('successes', [
                'Post ID: ' . $id . 'updated'
            ]);
            return redirect()->route('admin.post.edit', ['id' => $id]);
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
        if ($request->user('admin')->cannot('admin-destroy-post', Post::class)) {
            abort(403);
        }

        if (Post::deleteById($id)) {
            Session::flash('successes', [
                'Post ID: ' . $id . 'soft deleted'
            ]);
            return redirect()->route('admin.post.index');
        } else {
            return back()
                ->withErrors(['Failed to delete']);
        }
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        if (!$data = Post::getById($id)) {
            abort(404);
        }
        return view('admin.post.show', ['id' => $id, 'data' => $data]);
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
        if ($request->user('admin')->cannot('admin-restore-post', Post::class)) {
            abort(403);
        }

        if (Post::restoreById($id)) {
            Session::flash('successes', [
                'Post ID: ' . $id . ' is restored'
            ]);
            return redirect()->route('admin.post.index');
        } else {
            return back()
                ->withErrors(['Failed to restored']);
        }
    }
}
