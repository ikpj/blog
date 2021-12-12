<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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
    public function adminDestroyAdmin($admin): bool
    {
        return $admin instanceof Admin && $admin->{Admin::IS_SUPER_ADMIN};
    }

    /**
     * @param $admin
     * @return bool
     */
    public function adminRestoreAdmin($admin): bool
    {
        return $admin instanceof Admin && $admin->{Admin::IS_SUPER_ADMIN};
    }

    /**
     * @param $admin
     * @return bool
     */
    public function adminUpdateAdmin($admin): bool
    {
        return $admin instanceof Admin && $admin->{Admin::IS_SUPER_ADMIN};
    }

    /**
     * @param $admin
     * @return bool
     */
    public function adminAddAdmin($admin): bool
    {
        return $admin instanceof Admin && $admin->{Admin::IS_SUPER_ADMIN};
    }
}
