<?php

namespace Modules\People\Listeners\User;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Api\User\Created as Event;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\People\Entities\Person;

class Created
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $this->doProcessing($event->getUser(), $event->getPayload());
    }

    public function doProcessing(User $user, array $payload): User
    {
        if(isset($payload['person'])) {
           $creating = $user->person === null;
           $clean= $this->validate($payload['person'], $creating);
            if($creating) {
                $person = new Person($clean);
                $person->user()->associate($user);
                $person->save();

                $person->companies()->attach(company());
            } else {
                foreach ($clean as $name => $value) {
                    $user->person->{$name} = $value;
                }
                $user->person->save();
            }
        }


        return $user;
    }

    private function validate(array $data, bool $creating = true): array
    {
        if ($creating) {
            $firstAndLastname = ['required', 'string', 'max:255'];
        } else {
            $firstAndLastname = ['string', 'max:255'];
        }

        return Validator::make($data, [
            'firstname' => $firstAndLastname,
            'lastname' => $firstAndLastname,
            'title' => ['max:255'],
            'middlename' => ['max:255'],
            'date_of_birth' => ['date_format:Y-m-d', 'nullable'],
            'gender' => ['integer', Rule::in([1, 2]), 'nullable'],
            'account_status' => ['string', 'max:255']
        ])->validate();
    }
}
