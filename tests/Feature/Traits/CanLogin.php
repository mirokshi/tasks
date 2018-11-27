<?php

namespace Tests\Feature\Traits;

use App\User;
use Spatie\Permission\Models\Permission;

trait CanLogin
{
    /**
     * @param null $guard
     * @return mixed
     */
    protected function login($guard = null)
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, $guard);
        return $user;
    }
    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginAsUsingRole($guard,$role)
    {
        initialize_roles();
        $user = factory(User::class)->create();
        $user->assignRole($role);
        $this->actingAs($user,$guard);
        return $user;
    }

    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginAsTaskManager($guard = null)
    {
        return $this->loginAsUsingRole($guard, 'TaskManager');
    }

    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginAsTagsManager($guard = null)
    {
        return $this->loginAsUsingRole($guard,'TagsManager');
    }

    /**
     * @param null $guard
     * @return mixed
     */
    protected function loginWithPermission($guard,$permission)
    {
        $user = factory(User::class)->create();
        Permission::create([
            'name' => $permission
        ]);
        $user->givePermissionTo($permission);
        $this->actingAs($user,$guard);
        return $user;
    }

    protected function loginAsSuperAdmin($guard = null)
    {
        $user = factory(User::class)->create();
        $user->admin = true;
        $user->save();
        $this->actingAs($user,$guard);
        return $user;
    }
}