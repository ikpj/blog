<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\{
    Foundation\Application,
    View\Factory,
    View\View
};
use Illuminate\Http\{
    RedirectResponse,
    Request,
    Response
};
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('post.index', ['posts' => Post::getPosts()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:65535'],
        ]);

        $result = Post::add(
            Auth::id(),
            $request->post('title'),
            $request->post('content')
        );

        if ($result) {
            return redirect()->route('post.show', ['id' => $result]);
        } else {
            return back()->withInput()
                ->withErrors(['Failed to create post']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id): View|Factory|Application
    {
        if ($posts = Post::getById($id)) {
            return view('post.show', ['post' => $posts]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $postModel = Post::getById($id);

        if ($postModel->{Post::USER_ID} !== Auth::id()) {
            abort(404);
        }

        return view('post.edit', ['post' => $postModel]);
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
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:65535'],
        ]);

        if (Post::updateByIdAndUserId($id, Auth::id(), $request->input('title'), $request->input('content'))) {
            return redirect()->route('post.show', ['id' => $id]);
        } else {
            return redirect()->route('post.edit', ['id' => $id])
                ->withErrors(['Failed to update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        if (Post::deleteByIdAndUserId($id, Auth::id())) {
            return redirect()->route('post.index');
        } else {
            return back()
                ->withErrors(['Failed to delete']);
        }
    }

}
