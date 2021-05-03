<?php

use App\Events\Api\User\Created;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Security\Entities\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SetupInitialData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createDefaultRoles();
        $this->createDefaultUser();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    private function createDefaultRoles()
    {
        if (Schema::hasTable('roles')) {
            // set default roles
            foreach (Role::getGenericRoles() as $alias => $name) {
                $role = Role::firstOrCreate(
                    [
                        'name' => $name,
                        'alias' => $alias,
                        'company_id' => company()->id
                    ]
                );

                $role->save();
            }
        }
    }

    private function createDefaultUser()
    {
        if (Schema::hasTable('users')) {
            $superAdminrole = Role::where('alias', Role::ROLE_SUPER_ADMIN)->first();

            if (User::count() <= 0) {
                // create the default super admin
                $user = new User([
                    'name' => 'administrator',
                    'email' => 'super@example.com',
                    'password' => 'changeme',
                    'force_password_reset' => true
                ]);

                $user->save();
                $user->roles()->attach([$superAdminrole->id]);

                Created::dispatch($user, [
                    'person' => [
                        'firstname' => 'Super',
                        'lastname' => 'Administrator'
                    ]
                ]);

            } else {
                // assign exiting users to the super admin role
                User::chunk(10, function ($collection) use ($superAdminrole) {
                    // assign this user to the super admin role
                    $collection->each(function($user) use ($superAdminrole){
                        $user->roles()->syncWithoutDetaching([$superAdminrole->id]);
                    });
                });
            }
        }
    }
}
