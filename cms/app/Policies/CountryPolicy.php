<?php

namespace App\Policies;

use App\Models\Country;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class CountryPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, Country $entity)
    {
        return true;
    }

    public function viewAny(User $user)
    {
        return true;
    }


    public function create(User $user)
    {
        return ($user->canCreate(Country::class)) ? $this->allow() : $this->deny(__('security::deny.create_deny', ['name' => 'country']));
    }

    public function update(User $user, Country $entity)
    {
        return ($user->canUpdate(Country::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'country']));
    }

    public function delete(User $user, Country $entity)
    {
        return ($user->canDelete(Country::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.delete_deny', ['name' => 'country']));
    }


    public function restore(User $user, Country $entity)
    {
        return ($user->canUpdate(Country::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'country']));
    }
}
