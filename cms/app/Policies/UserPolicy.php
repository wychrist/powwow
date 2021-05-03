<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, User $entity)
    {
        if ($user->id == $entity->id) {
            return true;
        }

        return ($user->canRead(User::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.view_deny', ['name' => 'user']));
    }

    public function viewAny(User $user)
    {
        return ($user->canReadAny(User::class)) ? $this->allow() : $this->deny(__('security::deny.view_any_deny', ['name' => 'users']));
    }

    public function create(User $user)
    {
        return ($user->canCreate(User::class)) ? $this->allow() : $this->deny(__('security::deny.create_deny', ['name' => 'user']));
    }

    public function update(User $user, User $entity)
    {
        return ($user->canUpdate(User::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'user']));
    }

    public function delete(User $user, User $entity)
    {
        return ($user->canDelete(User::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.delete_deny', ['name' => 'user']));
    }


    public function restore(User $user, User $entity)
    {
        return ($user->canUpdate(User::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'user']));
    }
}
