<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Post,
    User,
    Admin
};
use Illuminate\Contracts\{
    Foundation\Application,
    View\Factory,
    View\View,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public static function index()
    {
        return view('admin.home.index', [
            'postCount' => Post::total(),
            'totalPostCount' => Post::totalWithTrashed(),
            'userCount' => User::total(),
            'totalUserCount' => User::totalWithTrashed(),
            'adminCount' => Admin::total(),
            'totalAdminCount' => Admin::totalWithTrashed(),
        ]);
    }
}
