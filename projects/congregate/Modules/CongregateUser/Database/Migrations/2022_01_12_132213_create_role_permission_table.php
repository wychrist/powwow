<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\CongregateUser\Entities\Resource;
use Modules\CongregateUser\Entities\Role;
use Modules\CongregateUser\Entities\Website;

class CreateRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Resource::class);
            $table->foreignIdFor(Role::class);
            $table->foreignIdFor(Website::class);
            $table->string('action');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permission');
    }
}
