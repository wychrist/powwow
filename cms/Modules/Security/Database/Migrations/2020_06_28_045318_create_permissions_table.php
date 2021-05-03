<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // stores permissions for a role or a user
        Schema::create('permissions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('resource')->index();
            $table->uuid('resource_id')->nullable()->index();

            $table->string('role_alias')->nullable();
            $table->uuid('user_id')->nullable()->index();

            $table->boolean('read')->default(false);
            $table->boolean('read_any')->default(false);
            $table->boolean('create')->default(false);
            $table->boolean('update')->default(false);
            $table->boolean('delete')->default(false);

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
        Schema::dropIfExists('permissions');
    }
}
