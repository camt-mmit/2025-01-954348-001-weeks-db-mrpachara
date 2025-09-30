<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    function list(User $user): bool
    {
        return $user->isAdministrator();
    }

    function view(User $user): bool
    {
        return $this->list($user);
    }

    function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    function update(User $user): bool
    {
        return $this->create($user);
    }

    function delete(User $user, User $target): bool
    {
        return $this->update($user) && $target->isNot($user);
    }

    function updateRole(User $user, User $target): bool
    {
        return $this->update($user) && $target->isNot($user);
    }

    function selfView(User $user, User $target): bool
    {
        return $target->is($user);
    }

    function selfUpdate(User $user, User $target): bool
    {
        return $this->selfView($user, $target);
    }
}
