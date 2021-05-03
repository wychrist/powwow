<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\People\Entities\PersonRelationship;

class CreatePersonRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_relationships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('person_id')->index();
            $table->uuid('relation_id')->index();
            $table->string('role');
            $table->string('relation_role');
            $table->string('status')->default(PersonRelationship::STATUS_ACTIVE);
            $table->smallInteger('priority')->default(99)->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_relationships');
    }
}
