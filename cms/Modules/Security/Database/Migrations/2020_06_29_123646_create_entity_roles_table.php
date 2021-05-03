<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // stores the relationship between an entity and one or more roles
        Schema::create('entity_roles', function (Blueprint $table) {
            $table->uuid('role_id')->index();
            $table->uuidMorphs('entity_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_roles');
    }
}
