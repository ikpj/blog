<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param $admin
     * @return bool
     */
    public function adminDestroyPost($admin): bool
    {
        return $admin instanceof Admin;
    }

    /**
     * @param $admin
     * @return bool
     */
    public function adminRestorePost($admin): bool
    {
        return $admin instanceof Admin;
    }

    /**
     * @param $admin
     * @return bool
     */
    public function adminUpdatePost($admin): bool
    {
        return $admin instanceof Admin;
    }
}
