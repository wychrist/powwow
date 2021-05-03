<?php

namespace App\Providers;

use App\Models\{
    Address,
    City,
    Company,
    Contact,
    Content,
    Country,
    Department,
    Group,
    Metadata,
    State,
    Subsidiary,
    User
};

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class PolymorphicTypes extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Relation::morphMap([
            'base_address' => Address::class,
            'base_city' => City::class,
            'base_company' => Company::class,
            'base_contact' => Contact::class,
            'base_content' => Content::class,
            'base_country' => Country::class,
            'base_department' => Department::class,
            'base_group' => Group::class,
            'base_metadata' => Metadata::class,
            'base_state' => State::class,
            'base_subsidiary' => Subsidiary::class,
            'base_user' => User::class,
        ]);
    }
}
