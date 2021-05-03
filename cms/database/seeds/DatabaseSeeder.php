<?php

use App\User;
use Illuminate\Database\Seeder;
use Modules\Security\Entities\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        // create users
        $this->createUsers(); 
    }


    private function createUsers()
    {
        factory(User::class, 200)->create()->each(function($user){
            $this->addUserToRole($user);
        });
    }

    private function addUserToRole(User $user): User
    {
        $groupAliases = [
            Role::ROLE_SUPER_ADMIN,
            Role::ROLE_ADMIN,
            Role::ROLE_STAFF,
            Role::ROLE_CUSTOMER
        ];


        $role = Role::where('alias', $groupAliases[array_rand($groupAliases)])->first();

        $role->users()->attach($user);
        return $user;
    }
}
