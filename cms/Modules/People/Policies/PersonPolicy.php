<?php

namespace Modules\People\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use Modules\People\Entities\Person;

class PersonPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, Person $person)
    {
        return ($user->canRead(Person::class, $person->id)) ? $this->allow() : $this->deny(__('security::deny.view_deny', ['name' => 'person']));
    }

    public function viewAny(User $user)
    {
        return ($user->canReadAny(Person::class)) ? $this->allow() : $this->deny(__('security::deny.view_any_deny', ['name' => 'people']));
    }

    public function create(User $user)
    {
        return ($user->canCreate(Person::class)) ? $this->allow() : $this->deny(__('security::deny.create_deny', ['name' => 'person']));
    }

    public function update(User $user, Person $person)
    {
        return ($user->canUpdate(Person::class, $person->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'person']));
    }

    public function delete(User $user, Person $person)
    {
        return ($user->canDelete(Person::class, $person->id)) ? $this->allow() : $this->deny(__('security::deny.delete_deny', ['name' => 'person']));
    }


    public function restore(User $user, Person $person)
    {
        return ($user->canUpdate(Person::class, $person->id)) ? $this->allow() : $this->deny(__('security::deny.update_deny', ['name' => 'person']));
    }
}
