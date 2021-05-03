<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\City;

class CityPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, City $entity)
    {
        return true;
    }

    public function viewAny(User $user)
    {
        return true;
    }


    public function create(User $user)
    {
        return ($user->canCreate(City::class)) ? $this->allow() : $this->deny(__('security::deny.create_deny', ['name' => 'city']));
    }

    public function update(User $user, City $entity)
    {
        return ($user->canUpdate(City::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'city']));
    }

    public function delete(User $user, City $entity)
    {
        return ($user->canDelete(City::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.delete_deny', ['name' => 'city']));
    }


    public function restore(User $user, City $entity)
    {
        return ($user->canUpdate(City::class, $entity->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'city']));
    }
}
