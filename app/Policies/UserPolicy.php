<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
    public function adminDestroyUser($admin): bool
    {
        return $admin instanceof Admin && $admin->{Admin::IS_SUPER_ADMIN};
    }

    /**
     * @param $admin
     * @return bool
     */
    public function adminRestoreUser($admin): bool
    {
        return $admin instanceof Admin && $admin->{Admin::IS_SUPER_ADMIN};
    }

    /**
     * @param $admin
     * @return bool
     */
    public function adminUpdateUser($admin): bool
    {
        return $admin instanceof Admin;
    }

    /**
     * @param $admin
     * @return bool
     */
    public function adminAddUser($admin): bool
    {
        return $admin instanceof Admin;
    }
}
