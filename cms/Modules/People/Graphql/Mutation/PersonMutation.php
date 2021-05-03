<?php

namespace Modules\People\Graphql\Mutation;

use App\Graphql\Mutation\UserMutation;
use App\User;
use Illuminate\Support\Facades\Gate;
use Modules\People\Entities\Person;

class PersonMutation
{
    public function create($root, array $data): Person
    {
        return $this->doCreate($data);
    }

    public function doCreate(array $data): Person
    {
        Gate::authorize('create', Person::class);

        $clean = $this->validateData($data);

        $user = app(UserMutation::class)->doCreate($data['user']);

        $person = $this->setFields(new Person(), $clean);

        $person->user()->associate($user);
        $person->save();

        return $person;
    }


    public function update($root, array $data): Person
    {
        $person = Person::findOrFail($data['id']);

        Gate::authorize('update', $person);

        $clean = $this->validateData($data, $person);

        $person = $this->setFields($person, $clean);
        $person->save();

        if(isset($data['user'])) {
            app(UserMutation::class)->update($root, $data['user']);
        }

        return $person;
    }

    public function doUpdate(array $data): Person
    {
        $person = Person::findOrFail($data['id']);

        Gate::authorize('update', $person);

        $clean = $this->validateData($data, $person);

        $person = $this->setFields($person, $clean);
        $person->save();

        if(isset($data['user'])) {
            app(UserMutation::class)->doUpdate($data['user']);
        }

        return $person;
 
    }

    public function delete($root, array $data): Person
    {
        return $this->doDelete($data['id']);
    }

    public function doDelete(string $id): Person
    {
        $person = Person::findOrFail($id);

        Gate::authorize('delete', $person);

        $person->delete();

        return $person;

    }


    public function restore($root, array $data): Person
    {
        return $this->doRestore($data['id']);
    }

    public function doRestore(string $id): Person
    {
        $person = Person::withTrashed()->findOrFail($id);

        Gate::authorize('restore', $person);
        $person->restore();

        return $person;
    }

    private function setFields($person, array $data): Person
    {
        foreach ($data as $field => $value) {
            $person->{$field} = $value;
        }

        return $person;
    }
    private function validateData(array $data, Person $person = null)
    {
        $rules = [
            'firstname' => ['bail', 'string', 'max:255'],
            'middlename' => ['string', 'max:255'],
            'lastname' => ['bail', 'string', 'max:255']
        ];

        if(!$person) {
            $person['firstname'][] = 'required';
            $person['lastname'][] = 'required';
        }

        $validator =  validator($data, $rules);

        if ($validator->fails()) {
            abort(400, $validator->errors()->toJson());
        }

        return $validator->validated();
    }
}
