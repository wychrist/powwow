<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\State;

class StatePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, State $entity)
    {
        return true;
    }

    public function viewAny(User $user)
    {
        return true;
    }


    public function create(User $user)
    {
        return ($user->canCreate(State::class)) ? $this->allow() : $this->deny(__('security::deny.create_deny', ['name' => 'state']));
    }

    public function update(User $user, State $entity)
    {
        return ($user->canUpdate(State::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'state']));
    }

    public function delete(User $user, State $entity)
    {
        return ($user->canDelete(State::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.delete_deny', ['name' => 'state']));
    }


    public function restore(User $user, State $entity)
    {
        return ($user->canUpdate(State::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'state']));
    }
}
